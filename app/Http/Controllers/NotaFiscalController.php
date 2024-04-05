<?php

namespace App\Http\Controllers;

use App\Models\NotaFiscal;
use Illuminate\Http\Request;

class NotaFiscalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notasFiscais = NotaFiscal::all();
        return response()->json($notasFiscais);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'data_emissao' => 'nullable|date',
            'data_recebimento' => 'nullable|date',
            'cnpj' => 'required|string',
        ]);

        $novaNotaFiscal = NotaFiscal::create([
            'data_emissao' => $request->input('data_emissao'),
            'data_recebimento' => $request->input('data_recebimento'),
            'cnpj' => $request->input('cnpj'),
        ]);

        return response()->json($novaNotaFiscal, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $notaFiscal = NotaFiscal::find($id);

        if (!$notaFiscal) {
            return response()->json(['error' => 'Nota fiscal não encontrada'], 404);
        }

        return response()->json($notaFiscal);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NotaFiscal $notaFiscal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NotaFiscal $notaFiscal)
    {
        //
    }
}
