<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function testRedirectEnglish() {
        $response = $this->get('/');
        $response->assertRedirect('/en');
    }

    public function testUserSeesMainEnglish() {
        $response = $this->get('/en');
        $response->assertSee('Chuck Norris Facts');
        $response->assertViewIs('home');
    }

    public function testUserSeesMainSpanish() {
        $response = $this->get('/es');
        $response->assertSee('Chuck Norris Chistes');
        $response->assertViewIs('home');
    }
}
