<?php

namespace Tests\Feature;

use App\Models\RealLibrary\RealLibrary;
use Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LibraryTest extends TestCase {
	/**
	 * A basic test example.
	 *
	 * @return void
	 */

	public function testCreate() {
		Auth::attempt( [ "email" => "simon@harvan.sk", "password" => "12345" ] );
		$response = $this->post( route( 'admin.libraries.store', [
			"name"          => "Ruzinov",
			"url"           => "yaz://arl1.library.sk",
			"port"          => "8887",
			"database_name" => "ruz_un_cat",
			"street"        => "Ruzinovska",
			"street_number" => "8/a",
			"city"          => "Bratislava"
		] ) );

		$response->assertSee( "Libraries" );
		$response->assertStatus(200);
	}

    public function testUpdate()
    {
        Auth::attempt(["email" => "simon@harvan.sk", "password" => "12345"]);
	    $library = RealLibrary::query()->where('url','=','yaz://arl1.library.sk')->first();


        $response = $this->post(route('admin.libraries.update',
	        ["id" => $library->id]),
	        [
	        	"url" => "yaz://arl1.library.test",
	         "port" => 1,
	         "database_name" => "test_database",
	         "name"          => "Ruzinov",
	         "street"        => "Ruzinovska",
	         "street_number" => "8/a",
	         "city"          => "Bratislava"]);


        $response->assertStatus(302);

	    $library = RealLibrary::findOrFail($library->id);
	    $this->assertTrue($library->database_name == 'test_database');





    }

    public function testDelete()
    {
        Auth::attempt(["email" => "simon@harvan.sk", "password" => "12345"]);
	    $library = RealLibrary::query()->where('url','=','yaz://arl1.library.test')->first();
        $response = $this->get(route('admin.libraries.delete', ["id" => $library->id]));
		$response->assertRedirect(route('admin.libraries.index'));
		$response->assertStatus(302);
		$library = RealLibrary::find($library->id);
		$this->assertNull($library);

    }
}
