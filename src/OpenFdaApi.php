<?php
declare(strict_types=1);
namespace LanguageTools;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class OpenFdaApi {

   protected Client $client;  

   private $headers = array();
 
   public function __construct(ConfigFile $c)
   {      
       $xml = simple_xml_load_file($c);
       
       // todo: $node?

       $this->headers =  $params['headers'];

       $settings = simplexml_load_file($fxml);
   
       $this->setConfigOptions($settings);

       $this->client = new Client(['base_uri' => (string) $settings->baseurl]);
   }

   protected function request(string $method, string $route, array $options = array()) : string
   {
       $options['headers'] = $this->headers;
 
       $response = $this->client->request($method, $route, $options);

       return $response->getBody()->getContents();
   }
}
