<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Contrato;
use Illuminate\Http\Request;

class ContratoAPI extends Controller
{
    
    public function index()
    {
        $contratos = Contrato::orderBy('data_cad', 'asc')
        ->join('clientes', 'clientes.id_cliente', '=','contrato.cli_cod')
        ->join('empresas', 'empresas.id_empresa', '=','contrato.emp_cod')
        ->select('clientes.id_cliente as cli_cod','clientes.nome','clientes.cgc','empresas.id_empresa as emp_cod','empresas.razao_social','empresas.emp_cgc as CNPJ',
        'contrato.id_contrato','contrato.numero','contrato.ativo','contrato.data_cad','contrato.data_alt')
        ->get();
        
        return response()->json($contratos, 200);
    }
     
    public function show($id)
    {
        $contrato =Contrato::where('id_contrato',$id)
        ->orderBy('data_cad', 'asc')
        ->join('clientes', 'clientes.id_cliente', '=','contrato.cli_cod')
        ->join('empresas', 'empresas.id_empresa', '=','contrato.emp_cod')
        ->select('clientes.id_cliente as cli_cod','clientes.nome','clientes.cgc','empresas.id_empresa as emp_cod','empresas.razao_social','empresas.emp_cgc as CNPJ',
        'contrato.id_contrato','contrato.numero','contrato.ativo','contrato.data_cad','contrato.data_alt')
        ->first();
        if(!$contrato)
            return response()->json(['code'=>'404','erro'=>'Nenhum contrato com esse ID.'], 404);

        return response()->json($contrato, 200);
    }

    public function showNumero($numero)
    {
        $contrato =Contrato::where([['contrato.emp_cod',auth('admin')->user()->id_empresa],['numero',$numero]])
        ->orderBy('data_cad', 'asc')
        ->join('clientes', 'clientes.id_cliente', '=','contrato.cli_cod')
        ->join('empresas', 'empresas.id_empresa', '=','contrato.emp_cod')
        ->select('clientes.id_cliente as cli_cod','clientes.nome','clientes.cgc','empresas.id_empresa as emp_cod','empresas.razao_social','empresas.emp_cgc as CNPJ',
        'contrato.id_contrato','contrato.numero','contrato.ativo','contrato.data_cad','contrato.data_alt')
        ->first();
        if(!$contrato)
            return response()->json(['code'=>'404','erro'=>'Nenhum contrato com esse ID.'], 404);

        return response()->json($contrato, 200);
    }

    public function store(Request $request)
    {
        $contPDF = $request->file('contratos');
        if($contPDF == null){
        $path = null;
        }else{
        $path = $contPDF->store('contratos','public');
        }
        
        $contrato = new Contrato;
        $contrato->emp_cod = auth('admin')->user()->id_empresa;
        $contrato->cli_cod = $request->cli_cod;
        $contrato->numero = $request->numero;
        if($path){
        $contrato->path = $path;
        }
        $contrato->ativo = $request->ativo;
        $contrato->data_cad = date('Y-m-d H:i:s');
        $statusSave = $contrato->save();   

        if($statusSave){
            return response()->json(['code'=>'200','Response'=>'Contrato salvo com sucesso'], 200);
        }else{
            return response()->json(['code'=>'400','Response'=>'Bad Request'], 400);
        }
    }

    public function update(Request $request, $id)
    {
        $contPDF = $request->file('contrato');
        if($contPDF == null){
        $path = null;
        }else{
        $path = $contPDF->store('contrato','public');
        }
        
        $contrato = Contrato::find($id);
        if(! $contrato)
        return response()->json(['code'=>'404','erro'=>'Nenhum contrato localizadp com esse ID.'], 404);


        $contrato->numero = $request->numero;
        if($path){
        $contrato->path = $path;
        }
        $contrato->ativo = $request->ativo;
        $contrato->data_cad = date('Y-m-d H:i:s');
        $statusSave = $contrato->save(); 

        if($statusSave){
            return response()->json(['code'=>'200','Response'=>'Contrato atualizado com sucesso'], 200);
        }else{
            return response()->json(['code'=>'400','Response'=>'Bad Request'], 400);
        }
    }

    public function updateNumero(Request $request, $numero)
    {
        $contPDF = $request->file('contrato');
        if($contPDF == null){
        $path = null;
        }else{
        $path = $contPDF->store('contrato','public');
        }
        
        $contrato = Contrato::where([['contrato.emp_cod',auth('admin')->user()->id_empresa],['numero',$numero]])->first();
        if(! $contrato)
        return response()->json(['code'=>'404','erro'=>'Nenhum contrato localizadp com esse numero.'], 404);

        $contrato->numero = $request->numero;
        if($path){
        $contrato->path = $path;
        }
        $contrato->ativo = $request->ativo;
        $contrato->data_alt = date('Y-m-d H:i:s');
        $statusSave = $contrato->save(); 

        if($statusSave){
            return response()->json(['code'=>'200','Response'=>'Contrato atualizado com sucesso'], 200);
        }else{
            return response()->json(['code'=>'400','Response'=>'Bad Request'], 400);
        }
    }

   
    public function destroy($id)
    {
        $contrato = Contrato::find($id);
        if(!$contrato)
            return response()->json(['code'=>'404','erro'=>'Nenhum contrato com esse ID.'], 404);

        $statusCt = $contrato->delete();

        if($statusCt){
            return response()->json(['code'=>'200','Response'=>'Contrato excluido com sucesso'], 200);
        }else{
            return response()->json(['code'=>'400','Response'=>'Bad Request'], 400);
        }
    }

    public function destroyAuth($numero)
    {
        $contrato = Contrato::where([['contrato.emp_cod',auth('admin')->user()->id_empresa],['numero',$numero]])->first;
        if(!$contrato)
            return response()->json(['code'=>'404','erro'=>'Nenhum contrato com esse numero.'], 404);

        $statusCt = $contrato->delete();

        if($statusCt){
            return response()->json(['code'=>'200','Response'=>'Contrato excluido com sucesso'], 200);
        }else{
            return response()->json(['code'=>'400','Response'=>'Bad Request'], 400);
        }
    }
}
