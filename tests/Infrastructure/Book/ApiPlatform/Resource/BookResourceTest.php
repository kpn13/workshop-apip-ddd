<?php

declare(strict_types=1);

namespace App\Tests\Infrastructure\Book\ApiPlatform\Resource;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;
use App\Infrastructure\Book\ApiPlatform\Resource\BookResource;

final class BookResourceTest extends ApiTestCase
{
    private Client $client;

    public function setUp(): void
    {
        $this->client = static::createClient(defaultOptions: [
            'base_uri' => 'https://localhost',
        ]);
    }

    public function testFindBook(): void
    {
        $this->client->request('GET', '/api/books/00000000-0000-0000-0000-000000000001');
        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceItemJsonSchema(BookResource::class);
    }

    public function testFindBooks(): void
    {
        $this->client->request('GET', '/api/books');
        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceCollectionJsonSchema(BookResource::class);
    }

    public function testFindBooksByTitle(): void
    {
        $this->client->request('GET', '/api/books?title=very custom');
        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceCollectionJsonSchema(BookResource::class);
        $this->assertJsonContains([
            'hydra:member' => [[
                '@id' => '/api/books/00000000-0000-0000-0000-000000000001',
            ]],
            'hydra:totalItems' => 1,
        ]);

        $this->client->request('GET', '/api/books?title=foobarbaz');
        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceCollectionJsonSchema(BookResource::class);
        $this->assertJsonContains(['hydra:totalItems' => 0]);
    }

    public function testCreateBook(): void
    {
        $data = [
            'isbn' => '2-7654-1005-4',
            'title' => 'title',
            'description' => 'description',
            'author' => 'author',
            'publicationDate' => '2020-01-01T00:00:00+00:00',
        ];

        $this->client->request('POST', '/api/books', ['json' => $data]);
        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceItemJsonSchema(BookResource::class);
        $this->assertJsonContains($data);
    }

    public function testUpdateBook(): void
    {
        $data = [
            'description' => 'new description',
            'author' => 'ignored author',
        ];

        $this->client->request('PUT', '/api/books/00000000-0000-0000-0000-000000000001', ['json' => $data]);
        $this->assertResponseIsSuccessful();
        $this->assertMatchesResourceItemJsonSchema(BookResource::class);
        $this->assertJsonContains([
            'isbn' => '6613583936',
            'title' => 'a very custom title',
            'description' => 'new description',
            'author' => 'author',
            'publicationDate' => '2021-11-24T00:00:00+00:00',
        ]);
    }
}
