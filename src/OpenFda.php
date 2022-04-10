<?php
declare(strict_types=1);
namespace Fda; 

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class OpenFda implements OpenFdaInterface {

   private string $route;      
   private string $method;     // GET, POST, etc 

   // Speicifin <query> section setting relevant only to this problem domain

   private array $options;    // [['headers' => [...], 'query' => [...], 'json' => [...]]

   private Client $client;  

   /*
    * Instantiates the derived class specified in <implementation>...</implementation>
    */ 
   static public function createFromXML(string $fxml) : OpenFda
   {
      $simp = simplexml_load_file($fxml);
   
      $refl = new \ReflectionClass((string) $simp->implementation); 
      
      return $refl->newInstance($simp);
    }

   public function __construct(\SimpleXMLElement $s) 
   {  
       $this->setConfigOptions($s);

       $this->client = new Client(['base_uri' => (string) $s->baseurl]);
   } 
   
   public function query(array $a)
   {
       
   }

   private function setConfigOptions(\SimpleXMLElement $settings)
   {
      $headers = array();
      
      if ((string)$settings->credentials["method"] == "custom") 
      
           $headers = $this->getCredentials($settings->credentials);
      
      else {
            
          foreach($settings->credentials->header as $header) 
          
               $headers[(string) $header['name']] = (string) $header;
      }

      $this->options['headers'] = $headers;

      $this->route  = (string) $settings->route;  
      $this->method = (string) $settings->method;

      $this->setQueryOptions($settings->query);
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
