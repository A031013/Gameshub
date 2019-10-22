<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterTest extends TestCase
{
    use RegistersUsers;

    protected $redirectTo = '/';


    public function testCreate()
    {
        $data = array(
            "nome" => "bar",
            "email" => "foo@gmail.com",
            "password" => "qwerty123",
            "morada" => "rua qwerty123, 2ºesquerdo 109",
            "cod_postal" => "3434-123",
        );
        $user = User::create([
            'nome' => $data['nome'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'morada' => $data['morada'],
            'cod_postal' => $data['cod_postal'],
        ]);

        $this->assertSame('bar', $user->nome);
        $this->assertSame('foo@gmail.com', $user->email);
    }
    public function testShow(){

        $user = User::find(1);

        $this->assertSame('Nixol', $user->nome);
    }
}
