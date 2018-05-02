<?php

namespace Strelia;

interface Generator
{
    /**
     * @return $this|Generator
     */
    public function generateUser();

    /**
     * @return User
     */
    public function getUser();

    /**
     * @return array
     */
    public function getData();
}