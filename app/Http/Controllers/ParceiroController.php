<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Parceiro;
use Illuminate\Http\Request;

class ParceiroController extends Controller
{
    const PARCEIROS_POR_PAGINA = 6;

    public function __construct(Parceiro $parceiro)
    {
        $this->parceiro = $parceiro;
    }

    public function get()
    {
        $data = $this->parceiro->paginate(self::PARCEIROS_POR_PAGINA);

        return response()->json($data);
    }

    public function find(Parceiro $id)
    {
        $data = ['data' => $id];

        return response()->json($data);
    }
}
