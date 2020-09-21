<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Contrato;
use Illuminate\Http\Request;

class ContratoAPI extends Controller
{
    
    public function index()
    {
        $contratos =Contrato::orderBy('id_contrato', 'asc')
        ->with(['cliente','empresa'])->get();
        
        return response()->json($contratos, 200);
    }
     
    public function show($id)
    {
        $contrato =Contrato::where('id_contrato',$id)->with('cliente')->first();
        if(!$contrato)
            return response()->json(['code'=>'404','erro'=>'Nenhum contratp com esse ID.'], 404);

        return response()->json($contrato, 200);
    }

    public function store(Request $request)
    {
       
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
