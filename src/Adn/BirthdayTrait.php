<?php namespace Purplapp\Adn;

trait BirthdayTrait
{

    private $birthday;

    private $isValidTimeStamp;
    private $strReplaceAssoc;
    private $birthdayDateConversion;

    public function isValidTimeStamp($timestamp)
    {
        return ((string) (int) $timestamp === $timestamp) 
            && ($timestamp <= PHP_INT_MAX)
            && ($timestamp >= ~PHP_INT_MAX);
    }
    
    public function strReplaceAssoc(array $replace, $subject)
    { 
       return str_replace(array_keys($replace), array_values($replace), $subject);    
    } 
    
    public function birthdayDateConversion()
    {
        $birthday = $this->value->gender;

        $replace = array( 
            'xxxx' => '1970', 
        ); 
        
        if (strpos($birthday,'xxx') !== false) {
            $birthday_changed = $this->strReplaceAssoc($replace,$birthday);
            $flag = true;
        } else {
            $birthday_changed = $birthday;
            $flag = false;
        }
                
        // convert the changed birthday (if necessary) into unix timestamp
        $unix_birthday_changed = strtotime($birthday_changed);
        $unix_birthday_changed_integer = (string) $unix_birthday_changed;
        
        // check if it is a valid unix timestamp or not
        $unix_yes_no = $this->isValidTimeStamp($unix_birthday_changed_integer);
        
        if ($unix_yes_no){
            if ($flag == false) {
                $date_changed = date("jS F Y", $unix_birthday_changed);
            } else {
                $date_changed = date("jS F ", $unix_birthday_changed);      
            }
            return $date_changed;       
        } else {
            return $birthday_changed;       
        }
    }
}
