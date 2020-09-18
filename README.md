## API SIG 2000 - Boletos

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
    api/clientes/i/ -> Cadastro de Cliente;
    api/emp/i/ -> Cadastro de Empresa;
    api/financeiro/i/ -> Cadastro de Boletos;
    api/contrato/i/ -> Cadastro de Contrato;

    Update:
    api/clientes/{id}/u/ -> Atualizar Cliente;
    
    Delete:
    api/clientes/d/{id} -> Deletar Cliente;


 
    Get:
    api/clientes -> Retorna lista de todos os clientes com seus respectivos boletos e contratos;
    api/clientes/{id} -> Retorna o cliente com seus respectivos boletos e contratos (pelo ID);
    api/clientes/cgc/{cgc} -> Retorna o cliente com seus respectivos boletos e contratos (pelo CGC);

    api/clientes/emp/ -> Retorna as empresas;
    api/clientes/emp/{id} -> Retorna a empresa (pelo ID);
    api/clientes/emp/{cnpj} -> Retorna a empresa (pelo CNPJ);

    api/clientes/cliemp/{id} -> Retorna o cliente e as empresas que possui cadastro (pelo ID);
    api/clientes/cliemp/cgc/{cgc} -> Retorna o cliente e as empresas que possui cadastro (pelo CGC);


