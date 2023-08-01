<?php
declare(strict_types=1);
namespace OpenFda

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class OpenDeviceEventFda extends RestApi {

   array $parms = ['count' => '', 'limit' => 1, 'skip' => '', 'search' => '', 'offset' => ''];

   static string $device_event_route = "device/event.json";
 
   public function __construct(ConfigFile $c)
   {      
      parent::__construct($cS); 
   }
   
   final public function query(string $input) : \stdClass
   {
       static $trans = array('method' => "GET", 'route' => self::$device_event_route);

       $query = build_query($this->parms);
       
       $contents = $this->request(self::$trans['method'], $trans['route'], ['query' => $query]); 

       $obj = json_decode($contents);

       return urldecode($obj->outputs[0]->output);
   }
}
