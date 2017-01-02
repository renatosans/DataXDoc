
var recordId = null;

function SetRecordId(id){
    recordId = id;
}

function LoadRecord(){
    var targetUrl = "../Backend/_modeloDocumento/retrieve.php";
    var callParameters = {'reg': recordId};
    $.ajax({ type: 'POST', url: targetUrl, data: callParameters, success: function(response) {
        var modeloDocumento = JSON.parse(response);
        $('input[name=nome]').val(modeloDocumento.nome);
        $('input[name=descricao]').val(modeloDocumento.descricao);
    }
    });
}

function NovoCampo(){
    LoadDialog('#novoCampo', '../Frontend/views/novoCampo.html');
    $('#novoCampo').modal('show');
}

function ListarCampos(){
    var targetUrl = "../Backend/_campoDocumento/retrieve.php";
    var callParameters = {'modeloDocumento' : recordId}; // filtra os campos por modelo de documento
    $.ajax({ type: 'POST', url: targetUrl, data: callParameters, success: function(response) { ParseResponse(response); }, async: false });
}
