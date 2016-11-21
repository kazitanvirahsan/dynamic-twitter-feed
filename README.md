Dynamic Twitter Feeds
=====================

Problem Statement
-----------------
Write a web application that dynamically feeds 10 Twitter Tweets with relevant keywrod (ex- "engineering").


list of technologies
--------------------
    AngualrJS 1.4.2
    PHP 5.4
    Memcached 1.4 (http://downloads.northscale.com/memcached-win64-1.4.4-14.zip)
    Composer (https://getcomposer.org/)
    Twitter Rest Api (https://dev.twitter.com/oauth/overview/single-user)
    oAuth 1.1 ( Using @abraham’s PHP twitteroauth Library)

Features
--------
    Seach tweets based on keywords
    Set tweet count
    Convert twitter hashtag, alias, and links into hyperlinks.
    Stores Tweets in temporary cache

How to Run
-----------

1. Make sure you have php 5.3+ up and running for PSR4 compatibility.

2. Install and run Memcached server:
    Download and install Memcached server from the following link based on your operating system
    https://memcached.org/
    
    Windows user, please get a copy and install it from 
    https://commaster.net/content/installing-memcached-windows
     
    In order to flush/clear it use >telnet localhost 11211
    Memcached is required to store the tweets. See the class's under cache directory.

3. Integrating Twitter Rest api to local server:

    For authenticating Twitter Rest api to our site,we need to generate the follwing parameters from api/config files.

    // Consumer Key
    define('CONSUMER_KEY', 'xxxx');
    define('CONSUMER_SECRET', 'xxxx');

    // User Access Token
    define('ACCESS_TOKEN', 'xxxx');
    define('ACCESS_SECRET', 'xxxx');

    Create a twitter account if you don't have one in 'single user mode' from https://apps.twitter.com/ to generate consumer key , consumer secret , access token and access secret for oAuth to REst API.

    *****The Callback URL (http://127.0.0.1/twitter/index.php) needs to be mapped with the localhost application directory during testing.

    See the image directory to get the output after running.

4. Composer Configuration:
    Our composer.json includes abraham/twitteroauth(ref->https://dev.twitter.com/oauth/overview/single-user) and psr-4 for namespace resolution.
    {
    
    "require": 
    {
        "abraham/twitteroauth": "0.5.*"
    },
    "autoload": 
    {
        "psr-4": 
        {
            "Twitter\\":"src/"
        }
    }
}

Suggested Imporvements 
----------------------

    There is no gurantee that twitter rest api will return result set (in case of server failure) which may break the website.In addition, no gurantee can be made from memcached server. As a result,alternative persistent cache like file cache to store our tweets for fail over need to be introduced.

    Cancelling ajax call in certain time interval needs to be triggered when angualr controller will be out of scope.Cancellation of this activity ensures that we do not run asynchronous call to fetch tweets forever while on the other page.

    Error and Exception handling need to be implemented and more completed before production.

    For better data display requirements, each twitter feed date strings needs to be well-formed. Client side CSS framework like Bootstrapping or angular-ui can be a good feature as well.