<?php
use GuzzleHttp\Client as Client;

include "vendor/autoload.php";

class DeviceEventFetcher {

   static $base_uri = "https://api.fda.gov/device/event.json";

   private $uri; // Portion that will follow $base_uri, although it does not need to be catenated to it.
   private $api_key; 

   static $qs_api_key = 'api_key';
   static $qs_limit = 'limit';
   static $qs_offset = 'offset';

   public function __construct(int $api_key) // default offset and limit?
   {
      $this->api_key = $api_key;

      $this->client = new Client(array('base_uri' => self::$base_uri));
   }

   public function get_test()// , $offset, $limit)
   {
     
      $uri = $this->uri . '/' . urlencode($word);

      try {
         $query = ['query' => [
                               'api_key' => $this->api_key,
                               'search' => "date_received:[20130101+TO+20141231]", 
                               'offset' => 0, 
                               'limit' =>  10
                              ]
                  ];

         $response = $this->client->request('GET', $uri, $query);
      
         $result = $response->getBody()->getContents();
         
         return $result;
      
      } catch (RequestException $e) {
      
         $response = $this->StatusCodeHandling($e);
         return $response;

      }  catch (\Exception $e) { 

         return; // TODO: Should this be different?
      }
   }
}

$fetch = new DeviceEventFetcher(
