<?php

namespace IanKok\SurfForecastApiClient\Test\TestLib\Exceptions;

use Throwable;

class TestPathNotDefined extends \Exception
{
    public function __construct(
        string $urlPath,
        string $method,
        int $code = 0,
        Throwable $previous = null
    ) {
        $message = 'No path found for URL [' . strtoupper($method) . '][' . $urlPath . ']';
        parent::__construct(
            $message,
            $code,
            $previous
        );
    }
}
