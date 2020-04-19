<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Pessoa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * @var PessoaService
     */
    private PessoaService $pessoaService;

    /**
     * AuthService constructor.
     * @param PessoaService $pessoaService
     */
    public function __construct(PessoaService $pessoaService)
    {
        $this->pessoaService = $pessoaService;
    }

    /**
     * Cria o usuário
     *
     * @param Request $request
     * @return array
     */
    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            $pessoa = $this->createPessoa($request);

            $usuario = User::create([
                'email' => $request->email,
                'senha' => Hash::make($request->senha),
                'pessoa_id' => $pessoa->id,
            ]);

            throw_if(!$usuario, \Exception::class, ['Não foi possível criar o usuaŕio!', 500]);

            $this->perfisAttach($usuario, $request->perfis);

            DB::commit();

            auth()->login($usuario);

            return [
                'success' => true,
                'data' => $usuario,
                'message' => 'Usuário criado com sucesso!',
                'code' => 201
            ];
        } catch (\Throwable $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ];
        }
    }

    /**
     * Solicita a criação de Pessoa
     *
     * @param Request $request
     * @return Pessoa
     * @throws \Throwable
     */
    private function createPessoa(Request $request): Pessoa
    {
        $pessoa = $this->pessoaService->create($request);

        throw_if(!$pessoa['success'], \Exception::class, [$pessoa['message'], $pessoa['code']]);

        return $pessoa['data'];
    }

    /**
     * @param User $user
     * @param array $perfis
     */
    private function perfisAttach(User $user, array $perfis): void
    {
        $user->perfis()->attach(data_get($perfis, '*.id'));
    }
}
