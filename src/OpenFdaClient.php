<?php
declare(strict_types=1);
namespace Prowl;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response; 

class OpenFdaClient {
    
    private Client $client;
    private string $token; 
    private array  $authorization;
    
    private array  $config;   

   public function __construct(array $conf)
   { 
       $this->config = $conf;
       
       $this->client = new Client( ['base_uri' => $conf['base_uri']]);
       
       $this->token = $this->get_token($conf['authenticate']);
       
       // Create required authoriztion  header for queries
 
       $this->authorization = ['Authorization' => 'Bearer ' . $this->token ];
   }

   private function get_token(array $auth) : string
   {   
       $options =  [ 'form_params' => [
                   'username' =>  $auth['username'],
                   'password' => $auth['password']  
               ],
          'debug' => true
       ]; 
       
       $response = $this->client->post($auth['endpoint'], $options); 

       return $response->getBody()->getContents();
   }

   public function studies()
   { 
      static $study = 'study';
      
      $route = $this->config['queries']['endpoint'] . '/' . $this->config['queries']['routes']['study'];
    
      //$this->options['query'] = array('prefixedId' => ''); 
      
      $this->options['debug'] = true;
           
      $this->headers['headers'] = $this->authorization;
      
      $this->options['headers']['Content-Type'] = 'applicaton/json';
      $this->options['headers']['accept'] = 'applicaton/json'; 
       
     $this->options['query'] = ['prefixedId' => ''];

      $response = $this->client->request('GET', $route, $this->options);

      $x = $response->getBody()->getContents();
      var_dump($x); ////????
   }

   public function data_dict() : array
   {
      static $req = ['method' => "GET", 'route' => "translation/supportedLanguages"];

      $contents = $this->request($req['method'], $req['route']);
             
      return json_decode($contents);
   } 

   /*
    *  NOTE: The language codes to be lowercase.
    *  If the language is not utf-8, the default, then you must speciy the encoding using the 'options' parameter.
    */
   final public function example2(string $text, string $dest, $src="") : string 
   {
       static $trans = array('method' => "POST", 'route' => "translation/text/translate");

       $query = array();
       
       if ($src !== '') 
           $query['source'] = strtolower($src);
       
       $query['target'] = strtolower($dest);
       
       $query['input'] = $text;
       
       $contents = $this->request($trans['method'], $trans['route'], ['query' => $query]); 

       $obj = json_decode($contents);

       return urldecode($obj->outputs[0]->output);
   }

   final public function example3(string $word, string $src, string $dest) : ResultsIterator
   {      
      static $lookup = array('method' => "GET", 'route' => "resources/dictionary/lookup");

      $query = array();
      
      if ($src !== '') 
          $query['source'] = strtolower($src);
      
      $query['target'] = strtolower($dest);
      
      $query['input'] = $word;// urlencode($text);  

      $contents = $this->request($lookup['method'], $lookup['route'], ['query' => $query]);

      $obj = json_decode($contents);    
           
      return new ResultsIterator($obj->outputs[0]->output->matches, Prowl::results_filter(...));
    }

    /* results_filter(mixed $match) returns ProwlDictResult with  three properties:
          1. the word being defined ($match->source->lemma) 
          2. its part-of-speech ($match->source->pos) 
          3. an array of definitions that hss two elements:
    // 1. 'definition', a definition, and 2. an array 'expressions' of zero or more associated expressions.
    */
    public static function results_filter(mixed $match) :  ProwlDictResult
    {
       // First ,we create ProwlDictResult::definitions, the array of definitions.       
       $definitions = array();

       /* Each $target below holds: 1. a definition in $target['lemma'], 2. the part of speech in $target['pos'] and 3. zero or more example/usage expressions. :w*/
       foreach($match->targets as $index => $target) { 
         
           $definitions[$index]['definition'] = $target->lemma; 
  
           // expression is an array of a \stdClass objects that have two properties: source and target.
           $definitions[$index]['expressions'] = (count($target->expressions) > 0) ? $target->expressions : array();
        }

       return new ResultProwl($match->source->lemma, $match->source->pos, $definitions); // TODO: <--- Is this correct?
    }
}
