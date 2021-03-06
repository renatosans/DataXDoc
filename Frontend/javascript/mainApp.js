
function LoadView(viewName, viewURL){
    $('#container').hide();
    // Busca a view no servidor através de uma requisição sincrona
    $.ajax({ url: viewURL, context: this, async: false, success: function(response) {
            var container = document.getElementById("container");
            if ( $(viewName).length == 0) {  // Verifica se a view já foi carregada, evita duplicações
                container.innerHTML = response;
            }
        }
    });
    $('#container').show();
}

function LoadScript(scriptURL, afterLoad){
    var script = document.createElement('script');
    script.src = scriptURL;
    script.onload = afterLoad;
    document.body.appendChild(script);
}

var dialogName = null;
var dialogURL = null;

function SetDialogParams(name, URL){
    dialogName = name;
    dialogURL = URL;
}

function OpenDialog(){
    // Busca a view no servidor através de uma requisição sincrona
    $.ajax({ url: dialogURL, context: this, async: false, success: function(response) {
            var modalDialog = document.getElementById("modalDialog");
            if ( $(dialogName).length == 0) {  // Verifica se a view já foi carregada, evita duplicações
                modalDialog.innerHTML = response;
            }
        }
    });
    $(dialogName).modal('show');
}

function CloseDialog(){
    $(dialogName).modal('hide');
}
