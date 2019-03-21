<?php

namespace IanKok\SurfForecastApiClient\Test\TestLib\FakeClients;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\RequestInterface;
use IanKok\SurfForecastApiClient\Test\TestLib\Exceptions\TestPathNotDefined as TestPathNothDefined;
use function GuzzleHttp\Psr7\build_query;


class FakeGuzzleClient extends Client implements ClientInterface
{
    protected $baseUrl;
    protected $paths;

    public function __construct(array $config = [], array $paths = [])
    {
        $this->paths = $this->paths ?? $paths;
        $this->baseUrl = $config['base_uri'] ?? null;
    }

    public function getConfig($option = null)
    {
        return [];
    }

    public function request($method, $uri = '', array $options = [])
    {
        if ($this->baseUrl) {
            $uri = $this->baseUrl . ((substr($this->baseUrl, -strlen('/')) === (string) '/') ? '' : '/') . ltrim($uri, '/');
        }

        if (isset($options['query'])) {
            $uri .= '?' . build_query($options['query']);
        }

        $path = $this->paths[strtoupper($method)][$uri] ?? null;

        if (! $path) {
            throw new TestPathNothDefined($uri, $method);
        }

        return new Response(200, [], file_get_contents(($path)));
    }

    public function requestAsync($method, $uri = '', array $options = [])
    {
        return $promise = new Promise(
            function () use (&$promise, $method, $uri, $options) {
                $promise->resolve($this->request($method, $uri, $options));
            }
        );
    }

    public function send(RequestInterface $request, array $options = [])
    {
    }

    public function sendAsync(RequestInterface $request, array $options = [])
    {
    }
}
