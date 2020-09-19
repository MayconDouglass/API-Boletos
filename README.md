## API SIG 2000 - Boletos

        --------------------------------
              Autenticação via JWT
        --------------------------------

         Instrução:
         Passar no header da requisição:
         Authorization: Bearer + TOKEN
         

## Rotas: </br>


    Post:
    api/auth/login -> Enviar CGC // PASSWORD;
    api/auth/me -> Retorna quem esta logado;
    api/auth/logout -> Fazer o logout;
    api/auth/refresh -> Gera um novo token;
    

    Insert:
    api/clientes/i/ -> Cadastro de Cliente Parâmetros: nome,cgc,password,ativo,status, auth_rest(empresa);
    Obs.: Se já existir CGC do cliente na tabela, criará apenas o relacionamento na cliempresas

    api/emp/i/ -> Cadastro de Empresa;
    api/financeiro/i/ -> Cadastro de Boletos;
    api/contrato/i/ -> Cadastro de Contrato;

    Update:
    api/clientes/u/{id} -> Atualizar Cliente;
    
    Delete:
    api/clientes/d/{id} -> Deletar Cliente ( Todas as empresas);
    api/clientes/d/{auth_rest}/{id} -> Deletar relacionamento da empresa x cliente;


 
    Get:
    api/clientes -> Retorna lista de todos os clientes com seus respectivos boletos e contratos;
    api/clientes/{id} -> Retorna o cliente com seus respectivos boletos e contratos (pelo ID);
    api/clientes/cgc/{cgc} -> Retorna o cliente com seus respectivos boletos e contratos (pelo CGC);

    api/empresas -> Retorna todas as empresas;
    api/empresas/{id} -> Retorna a empresa (pelo ID);
    api/empresas/cnpj/{cnpj} -> Retorna a empresa (pelo CNPJ);

    api/clientes/cliemp/{id} -> Retorna o cliente e as empresas que possui cadastro (pelo ID);
    api/clientes/cliemp/cgc/{cgc} -> Retorna o cliente e as empresas que possui cadastro (pelo CGC);

    api/empresas/rest/{hash} -> Retorna a empresa (pelo auth_rest);
    api/empresas/rest/generator/{cgc} -> Gera auth_rest da empresa (pelo emp_cgc);

