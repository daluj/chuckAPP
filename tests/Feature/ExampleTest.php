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

    public function testRandomJokeNoEmail() {
        $query = array(
            'action' => 'random'
        );
        $response = $this->get('/en/chuck?'.http_build_query($query));
        $response->assertSee('Facts');
        $response->assertViewIs('chuck');

        $response = $this->get('/es/chuck?'.http_build_query($query));
        $response->assertSee('Chistes');
        $response->assertViewIs('chuck');
    }

    public function testCategoryJokeNoEmail() {
        $query = array(
            'action' => 'category',
            'category' => 'fashion'
        );
        $response = $this->get('/en/chuck?'.http_build_query($query));
        $response->assertSee('Facts');
        $response->assertViewIs('chuck');

        $response = $this->get('/es/chuck?'.http_build_query($query));
        $response->assertSee('Chistes');
        $response->assertViewIs('chuck');
    }

    public function testQueryJokeNoEmail() {
        $query = array(
            'action' => 'words',
            'word'   => 'animal'
        );
        $response = $this->get('/en/chuck?'.http_build_query($query));
        $response->assertSee('Facts');
        $response->assertViewIs('chuck');

        $response = $this->get('/es/chuck?'.http_build_query($query));
        $response->assertSee('Chistes');
        $response->assertViewIs('chuck');
    }

    public function testRandomJokeSendEmail() {
        $query = array(
            'action' => 'random',
            'email'  => 'test@email.com'
        );
        $response = $this->get('/en/chuck?'.http_build_query($query));
        $response->assertSee('Email sent');

        $response = $this->get('/es/chuck?'.http_build_query($query));
        $response->assertSee('Email enviado');
    }
}
