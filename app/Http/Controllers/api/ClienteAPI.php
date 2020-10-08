<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cliempresa;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Empresa;

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

        return response()->json($cliente,200);
    }

    
    public function cgc($cgc)
    {
        $cliente = Cliente::where('cgc',$cgc)->with(['financeiros','contratos'])->first();
        
        if(!$cliente)
            return response()->json(['code'=>'404','erro'=>'Nenhum cliente com esse ID.'], 404);

        return response()->json($cliente,200);
    }

    
    public function store(Request $request)
    {
        $cli = Cliente::where('cgc',$request->cgc)->pluck('id_cliente');
        $empresa = Empresa::where('auth_rest',$request->auth_rest)->pluck('id_empresa');
      
        if(count($cli) > 0){
            $cliEmp = new Cliempresa;  
            $cliEmp->cliente = $cli[0];
            $cliEmp->empresa = $empresa[0];
            $statusCliEmp = $cliEmp->save(); 
            if($statusCliEmp){
                return response()->json(['code'=>'200','Response'=>'Salvo com sucesso'], 200);
            }else{
                return response()->json(['code'=>'400','Response'=>'Bad Request'], 400);
            }
        }else{

            $cliente = new Cliente;
            $cliente->nome = $request->nome;
            $cliente->cgc = $request->cgc;
            $cliente->password = $request->password;
            $cliente->ativo = $request->ativo;
            $cliente->status = $request->status;
            $statusCli = $cliente->save();  

            if($statusCli){
                $cliEmp = new Cliempresa;  
                $cliEmp->cliente = $cliente->id_cliente;
                $cliEmp->empresa = $empresa[0];
                $statusCliEmp = $cliEmp->save(); 
                
                if($statusCliEmp){
                    return response()->json(['code'=>'200','Response'=>'Salvo com sucesso'], 200);
                }else{
                    return response()->json(['code'=>'400','Response'=>'Bad Request'], 400);
                }
            }
        }
        
    }

   
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        if(!$cliente)
        return response()->json(['code'=>'404','erro'=>'Nenhum cliente com esse ID.'], 404);

        $statusCli = $cliente->update($request->all());  

        if($statusCli){
            return response()->json(['code'=>'200','Response'=>'Atualizado com sucesso'], 200);
        }else{
            return response()->json(['code'=>'401','Response'=>'Bad Request'], 401);
        }
    }

   
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $statusDel = $cliente->delete();

        if($statusDel){
            return response()->json(['code'=>'200','Response'=>'Cliente apagado com sucesso'], 200);
        }else{
            return response()->json(['code'=>'401','Response'=>'Bad Request'], 401);
        }
    }
}
