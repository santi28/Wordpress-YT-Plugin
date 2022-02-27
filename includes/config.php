<?php
    $config = file_get_contents(esc_url( plugins_url( '../config/config.json', __FILE__ ) ));
    $config = json_decode($config);

    $exclusionList = $config->exclude;

    $tid = -1;

?>
<style>
h3 {
    margin: 0;
    padding: 0;
}

.pluginWrap {
    padding: 20px;
    position: relative;
    width: 100%;
}

.pluginWrap h1 {
    font-size: 30pt;
    font-family: 'Alata';
}

.pluginSettings ul li {
    border-bottom: 1px solid gray;
    padding: 0px 20px;
    font-family: 'Montserrat';
    font-size: 12pt;
    display: flex;
    flex-direction: row;
    align-items: center;
}

.pluginSettings ul li .left {
    width: 100%;
}

.pluginSettings ul li .right {
    width: 100%;
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

.pluginSettings ul li .right input {
    width: 100%;
}

h3.configTitle {
    font-size: 20pt;
    font-family: 'Alata';
    margin-bottom: 10px;
}

.fileBtn {
    width: 200px;
    height: 50px;
    background-color: #e53935;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    border-radius: 5px;
    flex-direction: column;
    overflow: hidden;
    color: #fafafa;
    border: none;
    cursor: pointer;
}

.fileBtn:focus {
    background: #e53935;
}

.prgBar {
    position: absolute;
    bottom: 0px;
    width: 100%;
    height: 10px;
    background-color: gray;
}

.innerPrg {
    width: 0%;
    background-color: #f55753;
    height: 100%;
    transition: .5s all ease-in-out;
}

.alertWrap {
    min-width: 300px;
    min-height: 50px;
    position:fixed;
    bottom:40px;
    right: 20px;
    overflow: hidden;
    z-index: 1000;
}

.alert {
    min-width: 300px;
    min-height: 50px;
    background-color: #f55753;
    border-radius: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 15px;
    box-sizing: border-box;
    font-family: 'Alata';
    transition: .5s all ease-in-out;
    transform: translateY(100%);
}

.alertShow {
    transform: translateY(0%);
}

.alert h1 {
    color: #fafafa;
    padding: 0;
}

.masterWrap {
    width: 100%;
    height: 900px;
    position: relative;
}

.excludeForm {
    width: 90%;
    background: #e0e0e0;
    margin: auto;
    position: absolute;
    top: 110px;
    z-index: 100000;
    margin-left: auto;
    margin-right: auto;
    left: 0;
    right: 0;
    padding: 25px;
    box-sizing: border-box;
    border-radius: 20px;
}

td {
    padding: 0px 5px;
}

tr:last-child {
    border: none;
}

.rv-icon {
    font-size: 20pt;
    cursor: pointer;
}
</style>
<div class="masterWrap">
    <div class="excludeForm modal" id="exFrm"> 
        <h3 class="configTitle">Lista de exclusión<h3>
                <table>
                    <tbody>
                        <?php
                    foreach ($exclusionList as $key) {
                        $tid++;
                        echo '
                            <tr id="'.$tid.'">
                                <td>
                                    <div class="left">
                                        <h3 class="configTitle">'.$key[0].'</h3>
                                        <p>ID del video: '.$key[1].'</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="right">
                                        <i class="material-icons rv-icon" onclick="unexclude(this)">remove_circle_outline</i>
                                    </div>
                                </td>
                            </tr>
                        ';
                    }
                ?>
                    </tbody>
                </table>
    </div>
    <div class="pluginWrap">
        <h1>Configuración</h1>
        <table>
            <tbody>
                <tr>
                    <td>
                        <div class="left">
                            <h3 class="configTitle">Cambiar imagen de Google Play</h3>
                            <span>Con esta opcion puede cambiar la imagen por defecto de Google Play</span>
                        </div>
                    </td>
                    <td>
                        <div class="right">
                            <form action="upload_file.php" id="gpForm" name="frmupload" method="post"
                                enctype="multipart/form-data">
                                <input type="file" id="gpFile" name="gpFile" placeholder="Google Play URL Image"
                                    onchange="gpSubmit()" hidden>
                                <label class="fileBtn" for="gpFile">
                                    <span>Subir Imagen</span>
                                </label>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="left">
                            <h3 class="configTitle">Lista de exculsión</h3>
                            <span>Agregue o quite resultados de la lista de exculsión</span>
                        </div>
                    </td>
                    <td>
                        <div class="right">
                            <button class="fileBtn modal-trigger" data-target="exFrm">Mostrar Lista</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="left">
                            <h3 class="configTitle">Compatibilidad Con Ajust3</h3>
                            <span>Haga que todos los post anteriores a la version 1.0.2 de <strong><i>AJUST3</i></strong> sean compatibles</span>
                        </div>
                    </td>
                    <td>
                        <div class="right">
                            <button class="fileBtn modal-trigger" onclick="fixIt()">Solucionar Compatibilidad</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="alertWrap">
    <div class="alert">
        <h1 id="alertText">Google</h1>
    </div>
</div>
<script>
function gpSubmit() {
    var url = "<?php getPluginFolder('includes/uploadFile.php'); ?>";
    var form = document.getElementById('gpForm');
    
    $("#gpForm").submit();

    /*$.ajax({
        data: formData,
        url: url,
        type: 'post',
        beforeSend: function () {
            console.log("Procesando, espere por favor...");
        },
        success:  function (response) {
            console.log(response);
        }
    });*/
}

$("form#gpForm").submit(function(e) {
    e.preventDefault();

    var gpFile = document.getElementById("gpFile");

    var gpFileData = gpFile.files[0];

    var gpForm = new FormData();

    gpForm.append('gpFileData', gpFileData);

    var url = "<?php getPluginFolder('includes/uploadFile.php'); ?>";

    var bar = $('#gpBar');
    var percent = $('#gpInner');

    $.ajax({
        url: url,
        type: 'POST',
        contentType: false,
        data: gpForm,
        processData: false,
        cache: false,
        success: function(response) {
            response = JSON.parse(response);
            if (response['ok'] == true) {
                let msg = response['msg'];
                $("#alertText").html(msg);
                $(".alert").addClass('alertShow');
                setTimeout(function() {
                    $(".alert").removeClass('alertShow');
                }, 1500);
            }
            console.log(response);
        },
    });
});

function unexclude(e) {
    var parentId = e.parentNode.parentNode.parentNode.id;

    var parentCont = document.getElementById(parentId);

    parentCont.remove();

    var url = "<?php getPluginFolder('includes/editConfig.php'); ?>";

    var readyTransferInformation = {configType: "removeExclude", deleteKey: parentId};    

    $.ajax({
        url: url,
        type: "GET",
        data: readyTransferInformation,
        success: function(response) {
            response = JSON.parse(response);
            console.log(response);
        }
    })
}

function fixIt(){
    var url = "<?php getPluginFolder('includes/fixIt.php'); ?>";

    $.ajax({
        url: url,
        type: "GET",
        success: function(response) {
            response = JSON.parse(response);
            if (response['ok'] == true) {
                let msg = response['msg'];
                $("#alertText").html(msg);
                $(".alert").addClass('alertShow');
                setTimeout(function() {
                    $(".alert").removeClass('alertShow');
                }, 1500);
            }
            console.log(response);
        }
    })
}

document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems);
});
</script>