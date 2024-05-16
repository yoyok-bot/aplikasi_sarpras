<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testtampilhalaman()
    {
        $user = User::role('admin')->get()->random();
        $this->actingAs($user);
        $this->get('/roles')
        ->assertOk();
    }
    public function testtidaktampilhalaman()
    {
        $user = User::role('kepsek')->get()->random();
        $this->actingAs($user)
        ->get('roles')
        ->assertStatus(403);
    }
    public function testbelumlogin()
    {
        $this->get('roles')
        ->assertRedirect('login')
        ->assertStatus(302);
    }
    public function testbisabuatrole()
    {
        $user = User::role('admin')->get()->random();
        $this->actingAs($user);
        $this->get('/roles/create')
        ->assertOk();
    }
    public function testtidakbuatrole()
    {
        $user = User::role('guru')->get()->random();
        $this->actingAs($user);
        $this->get('/roles/create')
        ->assertStatus(403);
    }
}

