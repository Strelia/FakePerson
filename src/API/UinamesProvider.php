<?php

namespace Strelia\API;

class UinamesProvider extends AProvider
{
    protected $api = 'https://uinames.com/api/?ext';

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
            'name' =>  $responseUser['name'] . ' ' . $responseUser['surname'],
            'username' => explode('@', $responseUser['email'])[0],
            'email' => $this->normalizeEmail($responseUser['email'])
        ];
    }

}