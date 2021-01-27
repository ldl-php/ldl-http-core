<?php declare(strict_types=1);

namespace LDL\Http\Core\Request;

use Symfony\Component\HttpFoundation\FileBag;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;
use Symfony\Component\HttpFoundation\ServerBag;

class Request extends SymfonyRequest implements RequestInterface
{
    private $_json = ['body' => null, 'options' => \JSON_THROW_ON_ERROR];

    /**
     * {@inheritdoc}
     */
    public function isPreFlight(): bool
    {
        return $this->isMethod(RequestInterface::HTTP_METHOD_OPTIONS);
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaderBag(): HeaderBag
    {
        return $this->headers;
    }

    public function getClientIp(): string
    {
        return parent::getClientIp();
    }

    public function getQuery(): ParameterBag
    {
        return $this->query;
    }

    /**
     * {@inheritdoc}
     */
    public function isHead(): bool
    {
        return $this->isMethod(RequestInterface::HTTP_METHOD_HEAD);
    }

    /**
     * {@inheritdoc}
     */
    public function isGet(): bool
    {
        return $this->isMethod(RequestInterface::HTTP_METHOD_GET);
    }

    /**
     * {@inheritdoc}
     */
    public function isPost(): bool
    {
        return $this->isMethod(RequestInterface::HTTP_METHOD_POST);
    }

    /**
     * {@inheritdoc}
     */
    public function isPut(): bool
    {
        return $this->isMethod(RequestInterface::HTTP_METHOD_PUT);
    }

    /**
     * {@inheritdoc}
     */
    public function isPatch(): bool
    {
        return $this->isMethod(RequestInterface::HTTP_METHOD_PATCH);
    }

    /**
     * {@inheritdoc}
     */
    public function isDelete(): bool
    {
        return $this->isMethod(RequestInterface::HTTP_METHOD_DELETE);
    }

    /**
     * {@inheritdoc}
     */
    public function isPurge(): bool
    {
        return $this->isMethod(RequestInterface::HTTP_METHOD_PURGE);
    }

    /**
     * {@inheritdoc}
     */
    public function isTrace(): bool
    {
        return $this->isMethod(RequestInterface::HTTP_METHOD_TRACE);
    }

    /**
     * {@inheritdoc}
     */
    public function isConnect(): bool
    {
        return $this->isMethod(RequestInterface::HTTP_METHOD_CONNECT);
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestUri(): string
    {
        return parent::getRequestUri();
    }

    /**
     * {@inheritdoc}
     */
    public function getMethod() : string
    {
        return (string) parent::getMethod();
    }

    /**
     * {@inheritdoc}
     */
    public function getJsonBody(
        int $depth = 512,
        int $options = \JSON_THROW_ON_ERROR
    ) : ?array
    {
        if(null !== $this->_json['body'] && $this->_json['options'] === $options){
            return $this->_json['body'];
        }

        $this->_json['body'] = json_decode($this->getContent(), true , $depth, $options);
        $this->_json['options'] = $options;

        return $this->_json['body'];
    }

    /**
     * {@inheritdoc}
     */
    public function getFiles(): FileBag
    {
        return $this->files;
    }

    /**
     * {@inheritdoc}
     */
    public function getServerParameters() : ServerBag
    {
        return $this->server;
    }

}
