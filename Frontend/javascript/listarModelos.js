
function EditarModelo(id){
    LoadView('#editarModelo', '../Frontend/views/editarModelo.html');
    LoadScript('javascript/editarModelo.js', function(){ SetRecordId(id); LoadRecord(); ListarCampos(); } );
    SetDialogParams('#novoCampo', '../Frontend/views/novoCampo.html');
}

function InserirModelo(){
    var id = 0;
    var targetUrl = "../Backend/_modeloDocumento/store.php";
    var callParameters = {'nome': $('input[name=nome]').val(), 'descricao': $('input[name=descricao]').val()};
    $.ajax({ type: 'POST', url: targetUrl, data: callParameters, success: function(response) { id = response; ListarModelos(); }, async: false });
}

function ExcluirModelo(id){
    var targetUrl = "../Backend/_modeloDocumento/delete.php";
    var callParameters = {'reg[]': id};  // TODO: Exclusão multipla, selecionando vários items
    $.ajax({ type: 'POST', url: targetUrl, data: callParameters, success: function(response) { alert(response); ListarModelos(); }, async: false });
}

function ListarModelos(){
    var targetUrl = "../Backend/_modeloDocumento/retrieve.php";
    var callParameters = {'reg':''}; // Parâmetro vazio, retorna todos os registros
    $.ajax({ type: 'POST', url: targetUrl, data: callParameters, success: function(response) {
        var lista = document.getElementById("lista");
        lista.innerHTML = '<tr class="info"><td>Nome</td><td>Descrição</td><td>Ações</td></tr>'; // Limpa a lista antes de recarregar

        var itemList = JSON.parse(response);
        for(var item in itemList) {
            DisplayItem(itemList[item]);
        }
    }
    });
}

function DisplayItem(modeloDocumento){
    var row = document.createElement('tr');
    var col1 = document.createElement('td');
    col1.innerText = modeloDocumento.nome;
    var col2 = document.createElement('td');
    col2.innerText = modeloDocumento.descricao;
    var col3 = document.createElement('td');
    var editClick = 'EditarModelo(' + modeloDocumento.id + ');';
    var deleteClick = 'ExcluirModelo(' + modeloDocumento.id + ');';
    col3.innerHTML = '&nbsp; <img src="images/edit.png" onclick="' + editClick + '" /> &nbsp; <img src="images/dump.png" onclick="' + deleteClick + '" />';
    row.appendChild(col1);
    row.appendChild(col2);
    row.appendChild(col3);
    lista.appendChild(row);
}
