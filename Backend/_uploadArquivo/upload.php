<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Upload ajax</title>
</head>
<body>

<form action="upload.php" method="post" id="upload">
  <input type="file" name="file" id="file" accept="image/*" />
  <input type="text" name="name" value="complemento" />
  <input type="submit" value="Send!" />
</form>

<div id="preview"></div>

<script>
var $formUpload = document.getElementById('upload'),
    $preview = document.getElementById('preview'),
    i = 0;

$formUpload.addEventListener('submit', function(event){
  event.preventDefault();

  var xhr = new XMLHttpRequest();

  xhr.open("POST", $formUpload.getAttribute('action'));

  var formData = new FormData($formUpload);
  formData.append("i", i++);
  xhr.send(formData);

  xhr.addEventListener('readystatechange', function() {
    if (xhr.readyState === 4 && xhr.status == 200) {
      var json = JSON.parse(xhr.responseText);

      if (!json.error && json.status === 'ok') {
        $preview.innerHTML += '<br />Enviado!!';
      } else {
        $preview.innerHTML = 'Arquivo não enviado';
      }

    }
  });

  xhr.upload.addEventListener("progress", function(e) {
    if (e.lengthComputable) {
      var percentage = Math.round((e.loaded * 100) / e.total);
      $preview.innerHTML = String(percentage) + '%';
    }
  }, false);

  xhr.upload.addEventListener("load", function(e){
    $preview.innerHTML = String(100) + '%';
  }, false);

}, false);

</script>

</body>
</html>
