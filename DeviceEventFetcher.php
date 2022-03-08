<?php
use GuzzleHttp\Client as Client;
use GuzzleHttp\Psr7\Request as Request;
use GuzzleHttp\Exception\RequestException as RequestException;

include "vendor/autoload.php";

class DeviceEventFetcher {

   static $base_uri = "https://api.fda.gov/device/event.json";

   private $api_key; 

   static $qs_api_key = 'api_key';
   static $qs_search = "search";
   static $qs_limit = 'limit';
   
   static $qs_offset = 'offset'; //untested

   public function __construct(string $api_key) // default offset and limit?
   {
      $this->api_key = $api_key;

      $this->client = new Client(array('base_uri' => self::$base_uri));
   }

   public function query(string $search)// , $offset, $limit)
   {
        // TODO: Figure out if I need to encode the parameters, or if Guzzle offers a way to do so.
        $search_parm = urlencode($search); // urlencode("date_received:[20130101+TO+20141231]");
        
        try {     
            
         $query = ['query' => [
                               self::$qs_api_key => $this->api_key, //"c8qVPGvpax0xJqsbHW2g0LtrY8bRKQIXLAi77EAT",
                               self::$qs_search => $search_parm, 
                               //'offset' => 1, <------- TODO: Doesn't work.
                               self::$qs_limit =>  10
                              ]
                  ];

         $req = new Request('GET', self::$base_uri, $query);

          $response = $this->client->send($req);    // Or simply: $response = $this->client->request('GET', self::$base_uri, $query);
      
         $result = $response->getBody()->getContents();
         
         return $result;
                       
      } catch (Exception $e) {
          
          throw new $e;
      }
      catch (RequestException $e) {

         // If a response code was set, get it.
         if ($e->hasResponse())
             
            $str = "Response Code is " . $e->getResponse()->getStatusCode();
         
         else 
             $str = "No response from server.";

         throw new Exception("Guzzle RequestException. $str"); 
      }
       
   }
}

try {
 $fetch = new DeviceEventFetcher("c8qVPGvpax0xJqsbHW2g0LtrY8bRKQIXLAi77EAT");

 $r = $fetch->query("date_received:[20130101+TO+20141231]");
 
} catch (Excpetion $e) {
    
    echo "Exception: code = " . $e->getCode() ."\n Message = " . $e->getMessage() . "\n"; 
 }

var_dump($r);
