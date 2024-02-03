<?php

namespace App\Services;

use App\Exceptions\ParsingException;
use GuzzleHttp\Client;

abstract class AbstractParserService
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    abstract public function parseProductId(string $productUrl): ?string;

    abstract public function parseProductData(string $productUrl, int $productId = null): ?array;

    protected function fetchHtml(string $url): ?string
    {
        try {
            $response = $this->client->get($url);
            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            throw new ParsingException($url);
        }
    }

    public function getApiData($url, $params)
    {
        try {
            $response = $this->client->get($url, $params);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            throw new ParsingException($url);
        }
    }

}
