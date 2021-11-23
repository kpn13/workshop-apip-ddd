<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\Stock\ApiPlatform\Resource;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;

final class BorrowBookCommandTest extends ApiTestCase
{
    private Client $client;

    public function setUp(): void
    {
        $this->client = static::createClient(defaultOptions: [
            'base_uri' => 'https://localhost',
        ]);
    }

    public function testBorrowBook(): void
    {
        $this->client->request('POST', '/api/books/00000000-0000-0000-0000-000000000001/borrow', [
            'json' => [],
        ]);
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', '/api/stocks/00000000-0000-0000-0000-000000000001');
        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            'quantity' => 9,
        ]);
    }
}
