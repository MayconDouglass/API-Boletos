$(document).ready($(function () {
    
    var token = $.cookie('teste');
    $.ajax({
        type: 'get',
        dataType: 'json',
        url: '/api/clientes/',
        headers: {
            'Authorization': 'Bearer token'
        },

        success: function (result) {
            console.log(result);

        },
        error: function (resultError) {

            console.log('Erro na consulta');

        }

    });



}));
   
       