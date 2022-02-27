<?php
    include '../../../../wp-load.php';

    $catchSlug = $_GET['postSlug'];

    $args = array(
        'meta_query' => array(
            array(
                'key' => 'videoId',
                'value' => $catchSlug,
                'compare' => '='
            )
        )
    );
    $query = new WP_Query($args);

    if($query->posts[0]->ID != null){
        echo $query->posts[0]->ID;
    }
    else{
        return false;
    }