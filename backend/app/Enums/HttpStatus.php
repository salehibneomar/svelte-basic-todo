<?php

namespace App\Enums;

enum HttpStatus: int
{
    case OK = 200;
    case CREATED = 201;
    case NO_CONTENT = 204;
    case BAD_REQUEST = 400;
    case UNAUTHORIZED = 401;
    case FORBIDDEN = 403;
    case NOT_FOUND = 404;
    case INTERNAL_SERVER_ERROR = 500;

    public function message(): string
    {
        return match ($this) {
            self::OK => 'success',
            self::CREATED => 'created',
            self::NO_CONTENT => 'no content',
            self::BAD_REQUEST => 'bad request',
            self::UNAUTHORIZED => 'unauthorized',
            self::FORBIDDEN => 'forbidden',
            self::NOT_FOUND => 'not found',
            self::INTERNAL_SERVER_ERROR => 'internal server error',
        };
    }
}
