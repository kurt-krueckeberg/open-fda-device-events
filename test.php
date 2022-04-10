<?php
use Fda\OpenFda;

require_once "OpenFda.php";

$x = OpenFda::createFromXML("config.xml");

$debug = 10;

++$debug;
