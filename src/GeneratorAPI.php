<?php

namespace Strelia;

abstract class GeneratorAPI implements Generator
{
    private $provider;
    private $api;
    private $apiKey;

    protected $user;

    /**
     * GeneratorAPI constructor.
     * @param $provider
     * @param $api
     * @param $apiKey
     */
    public function __construct($provider, $api, $apiKey)
    {
        $this->provider = $provider;
        $this->api = $api;
        $this->apiKey = $apiKey;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->user;
    }

    /**
     * @return $this|Generator
     */
    public abstract function generateUser();

    /**
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @return string
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    protected function getJsonErrorMess($error){
        switch ($error) {
            case JSON_ERROR_DEPTH:
                return 'Maximum stack depth exceeded';
            case JSON_ERROR_STATE_MISMATCH:
                return 'Underflow or the modes mismatch';
            case JSON_ERROR_CTRL_CHAR:
                return 'Unexpected control character found';
            case JSON_ERROR_SYNTAX:
                return 'Syntax error, malformed JSON';
            case JSON_ERROR_UTF8:
                return 'Malformed UTF-8 characters, possibly incorrectly encoded';
            default:
                return 'Unknown error';
        }
    }

    /**
     * @param array $userJson
     */
    protected function initUser($userJson){
        $this->user = new User(
            $userJson['name'] . ' ' . $userJson['surname'],
            explode('@', $userJson['email'])[0],
            $userJson['email']
        );
    }

}