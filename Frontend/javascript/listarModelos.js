
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
