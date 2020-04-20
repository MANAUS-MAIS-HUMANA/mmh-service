<?php

declare(strict_types=1);

namespace App\Rules;

use App\Models\RedefinirSenha;
use Illuminate\Contracts\Validation\Rule;

class ValidateIfExistsPasswordReset implements Rule
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
        $pwdReset = RedefinirSenha::whereEmail($value)
            ->whereDate('validade', '>', now())
            ->latest()
            ->first();

        return $pwdReset ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Já existe uma solicitação de redefinição de senha para o e-mail :input.";
    }
}
