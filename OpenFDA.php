<?php
declare(strict_types=1);
namespace Fda;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

abstract class OpenFDA implements OpenFDAInterface {

   private string $route;      
   private string $method;     // GET, POST, etc 

   // Speicifin <query> section setting relevant only to this problem domain

   private array $options;    // [['headers' => [...], 'query' => [...], 'json' => [...]]

   /*  This is also a class member variable defined and set on the constructor's argument list (PHP >=8.0 required).
   private $provider;
    */
   
   private Client $client;  

   static string $xpath =  "/providers/provider[@abbrev='%s']";  // Maybe sth. different

   /*
    * Returns SimpleXMLElement pointing to correct <provider> element.
    */
   static private function get_provider(string $xml_name, string $abbrev)
   {
      $simp = simplexml_load_file($xml_name);
     
      $query = sprintf(self::$xpath, $abbrev); 
     
      $response = $simp->xpath($query);
     
      return $response[0];
   }

   /*
    * Instantiates the derived class specified in <implementation>...</implementation>
    */ 
   static public function createFromXML(string $fxml, string $abbrev) : Translator
   {
      $provider = self::get_provider($fxml, $abbrev); 
      
      $refl = new \ReflectionClass((string) $provider->services->translation->implementation); 
      
      return $refl->newInstance($provider);
   }
  
   // PHP 8.0 feature required: automatic member variable assignemnt syntax.
   public function __construct(protected \SimpleXMLElement $provider) 
   {      
       $this->provider = $provider;

       $this->setConfigOptions($provider);

       $this->client = new Client(['base_uri' => (string) $this->provider->settings->baseurl]);
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
      $this->from_key = (string) $query->from['name'];
      $query_array = array();

       // set default source language, if present     
      if ($query->from !== '')

          $query_array[$this->from_key] = (string) $query->from;
      
      $this->to_key = (string) $query->to['name'];

      // set default destination language, if present
      if ($query->to !== '') 

            $query_array[$this->to_key] = (string) $query->to;

      // Set other default query string settings
      foreach($query->parm as $parm)  

          $query_array[ (string) $parm["name"] ] = urlencode( (string) $parm );

      $this->options['query'] = $query_array;
   }

   /* 'Template pattern' method that calls abstract protected methods overriden by derived classes (to prepare the input amd
       to extract the translated text (as a string) from he reponse. */
   final public function translate(string $text, string $dest_lang, $source_lang="")
   {
       $this->setLanguages($dest_lang, $source_lang);

       $this->add_input($text); // Implemented by derived classes.

       $response = $this->client->request($this->method, $this->route, $this->options); 

       return $this->process_response($response);
   }

   // Overriden by derived classes to add input text to the HTTP Message that Guzzle\Client will send.
   // IT will be added either as a query strng parameter or JSON set in the body of the message by Guzzle\Client.
   abstract protected function add_input(string $text);
    
   // Overriden by derived classes to return translated text as a string.
   abstract protected function process_response(Response $response) : string; 
   
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
