<?php
declare(strict_types=1);
namespace Fda;  // todo: autoloading not configured yet.

require_once "OpenFdaInterface.php";

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class OpenFDA implements OpenFdaInterface {

   private string $route;      
   private string $method;     // GET, POST, etc 

   // Speicifin <query> section setting relevant only to this problem domain

   private array $options;    // [['headers' => [...], 'query' => [...], 'json' => [...]]

   /*  This is also a class member variable defined and set on the constructor's argument list (PHP >=8.0 required).
   private $provider;
    */
   
   private Client $client;  

   /*
    * Instantiates the derived class specified in <implementation>...</implementation>
    */ 
   static public function createFromXML(string $fxml)
   {
      $simp = simplexml_load_file($fxml);
      
      var_dump($simp);

      $x = $simp->credentials;

      var_dump($x);
   }

  
   // PHP 8.0 feature required: automatic member variable assignemnt syntax.
   public function __construct(protected \SimpleXMLElement $provider) 
   {      
       $this->provider = $provider;

       $this->setConfigOptions($provider);

       $this->client = new Client(['base_uri' => (string) $this->provider->settings->baseurl]);
   } 
   
   public function query(array $a)
   {
       
   }

   private function setConfigOptions(\SimpleXMLElement $provider)
   {
      $headers = array();
      
      if ((string)$provider->settings->credentials["method"] == "custom") 
      
           $headers = $this->getCredentials($provider->settings->credentials);
      
      else {
            
          foreach($provider->settings->credentials->header as $header) 
          
               $headers[(string) $header['name']] = (string) $header;
      }

      $this->options['headers'] = $headers;

      $this->route  = (string) $provider->services->translation->route;  
      $this->method = (string) $provider->services->translation->method;

      $this->setQueryOptions($provider->services->translation->query);
   }  

   // Assign xml <query> section settings in $this->options['query']
   private function setQueryOptions(\SimpleXMLElement $query)
   {
      // Set other default query string settings
      foreach($query->parm as $parm)  

          $query_array[ (string) $parm["name"] ] = urlencode( (string) $parm );

      $this->options['query'] = $query_array;
   }
  
   protected function setQueryParm(string $key, string $value)
   {
       $this->options['query'][$key] = $value;
   }

   // Helper method for use by derived classes, to set json input, if needed
   protected function setJson(array $json)
   {
       $this->options['json'] = $json;
   }
}
