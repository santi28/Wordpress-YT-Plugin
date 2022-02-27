<?php
    include '../../../../wp-load.php';
   
    $configValue = $_GET['configType'];

    $plug =  plugin_dir_path( __DIR__ ) . "config/config.json";

    $config = file_get_contents(esc_url( plugins_url( '../config/config.json', __FILE__ ) ));

    $config = json_decode($config);

    if($configValue == "exclude"){
        $grandArray = [];
        $titleKey = $_GET['titleKey'];
        $idKey = $_GET['idKey'];
        array_push($grandArray, $titleKey);
        array_push($grandArray, $idKey);
        array_push($config->$configValue, $grandArray);
    }
    if($configValue == "removeExclude"){
        $deleteKey = $_GET['deleteKey'];
        \array_splice($config->exclude, $deleteKey, 1);
    }    

    $config = json_encode($config, JSON_PRETTY_PRINT);

    file_put_contents($plug, $config);

    echo $config;    

?>