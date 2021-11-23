<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\Stock\ApiPlatform\Resource;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;
use App\Infrastructure\Stock\ApiPlatform\Resource\StockResource;

final class StockResourceTest extends ApiTestCase
{
    private Client $client;

    public function setUp(): void
    {
        $this->client = static::createClient(defaultOptions: [
            'base_uri' => 'https://localhost',
        ]);
    }

    public function testFindStock(): void
    {
        $this->client->request('GET', '/api/stocks/00000000-0000-0000-0000-000000000001');
        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceItemJsonSchema(StockResource::class);
    }
}
