<?php

declare(strict_types=1);

namespace App\Traints;

use App\Models\Pessoa;
use App\Models\User;
use App\Services\PerfilService;
use App\Services\PessoaService;
use Illuminate\Http\Request;

trait Usuario
{
    /**
     * @var PessoaService
     */
    private PessoaService $pessoaService;
    /**
     * @var PerfilService
     */
    private PerfilService $perfilService;

    /**
     * Usuario constructor.
     * @param PessoaService $pessoaService
     * @param PerfilService $perfilService
     */
    public function __construct(
        PessoaService $pessoaService,
        PerfilService $perfilService
    ) {
        $this->pessoaService = $pessoaService;
        $this->perfilService = $perfilService;
    }

    /**
     * Solicita a criação da pessoa.
     *
     * @param Request $request
     * @return Pessoa
     * @throws \Throwable
     */
    protected function createPessoa(Request $request): Pessoa
    {
        $pessoa = $this->pessoaService->create($request);

        throw_if(
            !$pessoa['success'] ??= [], \Exception::class, $pessoa['message'], $pessoa['code']
        );

        return data_get($pessoa, 'data');
    }

    /**
     * Solicita a atualização da pessoa.
     *
     * @param int $id
     * @param Request $request
     * @throws \Throwable
     */
    protected function updatePessoa(int $id, Request $request): void
    {
        $pessoa = $this->pessoaService->update($id, $request);

        throw_if(
            !$pessoa['success'] ??= [], \Exception::class, $pessoa['message'], $pessoa['code']
        );
    }

    /**
     * Associa o usuário ao perfil pelo nome do perfil.
     *
     * @param User $user
     * @param string $perfil
     * @throws \Throwable
     */
    protected function perfilByNameAttach(User $user, string $perfil): void
    {
        $perfil = $this->perfilService->getByPerfil($perfil);

        throw_if(
            !$perfil['success'], \Exception::class, $perfil['message'], $perfil['code']
        );

        $perfil = data_get($perfil, 'data');

        $user->perfis()->attach($perfil->id);
    }

    /**
     * Associa o usuário ao perfil pelo id.
     *
     * @param User $user
     * @param array $perfis
     */
    protected function perfilByIdsAttach(User $user, array $perfis): void
    {
        $user->perfis()->attach(data_get($perfis, '*.id'));
    }

    /**
     * Sincroniza o usuário ao perfil pelo id.
     *
     * @param User $user
     * @param array $perfis
     */
    protected function perfilByIdsSync(User $user, array $perfis): void
    {
        $user->perfis()->sync(data_get($perfis, '*.id'));
    }

    /**
     * Retorna o usuário pelo e-mail.
     *
     * @param Request $request
     * @return User
     * @throws \Exception
     */
    protected function getUsuarioByEmail(Request $request): User
    {
        try {
            $usuario = User::whereEmail($request->email)
                ->first();

            throw_if(
                !$usuario, \Exception::class, 'Usuário não encontrado!', 404
            );

            return $usuario;
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}
