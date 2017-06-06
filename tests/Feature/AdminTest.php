<?php

namespace Tests\Feature;

use App\Models\Admin\Admin;
use App\Models\AdminLog\AdminLog;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testStart()
    {
        DB::statement("SET foreign_key_checks=0");
        AdminLog::truncate();
        Admin::truncate();
        DB::statement("SET foreign_key_checks=1");

        $admin = new Admin();
        $admin->name = "Simon Harvan";
        $admin->password = Hash::make("12345");
        $admin->email = "simon@harvan.sk";
        $admin->points = 0;
        $admin->save();

        $admin = Admin::all()->where("email", "=", "simon@harvan.sk");
        $this->assertTrue(isset($admin));

    }

    public function testAdmin()
    {
        Auth::attempt(["email" => "simon@harvan.sk", "password" => "12345"]);

        $response = $this->get(route('admin.admins.index'));

        $response->assertSee('Admins');
        $response->assertDontSee('Add library');
        $response->assertStatus(200);

    }

    public function testCreate()
    {
        Auth::attempt(["email" => "simon@harvan.sk", "password" => "12345"]);

        $response = $this->post(route('admin.admins.store', ["name" => "Testik test", "password" => "123456", "email" => "testik@testik.sk"]));


        $response->assertSee("Redirecting");
        $response->assertStatus(302);
    }

    public function testAuth()
    {

        Auth::attempt(["email" => "testik@testik.sk", "password" => "123456"]);
        $response = $this->get(route('admin.admins.index'));

        $response->assertSee("Testik test");
        $response->assertStatus(200);

    }

    public function testDelete()
    {
        Auth::attempt(["email" => "simon@harvan.sk", "password" => "12345"]);


        $response = $this->get(route('admin.admins.index'));

        $response->assertSee("Testik test");

        $admins = Admin::all()->where("email", "=", "testik@testik.sk");
        $this->assertFalse(is_null($admins));
        foreach ($admins as $admin) {
            if ($admin->email == "testik@testik.sk") {
                $response = $this->get(route('admin.admins.delete', ["id", $admin->id]));

                $response->assertStatus(500);
                return;
            }
        }
        $response = $this->get(route('admin.admins.index'));

        $response->assertStatus(200);
        $response->assertDontSee("Testik test");

    }
}
