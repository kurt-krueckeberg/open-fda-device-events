<?php
use Fda\OpenFda;

include "vendor/autoload.php";

$x = OpenFda::createFromXML("config.xml");

$debug = 10;

++$debug;
