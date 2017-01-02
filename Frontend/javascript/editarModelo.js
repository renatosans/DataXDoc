
var recordId = null;

function SetRecordId(id){
    recordId = id;
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
