<?php
require_once "vendor/autoload.php";

use Strelia\PersonFactory;

$factory = new PersonFactory();

for ($i = 0; $i < 1500; $i++) {
    echo $i . ': ' . json_encode($factory->getNextUser()) . "\n";
}