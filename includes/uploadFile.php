<?php
    $return = array('ok'=>TRUE, 'msg' => "Se ha subido correctamente");

    $nombre_archivo = $_FILES['gpFileData']['name'];

    $tipo_archivo = $_FILES['gpFileData']['type'];

    $tamano_archivo = $_FILES['gpFileData']['size'];

    $tmp_archivo = $_FILES['gpFileData']['tmp_name'];

    $archivador = '../resources/gpIcon.png';

    if (!move_uploaded_file($tmp_archivo, $archivador)) {
        $return = array('ok' => FALSE, 'msg' => "Ocurrio un error al subir el archivo. No pudo guardarse.", 'status' => 'error');
    }    

    echo json_encode($return);