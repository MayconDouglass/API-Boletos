<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cliempresa;
use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteAPI extends Controller
{
   

    public function index()
    {
        $clientes =json_decode(Cliente::with(['financeiros'=> function ($query) {
            $query->orderBy('dt_emissao', 'desc');
        },
        'contratos'])->get(), true);
       return response()->json(array(
            'Clientes' => $clientes,
            'status' => 'success'
        ), 200);
    }

    public function show($id)
    {
        $cliente = Cliente::where('id_cliente',$id)->with(['financeiros','contratos'])->first();
        
        if(!$cliente)
            return response()->json(['code'=>'404','erro'=>'Nenhum cliente com esse ID.'], 404);

        return $cliente;
    }

    
    public function cgc($cgc)
    {
        $cliente = Cliente::where('cgc',$cgc)->with(['financeiros','contratos'])->first();
        
        if(!$cliente)
            return response()->json(['code'=>'404','erro'=>'Nenhum cliente com esse ID.'], 404);

        return $cliente;
    }

    
    public function store(Request $request)
    {
        $cliente = new Cliente;
        $cliente->save($request->all());  
    }

   
    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
