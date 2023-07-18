<?php
declare(strict_types=1);
namespace LanguageTools;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class OpenFdaApi extends RestApi {

   array $parms = ['count' => '', 'limit' => 1, 'skip' => '', 'search' => '', 'offset' => ''];
 
   public function __construct(ConfigFile $c)
   {      
      parent::__construct($cS); 
   }

   final public function query() : string 
   {
       static $trans = array('method' => "POST", 'route' => "translation/text/translate");

       $query = build_query();
       
       $contents = $this->request(self::$http_method, $trans['route'], ['query' => $query]); 

       $obj = json_decode($contents);

       return urldecode($obj->outputs[0]->output);
   }

}
