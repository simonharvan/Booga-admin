<?php

namespace Tests\Feature;

use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LibraryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLibrary()
    {
        Auth::attempt(["email" => "simon@harvan.sk", "password" => "12345"]);
        $response = $this->post(route('admin.libraries.test'), ["query" => "Harry Potter"]);


        $response->assertStatus(200);
    }

    public function testCreate()
    {
        Auth::attempt(["email" => "simon@harvan.sk", "password" => "12345"]);
        $response = $this->post(route('admin.libraries.store', ["url" => "yaz://arl1.library.sk","port" => 8887, "database" => "ruz_un_cat"]));

        $response->assertSee("Libraries");
        $response->assertStatus(200);
    }

    public function testUpdate()
    {
        Auth::attempt(["email" => "simon@harvan.sk", "password" => "12345"]);
        $response = $this->post(route('admin.libraries.update', ["id" => "1"]), ["url" => "yaz://arl1.library.sk","port" => 8887, "database" => "ruz_un_cat"]);
        $response->assertSee("Libraries");
        $response->assertStatus(200);
    }

    public function testDelete()
    {
        Auth::attempt(["email" => "simon@harvan.sk", "password" => "12345"]);
        $response = $this->get(route('admin.libraries.delete', ["id" => "1"]));

        $response->assertStatus(200);
    }
}
