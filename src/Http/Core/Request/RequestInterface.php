<?php

namespace LDL\Http\Core\Request;

use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\ParameterBag;

interface RequestInterface
{
    public const HTTP_METHOD_HEAD = 'HEAD';
    public const HTTP_METHOD_GET = 'GET';
    public const HTTP_METHOD_POST = 'POST';
    public const HTTP_METHOD_PUT = 'PUT';
    public const HTTP_METHOD_PATCH = 'PATCH';
    public const HTTP_METHOD_DELETE = 'DELETE';
    public const HTTP_METHOD_PURGE = 'PURGE';
    public const HTTP_METHOD_OPTIONS = 'OPTIONS';
    public const HTTP_METHOD_TRACE = 'TRACE';
    public const HTTP_METHOD_CONNECT = 'CONNECT';

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
     * @param string $variable
     * @param null $default
     *
     * @return mixed
     */
    public function get(string $variable, $default = null);

    /**
     * @return bool
     */
    public function isHttpMethodValid(): bool;

    /**
     * Returns contents of the request body.
     *
     * @return mixed
     */
    public function getContent();

    /**
     * @return ParameterBag
     */
    public function getQuery(): ParameterBag;

    /**
     * @return bool
     */
    public function isHead(): bool;

    /**
     * @return bool
     */
    public function isGet(): bool;

    /**
     * @return bool
     */
    public function isPost(): bool;

    /**
     * @return bool
     */
    public function isPut(): bool;

    /**
     * @return bool
     */
    public function isPatch(): bool;

    /**
     * @return bool
     */
    public function isDelete(): bool;

    /**
     * @return bool
     */
    public function isPurge(): bool;

    /**
     * @return bool
     */
    public function isTrace(): bool;

    /**
     * @return bool
     */
    public function isConnect(): bool;

}
