<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Financeiro;
use Illuminate\Http\Request;

class FinanceiroAPI extends Controller
{
    
    public function index()
    {
        $boletos = Financeiro::
        join('clientes', 'clientes.id_cliente', '=','financeiro.cli_cod')
        ->join('empresas', 'empresas.id_empresa', '=','financeiro.emp_cod')
        ->select('clientes.id_cliente as cli_cod','clientes.nome','clientes.cgc',
        'empresas.id_empresa as emp_cod','empresas.razao_social',
        'empresas.emp_cgc as CNPJ','financeiro.id_doc','financeiro.descricao',
        'financeiro.numero_doc','financeiro.serie','financeiro.parcela','financeiro.tipo_titulo',
        'financeiro.dt_vencimento','financeiro.dt_pagamento','financeiro.dt_emissao','financeiro.valor',
        'financeiro.multa_juros','financeiro.valor_original','financeiro.status','financeiro.linha_digitavel')
        ->get();
        
        return response()->json($boletos, 200);
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        $boleto = Financeiro::where('id_doc',$id)
        ->join('clientes', 'clientes.id_cliente', '=','financeiro.cli_cod')
        ->join('empresas', 'empresas.id_empresa', '=','financeiro.emp_cod')
        ->select('clientes.id_cliente as cli_cod','clientes.nome','clientes.cgc',
        'empresas.id_empresa as emp_cod','empresas.razao_social',
        'empresas.emp_cgc as CNPJ','financeiro.id_doc','financeiro.descricao',
        'financeiro.numero_doc','financeiro.serie','financeiro.parcela','financeiro.tipo_titulo',
        'financeiro.dt_vencimento','financeiro.dt_pagamento','financeiro.dt_emissao','financeiro.valor',
        'financeiro.multa_juros','financeiro.valor_original','financeiro.status','financeiro.linha_digitavel')
        ->first();
        
        if(!$boleto)
            return response()->json(['code'=>'404','erro'=>'Nenhum boleto com esse ID.'], 404);

        return response()->json($boleto, 200);
    }

    public function showNumero($numero)
    {
        $boleto = Financeiro::where([['numero_doc',$numero],['financeiro.emp_cod',auth('admin')->user()->id_empresa]])
        ->join('clientes', 'clientes.id_cliente', '=','financeiro.cli_cod')
        ->join('empresas', 'empresas.id_empresa', '=','financeiro.emp_cod')
        ->select('clientes.id_cliente as cli_cod','clientes.nome','clientes.cgc',
        'empresas.id_empresa as emp_cod','empresas.razao_social',
        'empresas.emp_cgc as CNPJ','financeiro.id_doc','financeiro.descricao',
        'financeiro.numero_doc','financeiro.serie','financeiro.parcela','financeiro.tipo_titulo',
        'financeiro.dt_vencimento','financeiro.dt_pagamento','financeiro.dt_emissao','financeiro.valor',
        'financeiro.multa_juros','financeiro.valor_original','financeiro.status','financeiro.linha_digitavel')
        ->get();
        
        if(!$boleto)
            return response()->json(['code'=>'404','erro'=>'Nenhum boleto com esse numero.'], 404);

        return response()->json($boleto, 200);
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
