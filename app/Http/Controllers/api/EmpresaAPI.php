<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empresa;

class EmpresaAPI extends Controller
{
    
    public function index()
    {
      $empresas =json_decode(Empresa::orderBy('id_empresa', 'asc')->get(),true);

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
        $empresa = Empresa::where('emp_cgc',$cgc)->get();

        if(!$empresa)
            return response()->json(['code'=>'404','erro'=>'Nenhuma empresa com esse ID.'], 404);

        return response()->json($empresa,200);
    }

    public function rest($hash)
    {
        $empresa = Empresa::where('auth_rest',$hash)->get();
        
        if(!$empresa)
            return response()->json(['code'=>'404','erro'=>'Nenhuma empresa com esse ID.'], 404);

        return $empresa;
    }

    public function generate_rest($cgc)
    {
        $authRest = hash('md5', $cgc);
        
        return response()->json($authRest , 200);
    }
    
    public function update(Request $request, $id)
    {
        $empresa = Empresa::findOrFail($id);
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
        $empresa = Empresa::findOrFail($id);
        $statusEmp = $empresa->delete();

        if($statusEmp){
            return response()->json(['code'=>'200','Response'=>'Empresa excluida com sucesso'], 200);
        }else{
            return response()->json(['code'=>'400','Response'=>'Bad Request'], 400);
        }
    }
}
