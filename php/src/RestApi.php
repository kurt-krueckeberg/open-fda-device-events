<?php
declare(strict_types=1);
namespace OpenFda

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class RestApi {

   protected Client $client;  

   private $header_options = array();
 
   public function __construct(ConfigFile $c)
   {      
       $this->header_options = $c->get_config();
       
       $this->client = new Client( ['base_uri' => $params['base_uri']]);
   }

   public function request(string $method, string $route, array $options = array()) : string
   {
       $options['headers'] = $this->header_options;
 
       $response = $this->client->request($method, $route, $options);

       return $response->getBody()->getContents();
   }
}
