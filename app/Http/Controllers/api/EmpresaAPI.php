<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cliempresa;
use App\Models\Contrato;
use Illuminate\Http\Request;
use App\Models\Empresa;

class EmpresaAPI extends Controller
{
    
    public function index()
    {
      $empresas =json_decode(Empresa::orderBy('id_empresa', 'asc')->get(),true);

       //return response()->json($empresas, 200);
       return response()->json($empresas, 200);
    }

    
    public function store(Request $request)
    {
        $empCGC = Empresa::where('emp_cgc',$request->emp_cgc)->get();
        if(count($empCGC) > 0){
            return response()->json(['code'=>'400','Response'=>'Empresa ja cadastrada'], 400);
        }else{

            $empresa = new Empresa;
            $empresa->emp_cod = $request->emp_cod;
            $empresa->razao_social = $request->razao_social;
            $empresa->emp_cgc = $request->emp_cgc;
            $empresa->emp_tel = $request->emp_tel;
            $empresa->auth_rest = hash('md5', $request->emp_cgc);
            $empresa->data_cad = date('Y-m-d H:i:s');
            $empresa->status = $request->status;
            $statusEmp = $empresa->save();

            if($statusEmp){
                return response()->json(['code'=>'200','Response'=>'Salvo com sucesso'], 200);
            }else{
                return response()->json(['code'=>'400','Response'=>'Bad Request'], 400);
            }
        }
    }

    
    public function show($id)
    {
        $empresa = Empresa::find($id);

        if(!$empresa)
            return response()->json(['code'=>'404','erro'=>'Nenhuma empresa com esse ID.'], 404);

        return response()->json($empresa,200);
    }

    public function cgc($cgc)
    {
        $empresa = Empresa::where('emp_cgc',$cgc)->first();
        
        if(!$empresa)
            return response()->json(['code'=>'404','erro'=>'Nenhuma empresa com esse CNPJ.'], 404);

        return response()->json($empresa,200);
    }

    public function rest($auth_rest)
    {
        $empresa = Empresa::where('auth_rest',$auth_rest)->first();
        
        if(!$empresa)
            return response()->json(['code'=>'404','erro'=>'Nenhuma empresa localizada.'], 404);
       
       return $empresa;
    }

    public function generate_rest($cgc)
    {
        $authRest = hash('md5', $cgc);
        
        return response()->json($authRest , 200);
    }
    
    public function update(Request $request, $hash)
    {
        $empresa = Empresa::where('auth_rest',$hash)->first();
        if(!$empresa)
        return response()->json(['code'=>'404','erro'=>'Nenhuma empresa localizada.'], 404);

        $empresa->data_alt = date('Y-m-d H:i:s');
        $statusEmp = $empresa->update($request->all());

        if($statusEmp){
            return response()->json(['code'=>'200','Response'=>'Atualizado com sucesso'], 200);
        }else{
            return response()->json(['code'=>'400','Response'=>'Bad Request'], 400);
        }
    }

    public function destroy($id)
    {
        $empresa = Empresa::find($id);
        if(!$empresa)
            return response()->json(['code'=>'404','erro'=>'Nenhuma empresa com esse ID.'], 404);

        $statusEmp = $empresa->delete();

        if($statusEmp){
            return response()->json(['code'=>'200','Response'=>'Empresa excluida com sucesso'], 200);
        }else{
            return response()->json(['code'=>'400','Response'=>'Bad Request'], 400);
        }
    }

    public function deleteRel($auth_rest,$id)
    {
        $empresa = Empresa::where('auth_rest',$auth_rest)->first();
        if(!$empresa)
            return response()->json(['code'=>'404','erro'=>'Nenhuma empresa localizada.'], 404);

        $cliEmp = Cliempresa::where([['empresa',$empresa->id_empresa],['cliente',$id]])->first();
        if(!$cliEmp)
            return response()->json(['code'=>'404','erro'=>'Nenhuma cliente localizado.'], 404);
      
        $statusEmp = $cliEmp->delete();

        if($statusEmp){
            return response()->json(['code'=>'200','Response'=>'Empresa excluida do relacionamento'], 200);
        }else{
            return response()->json(['code'=>'400','Response'=>'Bad Request'], 400);
        }
    }

    public function cliemp($auth_rest)
    {
        $empresa = Empresa::where('auth_rest',$auth_rest)->first();
        if(!$empresa)
            return response()->json(['code'=>'404','erro'=>'Nenhuma empresa localizada.'], 404);

            $clieEmp = Cliempresa::where('empresa',$empresa->id_empresa)->with(['cliente'])->get('cliente');
        
            return response()->json(['Empresa' => $empresa->razao_social,'Clientes' => $clieEmp],200);
    }

    public function contratoemp($auth_rest)
    {
        if($auth_rest == 'current'){
            $emp = Empresa::where('auth_rest',auth('admin')->user()->auth_rest)->first();
            if(!$emp)
            return response()->json(['code'=>'404','erro'=>'Nenhuma empresa localizada.'], 404);

            $contratos = Contrato::where('emp_cod',$emp->id_empresa)
            ->join('clientes', 'clientes.id_cliente', '=', 'contrato.cli_cod')
            ->select('clientes.id_cliente','clientes.nome','clientes.cgc','contrato.id_contrato','contrato.numero','contrato.ativo','contrato.data_cad','contrato.data_alt')
            ->first();

        }else{
            $emp = Empresa::where('auth_rest',$auth_rest)->first();
            if(!$emp)
            return response()->json(['code'=>'404','erro'=>'Nenhuma empresa localizada.'], 404);

            $contratos = Contrato::where('emp_cod',$emp->id_empresa)
            ->join('clientes', 'clientes.id_cliente', '=', 'contrato.cli_cod')
            ->select('clientes.id_cliente','clientes.nome','clientes.cgc','contrato.id_contrato','contrato.numero','contrato.ativo','contrato.data_cad','contrato.data_alt')
            ->first();

        }

        if(!$contratos)
            return response()->json(['code'=>'404','erro'=>'Nenhum contrato localizado.'], 404);


        
        //return response()->json(['Empresa' => $contratos,'Clientes' => $contratos],200);
        return response()->json($contratos,200);
    }
}
