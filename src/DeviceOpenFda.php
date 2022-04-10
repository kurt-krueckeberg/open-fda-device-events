<?php
declare(strict_types=1);
namespace Fda;

use GuzzleHttp\Psr7\Response;

class OpenFdaDevice extends OpenFda {


   public function __construct(\SimpleXMLElement $provider)
   {
        parent::__construct($provider);     
   }     

   final function process_response(Response $response) : string
   {
       $contents = $response->getBody()->getContents();

       $obj = json_decode($contents);

       return $obj[0]->translations[0]->text; 
   } 
 
   final protected function add_input(string $text)
   {
      $this->setJson( [['Text' => $text]] );       
   }
}
