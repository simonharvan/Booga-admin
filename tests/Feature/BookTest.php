<?php

namespace Tests\Feature;

use App\Models\Admin\Admin;
use App\Models\Book\BookType;
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
        $response->assertSee('Books');

    }

    public function testCreate()
    {
        Auth::attempt(["email" => "simon@harvan.sk", "password" => "12345"]);
        $response = $this->get(route('admin.books.create'));

        $response->assertStatus(200);
	    $response->assertSee('Create book');

    }

    public function testStore()
    {
        Auth::attempt(["email" => "simon@harvan.sk", "password" => "12345"]);
	    $admin = Admin::query()->where("email", "=", "simon@harvan.sk")->first();
	    $points = $admin->points;
        $response = $this->post(route('admin.books.create'),["name" => "Test Test",
                                                             "author" => "Test test test",
                                                             "isbn" => "1234567890",
                                                             "year_published" => "1999",
                                                             "focus_level" => "4",
                                                             "energy" => "20",
                                                             "time_clearing" => "20",
                                                             "genre" => "1"
        ,"cover_photo_url" => "https://www.slovakrail.sk/fileadmin/templates/images/logo_zssk.png"]);


	    $response->assertStatus(302);

	    $book = BookType::query()->where('name','=','Test Test')->first();

	    $this->assertTrue($book->author_name == 'Test test test');

	    $admin = Admin::query()->where("email", "=", "simon@harvan.sk")->first();
	    $this->assertTrue($admin->points == $points + 5);
    }



    public function testEdit()
    {
        Auth::attempt(["email" => "simon@harvan.sk", "password" => "12345"]);
        $response = $this->get(route('admin.books.create'));

        $response->assertStatus(200);

    }

    public function testDelete()
    {
	    Auth::attempt(["email" => "simon@harvan.sk", "password" => "12345"]);


	    $book = BookType::query()->where('name','=','Test Test')->first();


	    $response = $this->get(route('admin.books.delete', $book->id));


	    $response->assertStatus(302);
	    $response->assertDontSee("Test Test");
    }
}
