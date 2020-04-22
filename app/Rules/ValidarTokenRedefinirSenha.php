<?php

declare(strict_types=1);

namespace App\Rules;

use App\Models\RedefinirSenha;
use Illuminate\Contracts\Validation\Rule;

class ValidarTokenRedefinirSenha implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $pwdReset = RedefinirSenha::whereToken($value)
            ->whereDate('validade', '>', now())
            ->whereStatus('A')
            ->latest()
            ->first();

        return $pwdReset ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "O :attribute de validação de redefinição de senha expirou ou está inválido.";
    }
}
