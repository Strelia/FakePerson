<?php

namespace Strelia;


class User
{
    protected $username;
    protected $name;
    protected $email;

    private $mailServices = [
        'gmail-com', 'yahoo-com', 'outlook-com', 'icloud-com', 'mail-ru',
    ];

    /**
     * User constructor.
     * @param $username
     * @param $name
     * @param $email
     */
    public function __construct($username, $name, $email)
    {
        $this->setEmail($email);
        $this->setUsername($username);
        $this->setName($name);
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return self
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return self
     */
    public function setEmail($email)
    {
        if (strpos($email, 'example.com') !== false) {
            $email = substr_replace(
                $email,
                $this->mailServices[rand(0, count($this->mailServices))],
                -(strpos($email, 'example.com'))
            );
        }
        $this->email = $email;
        return $this;
    }

    public function __toString()
    {
        return $this->getName(). ' '. $this->getUsername(). ' '. $this->getEmail();
    }

    public function __toArray()
    {
        return [
            'username' => $this->getUsername(),
            'name' => $this->getName(),
            'email' => $this->getEmail()
        ];
    }

}