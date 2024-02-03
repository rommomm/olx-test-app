<?php

namespace App\Services;

use App\Exceptions\ParsingException;
use Symfony\Component\DomCrawler\Crawler;

class OlxParserService extends AbstractParserService
{

    public function parseProductData(string $productUrl, int $productId = null): ?array
    {
        $id = $productId ?? $this->parseProductId($productUrl);

        $apiUrl = 'https://www.olx.ua/api/v1/targeting/data/';

        $params = [
        'page' => 'ad',
        'params[ad_id]' => $id,
    ];

        $data = $this->getApiData($apiUrl, ['query' => $params])['data']['targeting'];

        if(isset($data['ad_url']) && isset($data['ad_price'])) {
            return [
                'product_link' => $data['ad_url'],
                'initial_price' => $data['ad_price'],
                'product_id' => $data['ad_id'],
            ];
        }

        return [];
    }

    public function parseProductId(string $productUrl): ?string
    {
        $html = $this->fetchHtml($productUrl);
        if ($html) {
            $crawler = new Crawler($html);

            try {
                $idElement = $crawler->filter('span:contains("ID: ")');
                if ($idElement->count() > 0) {
                    return str_replace('ID: ', '', $idElement->text());
                } else {
                    throw new ParsingException($productUrl);
                }

            } catch (\Throwable $e) {
                throw new ParsingException($productUrl);
            }
        }
    }
}
