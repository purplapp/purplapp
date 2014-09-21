<?php
// set timezone
date_default_timezone_set('UTC');

// error reporting
error_reporting(E_ALL);
if (isset($_SERVER) and preg_match('/^revive/', $_SERVER['HTTP_HOST'])) {
    ini_set("display_errors", 1);
} else {
    ini_set('display_errors', 0);
}

// set requires
require_once 'PurplappSettings.php';        // get settings
require_once 'AppDotNetCommand.php';        // get AppDotNet PHP Library
require_once 'PurplappExtraFunctions.php';  // get Purplapp's custom function library
require_once 'PurplappErrorHandler.php';    // get Purplapp's custom error handling library

// FIXME
// comment this out if session is started elsewhere
session_start();

class EZAppDotNet extends AppDotNet {

    private $_callbacks = array();
    private $_autoShutdownStreams = array();

    public function __construct($clientId=null,$clientSecret=null) {
        $key    = $clientId     ?: Container::getParam("CLIENT_ID");
        $secret = $clientSecret ?: Container::getParam("CLIENT_SECRET");

        if (!$key && !$secret) {
            throw new AppDotNetException("No CLIENT_ID or CLIENT_SECRET defined");
        } else if (!$key) {
            throw new AppDotNetException("No CLIENT_ID defined");
        } else if (!$secret) {
            throw new AppDotNetException("No CLIENT_SECRET defined");
        }

        // call the parent with the variables we have
        parent::__construct($key, $secret);

        // set up ez streaming
        $this->registerStreamFunction(array($this, 'streamEZCallback'));

        // make sure we cleanup/destroy any streams when we exit
        register_shutdown_function(array($this, 'stopStreaming'));
    }

    public function getAuthUrl($redirectUri=null,$scope=null) {
        $redirect = $redirectUri ?: Container::getParam("REDIRECT_URL");
        $scope    = $scope       ?: Container::getParam("API_SCOPE");

        if (!$scope) {
            throw new AppDotNetException("No API_SCOPE defined");
        } else if (!$redirect) {
            throw new AppDotNetException("No REDIRECT_URL defined");
        }

        return parent::getAuthUrl($redirect, $scope);
    }

    public function setSession($cookie = 0,$callback = null) {
        $callback = $callback ?: Container::getParam("REDIRECT_URL");

        // try and set the token the original way (eg: if they're logging in)
        $token = $this->getAccessToken($callback) ?: $this->getSession();

        //FIXME
        $_SESSION['AppDotNetPHPAccessToken']=$token;

        // if they want to stay logged in via a cookie, set the cookie
        if ($token && $cookie) {
            $cookie_lifetime = time() + (60 * 60 * 24 * 7);
            setcookie('AppDotNetPHPAccessToken', $token, $cookie_lifetime);
        }

        return $token;
    }

    // check if user is logged in
    public function getSession() {

        // first check for cookie
        if (isset($_COOKIE['AppDotNetPHPAccessToken']) && $_COOKIE['AppDotNetPHPAccessToken'] != 'expired') {
            $this->setAccessToken($_COOKIE['AppDotNetPHPAccessToken']);
            return $_COOKIE['AppDotNetPHPAccessToken'];
        }

        // else check the session for the token (from a previous page load)
        else if (isset($_SESSION['AppDotNetPHPAccessToken'])) {
            $this->setAccessToken($_SESSION['AppDotNetPHPAccessToken']);
            return $_SESSION['AppDotNetPHPAccessToken'];
        }

        return false;
    }

    // log the user out
    public function deleteSession() {
        // clear the session
        unset($_SESSION['AppDotNetPHPAccessToken']);

        // unset the cookie
        setcookie('AppDotNetPHPAccessToken', null, 1);

        // clear the access token
        $this->setAccessToken(null);

        // done!
        return true;
    }

    /**
     * Registers a callback function to be called whenever an event of a certain
     * type is received from the app.net streaming API. Your function will recieve
     * a PHP associative array containing an app.net object. You must register at
     * least one callback function before starting to stream (otherwise your data
     * would simply be discarded). You can register multiple event types and even
     * multiple functions per event (just call this method as many times as needed).
     * If you register multiple functions for a single event, each will be called
     * every time an event of that type is received.
     *
     * Note you should not be doing any significant processing in your callback
     * functions. Doing so could cause your scripts to fall behind the stream and
     * risk getting disconnected. Ideally your callback functions should simply
     * drop the data into a file or database to be collected and processed by
     * another program.
     * @param string $type The type of even your callback would like to recieve.
     * At time of writing the possible options are 'post', 'star', 'user_follow'.
     */
    public function registerStreamCallback($type,$callback) {
        switch ($type) {
            case 'post':
            case 'star':
            case 'user_follow':
                if (!array_key_exists($type,$this->_callbacks)) {
                    $this->_callbacks[$type] = array();
                }
                $this->_callbacks[$type][] = $callback;
                return true;
                break;
            default:
                throw new AppDotNetException('Unknown callback type: '.$type);
        }
    }

    /**
     * This is the easy way to start streaming. Register some callback functions
     * using registerCallback(), then call startStreaming(). Every time the stream
     * gets sent a type of object you have a callback for, your callback function(s)
     * will be called with the proper data. When your script exits the streams will
     * be cleaned up (deleted).
     *
     * Do not use this method if you want to spread out streams across multiple
     * processes or multiple servers, since the first script that exits/crashes will
     * delete the streams for everyone else. Instead use createStream() and openStream().
     * @return true
     * @see AppDotNetStream::stopStreaming()
     * @see AppDotNetStream::createStream()
     * @see AppDotNetStream::openStream()
     */
    public function startStreaming() {
        // only listen for object types that we have registered callbacks for
        if (!$this->_callbacks) {
            throw new AppDotNetException('You must register at least one callback function before calling startStreaming');
        }
        // if there's already a stream running, don't allow another
        if ($this->_currentStream) {
            throw new AppDotNetException('There is already a stream being consumed, only one stream can be consumed per AppDotNetStream instance');
        }
        $stream = $this->createStream(array_keys($this->_callbacks));
        // when the script exits, delete this stream (if it's still around)
        $this->_autoShutdownStreams[] = $response['id'];
        // start consuming
        $this->openStream($response['id']);
        return true;
    }

    /**
     * This is the easy way to stop streaming and cleans up the no longer needed stream.
     * This method will be called automatically if you started streaming using
     * startStreaming().
     *
     * Do not use this method if you want to spread out streams across multiple
     * processes or multiple servers, since it will delete the streams for everyone
     * else. Instead use closeStream().
     * @return true
     * @see AppDotNetStream::startStreaming()
     * @see AppDotNetStream::deleteStream()
     * @see AppDotNetStream::closeStream()
     */
    public function stopStreaming() {
        $this->closeStream();
        // delete any auto streams
        foreach ($this->_autoShutdownStreams as $streamId) {
            $this->deleteStream($streamId);
        }
        return true;
    }

    /**
     * Internal function used to make your streaming easier. I hope.
     */
    protected function streamEZCallback($type,$data) {
        // if there are defined callbacks for this object type, then...
        if (array_key_exists($type,$this->_callbacks)) {
            // loop through the callbacks notifying each one in turn
            foreach ($this->_callbacks[$type] as $callback) {
                call_user_func($callback,$data);
            }
        }
    }
}
