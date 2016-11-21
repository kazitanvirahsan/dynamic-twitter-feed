<?php
namespace Twitter\api;
use Abraham\TwitterOAuth\TwitterOAuth;
use Twitter\cache\CachedObject;
use Twitter\cache\CacheManager;
/*
 * This is a TwitterApiWrapper class which establishes a secure connection to Twitter Rest Api
 * and returns list of tweets based on a search keyword and number of tweets. 
 * 
*/
class TwitterApiWrapper
{
    private $connection;
    private $query_field;
    private $query_result;
    private $no_of_record;

    public function __construct()
    {
        try {
            $this->connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_SECRET);
        } catch (Exception $e) {
        }

    return $this;
    }

  /**
   * Specify Twitter search keyword.
   *
   * @param  String $queryfield
   *
   * @return Object  $this
   */
    public function setQueryField($queryfield)
    {
        $this->query_field = $queryfield;
        return $this;
    }

  /**
   * Fetch list of tweets based on keyword and number of tweets.
   *
   * @return Object  $query_result
   */
    public function fetchResult()
    {
        $cacheManager = CacheManager::get_Instance();
        $cachedObject = $cacheManager->getCache('twitter_data');

        if ($cachedObject == null) {
            try 
            {
                $this->query_result = $this->connection->get('search/tweets', array('q' => 'engineering', 'count' => $this->no_of_record));
            } catch (Exception $e) 
            {
                return;
        }
        $cachedObject = new CachedObject('twitter_data', $this->query_result, 5);
        $cacheManager->putCache($cachedObject);
        $cachedObject = $cacheManager->getCache('twitter_data');
    }

    $this->query_result = $cachedObject->object;
    return $this->query_result;
    }

  /**
   * Specify number of tweets records.
   *
   * @param  Integer $no_of_record
   *
   * @return Object  $this
   */
    public function setNumberOfRecord($no_of_record)
    {
        $this->no_of_record = $no_of_record;
        return $this;
    }
}