
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
        alert('File Upload...');
    });

    $('#dbStore').on('click', function() {
        alert('Indexando...');
    });

    $('#dump').on('click', function() {
        alert('Descartar upload...');
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
            $('#uploadedFiles').append('<input type="checkbox" >' + fileList[item] + '</input>');
            $('#uploadedFiles').append('<br/>');
        }
    }
    });
}
