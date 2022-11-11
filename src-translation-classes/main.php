#!/usr/bin/env php
<?php
declare(strict_types=1);
use \SplFileObject as File;
use LanguageTools\{RestClient, ClassID, FileReader, HtmlBuilder};

include 'vendor/autoload.php';

if ($argc != 3) {

  echo "Enter the vocabulary words input file, followed by html file name (without .html).\n";
  return;

} else if (! file_exists($argv[1]))  {

  echo "Input file does not exist.\n";
  return;
}

try {
    $fwords = $argv[1];
 
    $file = new FileReader($fwords);
    
    $html = new HtmlBuilder($argv[2], "de", "en", ClassID::Collins);

    foreach ($file as $line) {
       
        $a = explode('#', $line);

        $cnt = $html->add_definitions($a[0]); 

        echo ($cnt === 0 ? "No definitions " : "Defintions ") . "found for {$a[0]}.\n";   

        $sl = array_slice($a, count($a) == 1 ? 0 : 1);

        foreach ($sl as $sword) {
          $cnt = $html->add_samples($sword, 5); 
          echo   "Added $cnt samples sentences for $sword.\n";
       } 
    }
 
  } catch (Exception $e) {

      echo "Exception: message = " . $e->getMessage() . "\nError Code = " . $e->getCode() . "\n";
  } 
