#!/usr/bin/env php
<?php
declare(strict_types=1);
use \SplFileObject as File;

include 'vendor/autoload.php';

if ($argc == 1) {

  echo "";
  return;

} else if (getopts($argv))  {

  echo " \n";
  return;
}

try {
    
    $c = new ConfigFile('config.xml');
    
    $fda = new OpenFDA("device/event.json") ;

 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\nError Code = " . $e->getCode() . "\n";
  } 
