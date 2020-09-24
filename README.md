## API SIG 2000 - Boletos

        --------------------------------
              Autenticação via JWT
        --------------------------------

         Instrução:
         Passar no header da requisição:
         Authorization: Bearer + TOKEN
         

## Rotas: </br>


    Post:
	Autenticação de cliente:
    api/auth/login -> Enviar CGC // PASSWORD;
    api/auth/me -> Retorna user logado;
    api/auth/logout -> Fazer o logout;
    api/auth/refresh -> Gera um novo token;
	
	Autenticação de empresa:
	api/auth/emp/login -> Enviar AUTH_REST // PASSWORD;
    api/auth/emp/me -> Retorna empresa logada;
    api/auth/emp/logout -> Fazer o logout;
    api/auth/emp/refresh -> Gera um novo token;
    
	***Todos os tokens duram 1h***
	
    Insert:
    api/clientes/i/ -> Cadastro de Cliente Parâmetros: nome,cgc,password,ativo,status, auth_rest(empresa);
    Obs.: Se já existir CGC do cliente na tabela, criará apenas o relacionamento na cliempresas

    api/empresas/i/ -> Cadastro de Empresa;
    api/financeiro/i/ -> Cadastro de Boletos;
    api/contratos/i/ -> Cadastro Contrato (enviar arquivo pelo name: contrato);

    Update:
    api/clientes/u/{id} -> Atualizar Cliente;
    api/empresas/u/{auth_rest} -> Atualizar Empresa (pelo Auth_rest);
    api/contratos/u/{id} -> Atualiza o contrato solicitado(pelo ID, enviar arquivo pelo name: contrato);
    api/contratos/u/doc/{numero} -> Atualiza o contrato referente a empresa logada(pelo numero, enviar arquivo pelo name: contrato);
    
    Delete:
    api/clientes/d/{id} -> Deletar Cliente ( Todas as empresas);
    api/clientes/d/{auth_rest}/{id} -> Deletar relacionamento da empresa x cliente;
    api/contratos/d/{id} -> Deletar o contrato solicitado(pelo ID);
    api/contratos/d/n/{numero} -> Deletar o contrato solicitado da empresa que o estiver logado(pelo Numero);
 
    Get:
    api/clientes -> Retorna lista de todos os clientes com seus respectivos boletos e contratos;
    api/clientes/{id} -> Retorna o cliente com seus respectivos boletos e contratos (pelo ID);
    api/clientes/cgc/{cgc} -> Retorna o cliente com seus respectivos boletos e contratos (pelo CGC);
    api/clientes/cliemp/{id} -> Retorna o cliente e as empresas que possui cadastro (pelo ID);
    api/clientes/cliemp/cgc/{cgc} -> Retorna o cliente e as empresas que possui cadastro (pelo CGC);
	
    api/empresas -> Retorna todas as empresas;
    api/empresas/{id} -> Retorna a empresa (pelo ID);
    api/empresas/cnpj/{cnpj} -> Retorna a empresa (pelo CNPJ);
    api/empresas/rest/{auth_rest} -> Retorna a empresa (pelo auth_rest);
    api/empresas/rest/generator/{cgc} -> Gera auth_rest da empresa (pelo emp_cgc);
    api/empresas/clientes/{auth_rest} -> Lista de clientes da empresa (pelo auth_rest);
    api/empresas/contratos/{auth_rest} -> Se passar o auth_rest, listará os contratos da empresa. 
                                          Se passar o termo "current" listará os contratos da empresa logada.
    
    api/contratos -> Lista todos os contratos;
    api/contratos/n/{id} -> Lista o contrato (pelo ID);
    api/contratos/n/{numero} -> Lista o contrato referente a empresa logada(pelo numero);

    api/boletos -> Lista todos os boletos;
    api/boletos/n/{id} -> Lista o boleto (pelo ID);
    api/boletos/n/{numero} -> Lista o(s) boleto referente a empresa logada(pelo numero);
    
    
    