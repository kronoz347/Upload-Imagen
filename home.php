<!DOCTYPE html>
<html>
    <head>
        <title>dnd binary upload</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript">
            var site_url = "<?php echo $siteUrl; ?>";
            function sendFile(file) {
                var uri = site_url+'upload.php';
                var xhr = new XMLHttpRequest();
                var frm = document.getElementById('frm');
                var fd = new FormData(frm);
            
                xhr.open("POST", uri, true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        console.log(xhr.responseText); // handle response.
                    }
                };
                fd.append('myFile', file);
                fd.append('datos', 'Aiur');
                // Initiate a multipart/form-data upload
                xhr.send(fd);
            }

            window.onload = function () {
                var dropzone = document.getElementById("dropzone");
                dropzone.ondragover = dropzone.ondragenter = function (event) {
                    event.stopPropagation();
                    event.preventDefault();
                };

                dropzone.ondrop = function (event) {
                    event.stopPropagation();
                    event.preventDefault();

                    var filesArray = event.dataTransfer.files;
                    console.log(filesArray);
                    for (var i = 0; i < filesArray.length; i++) {
                        sendFile(filesArray[i]);
                    }
                };

                var InputFile = document.querySelectorAll("input[type=file]");
                console.log(InputFile);
                for (var i = 0; i < InputFile.length; i++) {
                    console.log(i);
                    InputFile[i].addEventListener('change', function (e) {
                        var filesArray = this.files;
                
                        for(var j = 0; j< filesArray.length; j++){
                            sendFile(filesArray[j]);
                        }
                    });
                }
            };
        </script>
    </head>
    <body>
        <div>
            <input type="file" multiple="true"/>
        </div>
        <div>
            <form id="frm" >
                <input type="text" name="nombre" value="" placeholder="Nombre" />
                <input type="text" name="apellido" value=""  placeholder="Apellido" />
                <input type="date" name="fecha" value=""  placeholder="Fecha" />
                <input type="email" name="email" value=""  placeholder="E-mail" />
            </form>
        </div>
        <div>
            <div id="dropzone" style="margin:30px; width:500px; height:300px; border:1px dotted grey;">Drag & drop your file here...</div>
        </div>
    </body>
</html>