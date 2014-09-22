<?php namespace Purplapp;

use Silex\Application\MonologTrait;
use Monolog\Logger;

trait LogTrait
{
    use MonologTrait;

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function logEmergency($message, array $context = array())
    {
        return $this->log($message, $context, Logger::EMERGENCY);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function logAlert($message, array $context = array())
    {
        return $this->log($message, $context, Logger::ALERT);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function logCritical($message, array $context = array())
    {
        return $this->log($message, $context, Logger::CRITICAL);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function logError($message, array $context = array())
    {
        return $this->log($message, $context, Logger::ERROR);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function logWarning($message, array $context = array())
    {
        return $this->log($message, $context, Logger::WARNING);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function logNotice($message, array $context = array())
    {
        return $this->log($message, $context, Logger::NOTICE);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function logInfo($message, array $context = array())
    {
        return $this->log($message, $context, Logger::INFO);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function logDebug($message, array $context = array())
    {
        return $this->log($message, $context, Logger::DEBUG);
    }
}
