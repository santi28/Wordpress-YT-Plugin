<?php
    //Get Plugin Folder (Minimized)
    function getPluginFolder($file = ""){
        echo esc_url( plugins_url( $file, __FILE__ ) );
    }

    function getPostByMetaKey($metaValue, $metaKey = 'videoId'){
        $args = array(
            'meta_query' => array(
                array(
                    'key' => $metaKey,
                    'value' => $metaValue,
                    'compare' => '='
                )
            )
        );
        $query = new WP_Query($args);
    
        if($query->posts[0]->ID != null){
            return true;
        }
        else{
            return false;
        }
    }    