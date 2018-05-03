<?php

namespace Strelia\API;

use Curl\Curl;

abstract class AProvider
{
    protected $api;

    /**
     * @throws \ErrorException
     * @throws \Exception
     */
    protected function generateUser()
    {
        $curl = new Curl();
        $curl->setJsonDecoder([__CLASS__, 'requestToString']);
        $curl->setOpt(CURLOPT_FOLLOWLOCATION, true);
        $curl->setOpt(CURLOPT_SSL_VERIFYHOST, false);
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
        $curl->get($this->api);
        if ($curl->error) {
            throw new \Exception($curl->errorMessage, $curl->errorCode);
        } else {
            $userJson = $this->validJson($curl->response);
        }
        $curl->close();

        return $userJson;
    }

    static function requestToString($request) {
        return $request;
    }

    protected function normalizeEmail($email){
        if (strpos($email, '@') === false) {
            return $email . '@' . $this->getRandomMailServices();
        }

        if (strpos($email, 'example') !== false) {
            return substr_replace(
                $email,
                $this->getRandomMailServices(),
                (strpos($email, 'example')) . $this->getRandomMailServices()
            );
        }

        return $email;
    }

    private function getRandomMailServices(){
        static $mailServices = [
            'gmail.com', 'yahoo.com', 'outlook.com', 'icloud.com', 'mail.ru',
        ];

        return $mailServices[rand(0, count($mailServices) - 1)];
    }

    /**
     * @param $resonse
     * @return array
     * @throws \Exception
     */
    protected function validJson($response){
        $json = json_decode($response, true);
        if (json_last_error() !== 0) {
            throw new \Exception($this->getJsonErrorMess(json_last_error()));
        }
        return $json;
    }

    private function getJsonErrorMess($error){
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
     * Return Json from API server
     *
     * @return array
     */
    abstract public function getUser();

    /**
     * Return formatted user data
     *
     * @return array
     */
    abstract public function getFormatedUser();

}