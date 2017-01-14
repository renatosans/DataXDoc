
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
    $('#uploadForm input[name=file]').change(function(event) {
        event.stopImmediatePropagation();  // Evita que o evento seja disparado várias vezes

        var status = '';

        var xhr = new XMLHttpRequest();

        xhr.open("POST", '../Backend/_uploadArquivo/upload.php');

        var formData = new FormData(document.getElementById('uploadForm'));
        xhr.send(formData);

        xhr.addEventListener('readystatechange', function() {
            if (xhr.readyState === 4 && xhr.status == 200) {
                alert('Upload concluído com sucesso');
                UpdateContents();
            } else {
                status = xhr.statusText;
            }
        });

        xhr.upload.addEventListener("progress", function(e) {
            if (e.lengthComputable) {
            var percentage = Math.round((e.loaded * 100) / e.total);
            status = String(percentage) + '%';
            }
        }, false);

        xhr.upload.addEventListener("load", function(e){
            status = '100%';
        }, false);

        $(this).val(''); // limpa a seleção para o evento ser disparado novamente
    });
    $('#uploadForm input[name=file]').trigger('click');
}

function DeleteFiles(filesChecked){
    var fileArray = new Array();
    filesChecked.each(function(index, element) {
        fileArray.push(btoa(element.name));
    });
    var targetUrl = "../Backend/_uploadArquivo/removerArquivo.php";
    var callParameters = { 'filesChecked[]': fileArray };
    $.ajax({ type: 'POST', url: targetUrl, data: callParameters, success: function(response) { alert(response); UpdateContents(); }, async: false });
}
