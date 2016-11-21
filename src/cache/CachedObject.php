<?php
namespace Twitter\cache;
use Twitter\cache\Cacheable;
/*
 * This is a CachedObject class that implements Cachable interface for cache expiration policy
 * of cached object.
 * 
*/
class CachedObject implements Cacheable
{
    public $identifier = null;
    public $expiration_time;
    public $object = null;

 /**
  * CachedObject constructor
  * @param  String  $id memcache identifier
  * @param  Object  $obj object to store on memcache
  * @param  Integer $minutesToLive number of minutes till expires 
  */
    public function __construct($id ,$obj, $minutesToLive)
    {
        $this->object = $obj;
        $this->identifier = $id;
        
        if ($minutesToLive != 0)  
        {
            // $secs = $minutesToLive * 60;
            // expires in 3 minutes
            $secs = 180;
            $date = new \DateTime();
            $date->add(new \DateInterval('PT' . $secs . 'S')); // adds 674165 secs
            $this->expiration_time = $date->getTimestamp();
        }
    }

    /**
     * Check if cached object is expired based on it's expiration_time
     * @return boolean 
     */
    public function isExpired()
    {
        if ($this->expiration_time != null)
        {
            $date = new \DateTime();
            if($this->expiration_time >= $date->getTimestamp()){
                return false;
            }
        }
        return true;
    }

    /**
     * CachedObject constructor
     * @return String @identifier cached object identifier
    */
    public function getIdentifier()
    {
        return $this->identifier;
    }
}