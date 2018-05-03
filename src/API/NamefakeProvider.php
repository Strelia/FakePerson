<?php

namespace Strelia\API;

class NamefakeProvider extends AProvider
{
    protected $api = 'https://api.namefake.com/';

    /**
     * Return Json from API server
     *
     * @return array
     * @throws \Exception
     */
    public function getUser()
    {
        return $this->generateUser();
    }

    /**
     * Return formatted user data
     *
     * @return array
     * @throws \Exception
     */
    public function getFormattedUser()
    {
        $responseUser = $this->generateUser();

        return [
            'name' => $responseUser['name'],
            'username' => $responseUser['username'],
            'email' => $this->normalizeEmail($responseUser['username'])
        ];
    }
}