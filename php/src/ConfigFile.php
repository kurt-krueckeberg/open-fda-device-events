<?php
declare(strict_types=1);
namespace OpenFda

//use LanguageTools\XmlConfigFile;
/*
  Provides access to config.xml through static method, get_config(string provider)
 */
class ConfigFile {

   private \SimpleXMLElement $xml;

   private array $headers;
   private string $base_uri;
   private string $endpoint;

   // static string $query_fmt =  "/providers/provider[@name='%s']"; 

   public function __construct(string $xml_name)
   {   
     $this->xml = simplexml_load_file($xml_name);
   
      $this->endpoint['base_uri'] = (string) $simplexml->endpoint;
      
      $this->headers['headers'] = array();

      foreach($simplexml->headers->header as $header) {

        $key = (string) $header['key'];

        $this->headers['headers'][$key] = (string) $header;              
      }

    // return $r;
   }
   public function get_headers() : array
   {
      return $this->headers;
   }
   /* 
   private function get_xml_element(string $name) : \SimpleXMLElement
   {
      $query = sprintf(self::$query_fmt, $name); 
    
      $response = $this->xml->xpath($query);
    
      return $response[0];  
   }
   */
}
