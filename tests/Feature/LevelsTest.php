<?php

namespace Tests\Feature;


use App\Models\Level\Level;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LevelsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
	    Auth::attempt(["email" => "simon@harvan.sk", "password" => "12345"]);
	    $response = $this->get(route('admin.levels.index'));

	    $response->assertStatus(200);
    }


	public function testCreate()
	{
		Auth::attempt(["email" => "simon@harvan.sk", "password" => "12345"]);
		$response = $this->get(route('admin.levels.create'));
		$response->assertStatus(200);
		$response->assertSee('Create Level');
	}

	public function testStore()
	{
		Auth::attempt(["email" => "simon@harvan.sk", "password" => "12345"]);
		$response = $this->post(route('admin.levels.store'), [
			"name" => "3",
			"min_points" => 30
		]);
		$response->assertStatus(302);

		$level = Level::query()->where("name","=","3")->where("min_points","=", 30)->first();
		$this->assertTrue(isset($level));
		$this->assertTrue($level->min_points == 30);
		$this->assertTrue($level->name == "3");
	}

	public function testUpdate()
	{
		Auth::attempt(["email" => "simon@harvan.sk", "password" => "12345"]);
		$level = Level::query()->where("name","=","3")->where("min_points","=", 30)->first();
		$response = $this->post(route('admin.levels.update',["id" => $level->id]), [
			"name" => "4",
			"min_points" => 40
		]);
		$response->assertStatus(302);

		$level = Level::find($level->id);
		$this->assertTrue(isset($level));
		$this->assertTrue($level->min_points == 40);
		$this->assertTrue($level->name == "4");
	}

	public function testDelete()
	{
		Auth::attempt(["email" => "simon@harvan.sk", "password" => "12345"]);
		$level = Level::query()->where("name","=","4")->where("min_points","=", 40)->first();
		$response = $this->get(route('admin.levels.delete',["id" => $level->id]));
		$response->assertStatus(302);

		$level = Level::find($level->id);
		$this->assertTrue(!isset($level));
	}
}
