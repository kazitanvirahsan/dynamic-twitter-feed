<?php
namespace Twitter\cache;
/*
 * This is a CacheManager class which instantiate memcache.It stroes and retrieves 'Cachable Object' from memcahced.   
 * 
 */
class CacheManager 
{
    private $identifier;
    private $memcache_instance;
    private static $instance;

    private function __construct()
    {
            $this->memcache_instance = new \Memcache();
            try 
            {
                $this->memcache_instance->connect(MEM_SERVER, 11211) or die ("Could not connect");
            } 
            catch(Exception $e)
            {
            }
    }

 /**
  * Gets an instance of this class in a singleton way.
  * @return Object $instance
  */
    public static function get_Instance() 
    {
         if(!self::$instance) { // If no instance then make one
            self::$instance = new self();
        }
        return self::$instance;
    }

   /**
    * Stores a CachedObject to memcached
    * @param  CachedObject  $cacheobject
    * @return CachedObject $cacheobject 
    */
    public function putCache($cacheobject)
    {
        $this->memcache_instance->set( $cacheobject->identifier , $cacheobject , 0 ,30);
    }

   /**
    * gets a CachedObject from memcached
    * @param  String  $identifier
    * @return CachedObject $cacheobject 
    */
    public function getCache($identifier)
    {
        $cachedobject = $this->memcache_instance->get($identifier);
        if($cachedobject == null) return null;
        
        if($cachedobject->isExpired())
        {
            $this->memcache_instance->delete($identifier);
            return null;
        }
        return $cachedobject;
    }
}