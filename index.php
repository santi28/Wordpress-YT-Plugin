<?php
    /*
        Plugin Name: Ajust3
        Description: Ajust3 Plugin
        Author: Santiago de Nicolás - Salvador García
        Version: 1.0.2
    */

    function ytPlugin($atts){
        add_menu_page(
        "ajust3",
        "Ajust3",
        "publish_posts",
        "ajust3-plugin",
        "yt_admin_view",
        "dashicons-admin-generic",
        11
        );
    }

    add_action("admin_menu", "ytPlugin");

    function yt_admin_view(){
        require 'functions.php';
        include 'includes/index.php';
    }
?>