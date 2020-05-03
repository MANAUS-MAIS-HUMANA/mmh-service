<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parceiro;
use App\Services\ParceiroService;

class ParceiroController extends Controller
{
    const PARCEIROS_POR_PAGINA = 6;

    private ParceiroService $parceiroService;

    public function __construct(Parceiro $parceiro)
    {
        $this->parceiro = $parceiro;
        $this->parceiroService = new ParceiroService();
    }

    public function get()
    {
        $data = $this->parceiro->paginate(self::PARCEIROS_POR_PAGINA);

        return response()->json($data);
    }

    public function find(Request $request, string $id)
    {
        $resultado = $this->parceiroService->find($id);
        if ($resultado['success']) {
            $dado = ['data' => $resultado['data']];
            return response()->json($dado, $resultado['code']);
        }

        return response()->json($resultado['message'], $resultado['code']);
    }

    public function store(Request $request)
    {
        $resultado = $this->parceiroService->create($request);

        if ($resultado['success']) {
            $dado = ['data' => ['id' => $resultado['data']->id]];
            return response()->json($dado, $resultado['code']);
        }

        return response()->json($resultado['message'], $resultado['code']);
    }

    public function update(Request $request, string $id)
    {
        $resultado = $this->parceiroService->update($request, $id);

        if ($resultado['success']) {
            $dado = ['data' => null];
            return response()->json($dado, $resultado['code']);
        }

        return response()->json($resultado['message'], $resultado['code']);
    }

    public function delete(Request $request, string $id)
    {
        $resultado = $this->parceiroService->delete($request, $id);

        if ($resultado['success']) {
            $dado = ['data' => null];
            return response()->json($dado, $resultado['code']);
        }

        return response()->json($resultado['message'], $resultado['code']);
    }
}
