<?php
require_once "vendor/autoload.php";

use Strelia\PersonFactory;

$factory = new PersonFactory(['Strelia\\API\\UinamesProvider']);

var_dump($factory->getNextUser());