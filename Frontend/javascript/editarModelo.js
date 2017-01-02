
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
    $.ajax({ type: 'POST', url: targetUrl, data: callParameters, success: function(response) {
        var lista = document.getElementById("lista");
        lista.innerHTML = '<tr class="info"> <td>Nome do campo</td><td>Formato</td><td>Ações</td> </tr>'; // Limpa a lista antes de recarregar

        var itemList = JSON.parse(response);
        for(var item in itemList) {
            ListarLinha(itemList[item]);
        }
    }
    });
}


var fieldTypes = ["NONE","NÚMERO","TEXTO","DATA"];


function ListarLinha(campoDocumento){
    var row = document.createElement('tr');
    var col1 = document.createElement('td');
    col1.innerText = campoDocumento.nome;
    var col2= document.createElement('td');
    col2.innerText = fieldTypes[campoDocumento.tipo];
    var col3 = document.createElement('td');
    // var editClick = 'EditarItem(' + campoDocumento.id + ');';
    var deleteClick = 'ExcluirItem(' + campoDocumento.id + '); ListarItems(' + recordId + ');';
    col3.innerHTML = '&nbsp; <img src="images/edit.png" /> &nbsp; <img src="images/dump.png" onclick="' + deleteClick + '" />';
    row.appendChild(col1);
    row.appendChild(col2);
    row.appendChild(col3);
    lista.appendChild(row);
}
