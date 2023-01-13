<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BooksControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        // create a library, book, and user
        $library = factory(Library::class)->create();
        $book = factory(Book::class)->create(['library_id' => $library->id]);
        $user = factory(User::class)->create(['library_id' => $library->id]);

        // set the subdomain and login the user
        $this->app['config']->set('database.connections.tenant.database', $library->subdomain);
        $this->actingAs($user);

        // call the index method
        $response = $this->get('/books');

        // assert the response
        $response->assertStatus(200);
        $response->assertJson(['data' => [$book->toArray()]]);
    }

    public function testStore()
    {
        // create a library, and user
        $library = factory(Library::class)->create();
        $user = factory(User::class)->create(['library_id' => $library->id]);

        // set the subdomain and login the user
        $this->app['config']->set('database.connections.tenant.database', $library->subdomain);
        $this->actingAs($user);

        // call the store method
        $response = $this->post('/books', [
            'title' => 'Book 1',
            'author' => 'Author 1',
            'ISBN' => '1234567890',
        ]);

        // assert the response
        $response->assertStatus(201);
        $response->assertJson(['data' => [
            'title' => 'Book 1',
            'author' => 'Author 1',
            'ISBN' => '1234567890',
            'library_id' => $library->id,
        ]]);
    }

    // add similar test methods for show, update, and destroy methods
}

