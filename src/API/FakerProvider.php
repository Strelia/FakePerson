<?php

namespace Strelia\API;

use \Faker\Factory as Faker;
use Faker\Generator;

class FakerProvider extends AProvider {

    protected function generateUser(){
        /**
         * @var Generator $faker
         */
        $faker = Faker::create();

        return [
            'name' => $faker->name,
            'username' => $faker->userName,
            'email' => $faker->email
        ];
    }

    /**
     * Return Json from API server
     *
     * @return array
     */
    public function getUser()
    {
        return $this->getFormattedUser();
    }

    /**
     * Return formatted user data
     *
     * @return array
     */
    public function getFormattedUser()
    {
        $responseUser = $this->generateUser();

        return [
            'name' => $responseUser['name'],
            'username' => $responseUser['username'],
            'email' => $this->normalizeEmail($responseUser['email'])
        ];
    }
}
