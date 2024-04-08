<?php

namespace App\Http\Controllers;

use App\Models\NotaFiscal;
use App\Models\NotaFiscalLog;
use Exception;
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
        try {
            $request->validate([
                'data_emissao' => 'nullable|date',
                'data_recebimento' => 'nullable|date',
                'cnpj' => 'required|string',
            ]);
            
            $typescriptUrl = env('TYPESCRIPT_URL');
            $ch = curl_init($typescriptUrl.'/valida?cnpj='.$request->input('cnpj'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = json_decode(curl_exec($ch));
            curl_close($ch);
            if ($response->isValid === false) {
                NotaFiscalLog::create([
                    'cnpj' => $request->input('cnpj'),
                    'descricao' => "Cnpj inválido",
                ]);
                return response()->json(["message"=> "CNPJ inválido"], 200)->header("Access-Control-Allow-Origin",  "*");;
            } 

            $novaNotaFiscal = NotaFiscal::create([
                'data_emissao' => $request->input('data_emissao'),
                'data_recebimento' => $request->input('data_recebimento'),
                'cnpj' => $request->input('cnpj'),
            ]);
            return response()->json(["message"=>$novaNotaFiscal], 201)->header("Access-Control-Allow-Origin",  "*");

        } catch (Exception $e) {
            return response()->json(["message"=> "Erro ao inserir a nota fiscal ".$e->getMessage()], 400)->header("Access-Control-Allow-Origin",  "*");;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $notaFiscal = NotaFiscal::find($id);

        if (!$notaFiscal) {
            return response()->json(['message' => 'Nota fiscal não encontrada'], 200)->header("Access-Control-Allow-Origin",  "*");;
        }

        return response()->json(["message"=>$notaFiscal],200)->header("Access-Control-Allow-Origin",  "*");;
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
