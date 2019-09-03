<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookResourceTest extends TestCase
{
    use RefreshDatabase;

    /**
     *
     */
    public function testFirstList()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user, 'api')->json('GET', '/api/v1/books');

        $response->assertStatus(200)->assertJson(['data'=>[]]);
    }

    /**
     *
     */
    public function testCreateBook()
    {
        $user = factory(User::class)->create();

        $bookData = [
            'title' => 'My first book',
            'isbn' => '1234568791234',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
        ];

        $response = $this->actingAs($user, 'api')->json('POST', '/api/v1/books', $bookData);

        $response->assertStatus(201)->assertJson([
            'data' => $bookData
        ]);
    }

    /**
     *
     */
    public function testUpdateBook()
    {
        $book = factory(Book::class)->create();
        $user = $book->user;

        $bookData = [
            'title' => 'My first book edited',
            'isbn' => '1234568791234',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
        ];

        $response = $this->actingAs($user, 'api')->json('PUT', '/api/v1/books/'.$book->getKey(), $bookData);

        $response->assertStatus(200)->assertJson([
            'data' => $bookData
        ]);
    }

    /**
     *
     */
    public function testUpdateUnathorizedBook()
    {
        $book = factory(Book::class)->create();
        $user = factory(User::class)->create();

        $bookData = [
            'title' => 'My first book edited',
            'isbn' => '1234568791234',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
        ];

        $response = $this->actingAs($user, 'api')->json('PUT', '/api/v1/books/'.$book->getKey(), $bookData);

        $response->assertStatus(403);
    }

    /**
     *
     */
    public function testDeleteBook()
    {
        $book = factory(Book::class)->create();
        $user = $book->user;

        $response = $this->actingAs($user, 'api')->json('DELETE', '/api/v1/books/'.$book->getKey());

        $response->assertStatus(204);
    }

    /**
     *
     */
    public function testDeleteUnathorizedBook()
    {
        $book = factory(Book::class)->create();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user, 'api')->json('DELETE', '/api/v1/books/'.$book->getKey());

        $response->assertStatus(403);
    }
}
