<?php

namespace LDL\Http\Core\Response;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;

interface ResponseInterface
{
    const HTTP_CODE_CONTINUE = 100;
    const HTTP_CODE_SWITCHING_PROTOCOLS = 101;
    const HTTP_CODE_PROCESSING = 102;            // RFC2518
    const HTTP_CODE_EARLY_HINTS = 103;           // RFC8297
    const HTTP_CODE_OK = 200;
    const HTTP_CODE_CREATED = 201;
    const HTTP_CODE_ACCEPTED = 202;
    const HTTP_CODE_NON_AUTHORITATIVE_INFORMATION = 203;
    const HTTP_CODE_NO_CONTENT = 204;
    const HTTP_CODE_RESET_CONTENT = 205;
    const HTTP_CODE_PARTIAL_CONTENT = 206;
    const HTTP_CODE_MULTI_STATUS = 207;          // RFC4918
    const HTTP_CODE_ALREADY_REPORTED = 208;      // RFC5842
    const HTTP_CODE_IM_USED = 226;               // RFC3229
    const HTTP_CODE_MULTIPLE_CHOICES = 300;
    const HTTP_CODE_MOVED_PERMANENTLY = 301;
    const HTTP_CODE_FOUND = 302;
    const HTTP_CODE_SEE_OTHER = 303;
    const HTTP_CODE_NOT_MODIFIED = 304;
    const HTTP_CODE_USE_PROXY = 305;
    const HTTP_CODE_RESERVED = 306;
    const HTTP_CODE_TEMPORARY_REDIRECT = 307;
    const HTTP_CODE_PERMANENTLY_REDIRECT = 308;  // RFC7238
    const HTTP_CODE_BAD_REQUEST = 400;
    const HTTP_CODE_UNAUTHORIZED = 401;
    const HTTP_CODE_PAYMENT_REQUIRED = 402;
    const HTTP_CODE_FORBIDDEN = 403;
    const HTTP_CODE_NOT_FOUND = 404;
    const HTTP_CODE_METHOD_NOT_ALLOWED = 405;
    const HTTP_CODE_NOT_ACCEPTABLE = 406;
    const HTTP_CODE_PROXY_AUTHENTICATION_REQUIRED = 407;
    const HTTP_CODE_REQUEST_TIMEOUT = 408;
    const HTTP_CODE_CONFLICT = 409;
    const HTTP_CODE_GONE = 410;
    const HTTP_CODE_LENGTH_REQUIRED = 411;
    const HTTP_CODE_PRECONDITION_FAILED = 412;
    const HTTP_CODE_REQUEST_ENTITY_TOO_LARGE = 413;
    const HTTP_CODE_REQUEST_URI_TOO_LONG = 414;
    const HTTP_CODE_UNSUPPORTED_MEDIA_TYPE = 415;
    const HTTP_CODE_REQUESTED_RANGE_NOT_SATISFIABLE = 416;
    const HTTP_CODE_EXPECTATION_FAILED = 417;
    const HTTP_CODE_I_AM_A_TEAPOT = 418;                                               // RFC2324
    const HTTP_CODE_MISDIRECTED_REQUEST = 421;                                         // RFC7540
    const HTTP_CODE_UNPROCESSABLE_ENTITY = 422;                                        // RFC4918
    const HTTP_CODE_LOCKED = 423;                                                      // RFC4918
    const HTTP_CODE_FAILED_DEPENDENCY = 424;                                           // RFC4918

    /**
     * @deprecated
     */
    const HTTP_CODE_RESERVED_FOR_WEBDAV_ADVANCED_COLLECTIONS_EXPIRED_PROPOSAL = 425;   // RFC2817
    const HTTP_CODE_TOO_EARLY = 425;                                                   // RFC-ietf-httpbis-replay-04
    const HTTP_CODE_UPGRADE_REQUIRED = 426;                                            // RFC2817
    const HTTP_CODE_PRECONDITION_REQUIRED = 428;                                       // RFC6585
    const HTTP_CODE_TOO_MANY_REQUESTS = 429;                                           // RFC6585
    const HTTP_CODE_REQUEST_HEADER_FIELDS_TOO_LARGE = 431;                             // RFC6585
    const HTTP_CODE_UNAVAILABLE_FOR_LEGAL_REASONS = 451;
    const HTTP_CODE_INTERNAL_SERVER_ERROR = 500;
    const HTTP_CODE_NOT_IMPLEMENTED = 501;
    const HTTP_CODE_BAD_GATEWAY = 502;
    const HTTP_CODE_SERVICE_UNAVAILABLE = 503;
    const HTTP_CODE_GATEWAY_TIMEOUT = 504;
    const HTTP_CODE_VERSION_NOT_SUPPORTED = 505;
    const HTTP_CODE_VARIANT_ALSO_NEGOTIATES_EXPERIMENTAL = 506;                        // RFC2295
    const HTTP_CODE_INSUFFICIENT_STORAGE = 507;                                        // RFC4918
    const HTTP_CODE_LOOP_DETECTED = 508;                                               // RFC5842
    const HTTP_CODE_NOT_EXTENDED = 510;                                                // RFC2774
    const HTTP_CODE_NETWORK_AUTHENTICATION_REQUIRED = 511;                             // RFC6585

    public function sendHeaders();

    public function sendContent();

    public function send();

    public function setContent($content);

    public function getContent();

    public function setProtocolVersion(string $version);

    public function getProtocolVersion(): string;

    public function setStatusCode(int $code, $text = null);

    public function getStatusCode(): int;

    public function setCharset(string $charset);

    public function getCharset(): ?string;

    public function isCacheable(): bool;

    public function isFresh(): bool;

    public function isValidateable(): bool;

    public function setPrivate();

    public function setPublic();

    public function setImmutable(bool $immutable = true);

    public function isImmutable(): bool;

    public function mustRevalidate(): bool;

    public function getDate(): ?\DateTimeInterface;

    public function setDate(\DateTimeInterface $date);

    public function getAge(): int;

    public function expire();

    public function getExpires(): ?\DateTimeInterface;

    public function setExpires(\DateTimeInterface $date = null);

    public function getMaxAge(): ?int;

    public function setMaxAge(int $value);

    public function setSharedMaxAge(int $value);

    public function getTtl(): ?int;

    public function setTtl(int $seconds);

    public function setClientTtl(int $seconds);

    public function getLastModified(): ?\DateTimeInterface;

    public function setLastModified(\DateTimeInterface $date = null);

    public function getEtag(): ?string;

    public function setEtag(string $etag = null, bool $weak = false);

    public function setCache(array $options);

    public function setNotModified();

    public function hasVary(): bool;

    public function getVary(): array;

    public function setVary($headers, bool $replace = true);

    public function isInvalid(): bool;

    public function isInformational(): bool;

    public function isSuccessful(): bool;

    public function isRedirection(): bool;

    public function isClientError(): bool;

    public function isServerError(): bool;

    public function isOk(): bool;

    public function isForbidden(): bool;

    public function isNotFound(): bool;

    public function isRedirect(string $location = null): bool;

    public function isEmpty(): bool;

    public function getHeaderBag(): ResponseHeaderBag;
}