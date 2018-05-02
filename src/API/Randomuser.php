<?php

namespace Strelia\API;

use Curl\Curl;
use Strelia\Generator;
use Strelia\GeneratorAPI;
use Strelia\User;

class Randomuser extends GeneratorAPI
{
    public function __construct()
    {
        parent::__construct('randomuser', 'https://randomuser.me/api', null);
    }

    /**
     * @return $this|Generator
     * @throws \Exception
     */
    public function generateUser()
    {
        do {
            $curl = new Curl();
            $curl->get($this->getApi());
            if ($curl->error) {
                throw new \Exception($curl->errorMessage, $curl->errorCode);
            } else {
                $userJson = json_decode($curl->response)['result'][0];
                if (json_last_error() !== 0) {
                    throw new \Exception($this->getJsonErrorMess(json_last_error()));
                }

                $this->user = new User(
                    $userJson['name']['first'] . ' ' . $userJson['name']['last'],
                    $userJson['login']['username'],
                    $userJson['email']
                );
            }
            $curl->close();
        } while (!preg_match('/^[-a-zA-Z0-9_\$]{4, 12}$/', $this->user->getUserName()));
        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return array_merge(['provider' => $this->getProvider()],parent::getData());
    }
}