<?php
declare(strict_types=1);
namespace LanguageTools;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class OpenFda extends RestApi {

   array $parms = ['count' => '', 'limit' => 1, 'skip' => '', 'search' => '', 'offset' => ''];

   static string $device_event_route;
 
   public function __construct(ConfigFile $c)
   {      
      parent::__construct($cS); 
   }

   final public function device_event_query() : string 
   {
       static $trans = array('method' => "POST", 'route' => self::$device_event_route);

       $query = build_query($this->parms);
       
       $contents = $this->request(self::$http_method, $trans['route'], ['query' => $query]); 

       $obj = json_decode($contents);

       return urldecode($obj->outputs[0]->output);
   }
}
