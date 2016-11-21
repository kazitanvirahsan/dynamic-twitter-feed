<?php

    // Consumer Key
    define('CONSUMER_KEY', 'aDNWIzxqROANff9WjCDC2sdSh');
    define('CONSUMER_SECRET', 'wZbN2jXkhJi1W4PPmBXTUonU68yuwLKNnCPxImGAWeWHuYJieA');

    // User Access Token
    define('ACCESS_TOKEN', '3240677546-rF7LWcr9QvIJEBXNqRyPkJyDZHTiN05IKpbMT9O');
    define('ACCESS_SECRET', 'WjLqOH19dzFnUCXhzbrIGzZGylUyyodulR8kV6Rt2nXh2');

    // Memcache Setting
    define('MEM_SERVER',  'localhost');

    // Twitter memcache parent key
    define('TWITTER_CACHEKEY',  'twitter_data');

    
    // File Cache Settings
    define('CACHE_ENABLED', true);
    define('CACHE_LIFETIME', 3600); // in seconds
    define('HASH_SALT', md5(dirname(__FILE__)));

    ini_set("log_errors" , "1");
    ini_set("error_log" , "error.log");
    ini_set("display_errors" , "0");
    

    function exception_error_handler($severity, $message, $file, $line) 
    {
        throw new ErrorException($message, 0, $severity, $file, $line);
    }
    
    function exception_handler($exception)
    {
        echo 'An exception has occured';
    }

    function fatal_handler() 
    {
        
    }

//set_error_handler('exception_error_handler');
//set_exception_handler('exception_handler');
//register_shutdown_function( "fatal_handler" );
