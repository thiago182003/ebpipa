<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Pipeiro_user;

class VerificarCpfTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function retorna_found_true_quando_cpf_existir()
    {
        $user = Pipeiro_user::factory()->create([
            'cpf' => '12345678901',
            'nome' => 'Usuario Teste',
            'email' => 'teste@example.com'
        ]);

        $response = $this->postJson(route('portal.verificar-cpf'), [
            'cpf' => '123.456.789-01',
            'email' => 'teste@example.com',
            'nome' => 'Usuario Teste'
        ]);

        $response->assertStatus(200)->assertJsonFragment(['found' => true]);
        $this->assertEquals($user->id, $response->json('user.id'));
    }

    /** @test */
    public function retorna_found_false_quando_cpf_nao_existir()
    {
        $response = $this->postJson(route('portal.verificar-cpf'), [
            'cpf' => '000.000.000-00',
            'email' => 'nao@existe.com',
            'nome' => 'Nome'
        ]);

        $response->assertStatus(200)->assertJson(['found' => false]);
    }

    /** @test */
    public function retorna_422_para_cpf_invalido()
    {
        $response = $this->postJson(route('portal.verificar-cpf'), [
            'cpf' => '123',
            'email' => 'x@x.com',
            'nome' => 'x'
        ]);

        $response->assertStatus(422);
    }
}
