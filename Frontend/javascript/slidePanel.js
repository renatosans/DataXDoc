
function SetEventHandlers(){
    $('#slidePanelTab').on('click', function() {
        var panel = $('#slidePanel');
        if (panel.hasClass("visible")) {
            panel.removeClass('visible').animate({'margin-right':'-400px'});
        } else {
            panel.addClass('visible').animate({'margin-right':'0px'});
            UpdateContents();
        }
        return false;
    });

    $('#fileUpload').on('click', function() {
        FileUpload();
    });

    $('#dbStore').on('click', function() {
        alert('Indexando...');
    });

    $('#dump').on('click', function() {
        DeleteFiles($('#uploadedFiles input[type=checkbox]:checked'));
    });
}

function UpdateContents(){
    var targetUrl = "../Backend/_uploadArquivo/listarArquivos.php";
    var callParameters = '';
    $.ajax({ type: 'POST', url: targetUrl, data: callParameters, success: function(response) {
        var uploadedFiles = document.getElementById("uploadedFiles");
        uploadedFiles.innerHTML = ''; // Limpa a lista antes de recarregar

        var fileList = JSON.parse(response);
        for(var item in fileList) {
            $('#uploadedFiles').append('<input type="checkbox" name=' + fileList[item] + '>' + fileList[item] + '</input>');
            $('#uploadedFiles').append('<br/>');
        }
    }
    });
}

function FileUpload(){
    // Faz o upload de um documento para o servidor
}

function DeleteFiles(filesChecked){
    var fileArray = new Array();
    filesChecked.each(function(index, element) {
        fileArray.push(element.name);
    });
    var targetUrl = "../Backend/_uploadArquivo/removerArquivo.php";
    var callParameters = { 'filesChecked[]': fileArray };
    $.ajax({ type: 'POST', url: targetUrl, data: callParameters, success: function(response) { alert(response); UpdateContents(); }, async: false });
}
