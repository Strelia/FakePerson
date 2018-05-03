<?php

namespace Strelia;

use Strelia\API\AProvider;
use Strelia\API\NamefakeProvider;
use Strelia\API\RandomuserProvider;
use Strelia\API\UinamesProvider;

class PersonFactory
{
    private $providers;
    public function __construct($providers = null)
    {
        if (empty($providers)) {
            $this->providers = [
                new NamefakeProvider(),
                new RandomuserProvider(),
                new UinamesProvider()
            ];
        } else {
            $this->providers = [];
            foreach ($providers as $provider) {
                $this->providers[] = new $provider();
            }
        }

    }

    public function getNextUser(){
        /**
         * @var AProvider $provider
         */
        $provider = $this->providers[rand(0, count($this->providers) - 1)];

        return $provider->getFormatedUser();
    }
}