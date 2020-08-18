<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\User;
use App\Services\ParceiroService;
use App\Services\PerfilService;
use Illuminate\Http\Request;

trait Usuario
{
    /**
     * @var PerfilService
     */
    private PerfilService $perfilService;

    /**
     * Usuario constructor.
     * @param PerfilService $perfilService
     */
    public function __construct(
        PerfilService $perfilService,
        ParceiroService $parceiroService
    ) {
        $this->perfilService = $perfilService;
        $this->parceiroService = $parceiroService;
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

    /**
     * Valida se o e-mail e token pertencem ao usuário.
     *
     * @param User $user
     * @param Request $request
     * @throws \Throwable
     */
    protected function validateEmailAndToken(User $user, Request $request): void
    {
        throw_if(
            $user->email !== $request->email || $user->senha !== $request->token,
            \Exception::class, "O e-mail ou token não pertencem ao usuário!", 500
        );
    }

    protected function getParceiroId(string $email)
    {
        $parceiro = $this->parceiroService->getParceiroByEmail($email);

        return $parceiro->id ?? null;
    }
}
