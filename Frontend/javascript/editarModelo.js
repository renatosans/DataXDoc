
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

function InserirCampo(){
    var id = 0;
    var targetUrl = "../Backend/_campoDocumento/store.php";
    var callParameters = {'modeloDocumento': recordId,'nome': $('input[name=nome]').val(), 'tipo': $('select[name=tipo]').val()};
    $.ajax({ type: 'POST', url: targetUrl, data: callParameters, success: function(response) { id = response; }, async: false });
}

function ExcluirCampo(id){
    var targetUrl = "../Backend/_campoDocumento/delete.php";
    var callParameters = {'reg[]': id};  // TODO: Exclusão multipla, selecionando vários items
    $.ajax({ type: 'POST', url: targetUrl, data: callParameters, success: function(response) { alert(response); }, async: false });
}

function ListarCampos(){
    var targetUrl = "../Backend/_campoDocumento/retrieve.php";
    var callParameters = {'modeloDocumento' : recordId}; // filtra os campos por modelo de documento
    $.ajax({ type: 'POST', url: targetUrl, data: callParameters, success: function(response) {
        var lista = document.getElementById("lista");
        lista.innerHTML = '<tr class="info"> <td>Nome do campo</td><td>Formato</td><td>Ações</td> </tr>'; // Limpa a lista antes de recarregar

        var itemList = JSON.parse(response);
        for(var item in itemList) {
            DisplayRow(itemList[item]);
        }
    }
    });
}

var fieldTypes = ["NONE","NÚMERO","TEXTO","DATA"];

function DisplayRow(campoDocumento){
    var row = document.createElement('tr');
    var col1 = document.createElement('td');
    col1.innerText = campoDocumento.nome;
    var col2= document.createElement('td');
    col2.innerText = fieldTypes[campoDocumento.tipo];
    var col3 = document.createElement('td');
    var editClick = 'EditarCampo(' + campoDocumento.id + ');';
    var deleteClick = 'ExcluirCampo(' + campoDocumento.id + '); ListarCampos(' + recordId + ');';
    col3.innerHTML = '&nbsp; <img src="images/edit.png" /> &nbsp; <img src="images/dump.png" onclick="' + deleteClick + '" />';
    row.appendChild(col1);
    row.appendChild(col2);
    row.appendChild(col3);
    lista.appendChild(row);
}
