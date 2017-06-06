<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBook()
    {
        Auth::attempt(["email" => "simon@harvan.sk", "password" => "12345"]);
        $response = $this->get(route('admin.books.index'));

        $response->assertStatus(200);
        $this->assertTrue(true);
    }

    public function testCreate()
    {
        Auth::attempt(["email" => "simon@harvan.sk", "password" => "12345"]);
        $response = $this->get(route('admin.books.create'));

        $response->assertStatus(200);
        $this->assertTrue(true);
    }

    public function testStore()
    {
        Auth::attempt(["email" => "simon@harvan.sk", "password" => "12345"]);
        $response = $this->get(route('admin.books.create'),["name" => "Harry Potter", "author" => "J.K.Rowling"]);
        $response->assertStatus(200);
        $this->assertTrue(true);
    }



    public function testEdit()
    {
        Auth::attempt(["email" => "simon@harvan.sk", "password" => "12345"]);
        $response = $this->get(route('admin.books.create', []));

        $response->assertStatus(200);
        $this->assertTrue(true);
    }
}
