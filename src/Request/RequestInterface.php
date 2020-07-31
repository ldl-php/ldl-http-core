<?php

namespace LDL\HTTP\Core\Request;

use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\ParameterBag;

interface RequestInterface
{
    /**
     * Checks if a request is of pre flight type (OPTIONS).
     */
    public function isPreFlight(): bool;

    /**
     * Obtains bag of request headers.
     */
    public function getHeaderBag(): HeaderBag;

    /**
     * Obtains client IP address.
     */
    public function getClientIp(): string;

    /**
     * @param      $variable
     * @param null $default
     *
     * @return mixed
     */
    public function get($variable, $default = null);

    /**
     * Returns contents of the request body.
     *
     * @return mixed
     */
    public function getContent();

    public function getQuery(): ParameterBag;

}
