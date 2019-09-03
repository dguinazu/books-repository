<?php

namespace Tests\Feature;

use Tests\TestCase;

class UnauthorizedTest extends TestCase
{
    public function testGet()
    {
        $response = $this->json('GET', '/api/v1/books');

        $response->assertStatus(401);
    }

    public function testPost()
    {
        $response = $this->json('POST', '/api/v1/books', [
            'title' => 'My first book',
            'isbn' => '1234568791234',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
        ]);

        $response->assertStatus(401);
    }

    public function testPut()
    {
        $response = $this->json('PUT', '/api/v1/books/1', [
            'title' => 'My first book',
            'isbn' => '1234568791234',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
        ]);

        $response->assertStatus(401);
    }

    public function testDelete()
    {
        $response = $this->json('DELETE', '/api/v1/books/1');

        $response->assertStatus(401);
    }
}