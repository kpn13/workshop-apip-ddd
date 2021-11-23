<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\Book\ApiPlatform\Resource;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;

final class PrettifyBookCommandTest extends ApiTestCase
{
    private Client $client;

    public function setUp(): void
    {
        $this->client = static::createClient(defaultOptions: [
            'base_uri' => 'https://localhost',
        ]);
    }

    public function testPrettifyBook(): void
    {
        $this->client->request('POST', '/api/books/00000000-0000-0000-0000-000000000002/prettify', [
            'json' => [],
        ]);
        $this->assertResponseIsSuccessful();

        $this->client->request('GET', '/api/books/00000000-0000-0000-0000-000000000002');
        $this->assertResponseIsSuccessful();
        $this->assertJsonContains([
            'title' => 'Title',
            'author' => 'AUTHOR',
        ]);
    }
}
