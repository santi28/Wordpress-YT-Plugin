<?php
    if(!isset($_GET['filter'])){
        $currentFilter = "nofiltrar";
    }
    else{
        $currentFilter = $_GET['filter'];
    }

    //Obtenemos resultados de Youtube API
    $json = file_get_contents(esc_url( plugins_url( 'test.json', __FILE__ ) ));
    
    $config = file_get_contents(esc_url( plugins_url( '../config/config.json', __FILE__ ) ));

    $config = json_decode($config);
    //Decodificamos los resultados
    $data = json_decode($json);

    //Creamos una variable para llamar a *items*
    $dataItems = $data->items;

    $version = $config->version;

    if($config->lastExcludePurge != date('M')){
        $plug =  plugin_dir_path( __DIR__ ) . "config/config.json";
        $config->exclude = [];
        $config->lastExcludePurge = date('M');

        $config = json_encode($config, JSON_PRETTY_PRINT);

        file_put_contents($plug, $config);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Alata|Montserrat:300,400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <!-- Compiled and minified JavaScript -->
    <script src="<?php echo esc_url( plugins_url( '../resources/materialize.min.js', __FILE__ ) ); ?>"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Youtube Plugin</title>
    <script>
        var val = "<?php echo $currentFilter ?>";
    </script>    
</head>
<body>
    <div class="wrap">
        <?php
            include 'header.php';
            //include 'newVersion.php';
        ?>
        <div class="grandPluginBodyWrap">
        <?php
            if(isset($_GET['config'])){
                include 'config.php';
            }
            elseif(isset($_GET['initDev'])){
                include 'tests.php';
            }
            else{
                include 'home.php';   
            }
        ?>
        </div>
    </div>     
</body>
<script src="<?php getPluginFolder('includes/functions.js') ?>"></script>

</html>