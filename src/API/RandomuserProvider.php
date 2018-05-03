<?php

namespace Strelia\API;

class RandomuserProvider extends AProvider
{
    protected $api = 'https://randomuser.me/api';

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
    public function getFormatedUser()
    {
        $responseUser = $this->generateUser()['results'][0];

        return [
            'name' =>  $responseUser['name']['first'] . ' ' . $responseUser['name']['last'],
            'username' => $responseUser['login']['username'],
            'email' => $this->normalizeEmail($responseUser['email'])
        ];
    }
}