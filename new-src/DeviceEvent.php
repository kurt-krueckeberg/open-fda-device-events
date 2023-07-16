<?php
declare(strict_types=1);
namespace Fda; 

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

/*
 Query options:
search: What to search for, in which fields. If you don’t specify a field to search, the API will search in every field.
sort: Sort the results of the search by the specified field in ascending or descending order by using the :asc or :desc modifier.
count: Count the number of unique values of a certain field, for all the records that matched the search parameter. By default, the API returns the 1000 most frequent values.
limit: Return up to this number of records that match the search parameter. Currently, the largest allowed value for the limit parameter is 1000.
skip: Skip this number of records that match the search parameter, then return the matching records that follow. Use in combination with limit to paginate results. Currently, the largest allowed value for the skip parameter is 25000. See Paging if you require paging through larger result sets.

Are limit and skip pagenation, a type of iteration??

meta.result.total gives the total hits, total number of records matching the search critieria

class Results {

See https://open.fda.gov/apis/paging/
    __ctor

}
 */

class DeviceEvent extends OpenFdaApi, implements IteratorAggregate {

   private string $route;      
   private string $method;     // GET, POST, etc 

   // Speicifin <query> section setting relevant only to this problem domain

   private array $options;    // [['headers' => [...], 'query' => [...], 'json' => [...]]

   private Client $client;  

   /*
    * Instantiates the derived class specified in <implementation>...</implementation>
    */ 

   static public function createFromXML(string $fxml) : OpenFdaApi
   {
      $simp = simplexml_load_file($fxml);
   
      return new DeviceEvent(???); 
   }

   public function __construct(\SimpleXMLElement $s) 
   {  
       parent::__contruct($s);
   } 

   private function setConfigOptions(\SimpleXMLElement $settings)
   {
      $headers = array();
           
      foreach($settings->credentials->header as $header) 
          
               $headers[(string) $header['name']] = (string) $header;

      $this->options['headers'] = $headers;

      $this->route  = (string) $settings->route;  
      $this->method = (string) $settings->method;

      $this->setQueryOptions($settings->query);
   }  

   // Assign xml <query> section default settings
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

   protected function setQueryParms(array $parms) // array of key => value query parameters.
   {
       foreach($parms as $jey => $value)

       $this->options['query'][$mkey] = $value;
   }

   function getIterator() : Iterator
   {

   }
    
}
