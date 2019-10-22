<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Jogo;
use DB;

class jogosTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Create()
    {
        $jogo = new Jogo();

        $jogo->nome = 'Game of Thrones';
        $this->assertSame('Game of Thrones', $jogo->nome);

    }
}
