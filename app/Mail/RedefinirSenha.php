<?php

namespace App\Mail;

use App\Models\User;
use App\Models\RedefinirSenha As RedefinirSenhaModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RedefinirSenha extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    private User $user;
    /**
     * @var RedefinirSenhaModel
     */
    private RedefinirSenhaModel $redefinirSenha;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param RedefinirSenhaModel $redefinirSenha
     */
    public function __construct(User $user, RedefinirSenhaModel $redefinirSenha)
    {
        $this->user = $user;
        $this->redefinirSenha = $redefinirSenha;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Redefinição de Senha')
            ->markdown('emails.redefinir_senha')
            ->with([
                'user' => $this->user,
                'redefinirSenha' => $this->redefinirSenha,
                'token' => base64_encode("{$this->redefinirSenha->email}&&{$this->redefinirSenha->token}&&{$this->redefinirSenha->validade}")
            ]);
    }
}
