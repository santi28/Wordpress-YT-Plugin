<?php
    include '../../../../wp-load.php';

    function wpmix_publish_post($transferTitle, $content, $transferCategories, $transferTags, $transferSlug, $excerpt, array $metaArray) {
        global $user_ID;
        $new_post = array(
            'post_title' => $transferTitle,
            'post_content' => $content,
            'post_status' => 'publish',
            'post_author' => $user_ID,
            'post_type' => 'post',
            'post_category' => $transferCategories,
            'tags_input' => $transferTags,
            'post_name' => $transferSlug,
            'post_excerpt' => $excerpt,
            'meta_input' => $metaArray
        );
        $post_id = wp_insert_post($new_post);
    }

    function get_post_by_slug($param){
        $args = array(
            'name'        => $param,
            'post_type'   => 'post',
            'post_status' => 'publish',
            'numberposts' => 1
        );
      
        $return = get_posts($args);
          
        if( $return ) :
            return true;
        else: 
            return false;
        endif;
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

    $transfer = $_GET['publishInfo'];   

    $test = [];

    $i;

    foreach ($transfer as $key) {
        $transferTitle = mb_convert_encoding($key['title'], "UTF-8");;
        $transferThumb = $key['thumb'];
        $transferCategories = $key['categories'];
        $numArray = array_map('intval', $transferCategories);
        $transferTags = $key['tags'];
        $transferGpUrl = $key['gpUrl'];
        $transferRealTitle = $key['realTitle'];
        $articlePostBody = $key['articlePostBody'];
        $idKey = $key['idKey'];

        $transferRealTitle = sanitize_title($transferRealTitle);
        $content =  '
            <img src="'.$transferThumb.'" height="106" width="189"/>
            <a href="'.$transferGpUrl.'" target="_blank">
                <img src="' . esc_url( plugins_url( '../resources/gpIcon.png', __FILE__ ) ) . '" height="132" width="189">
            </a>
            '.$articlePostBody.'
        ' ;

        if(!getPostByMetaKey($idKey)){
            wpmix_publish_post($transferTitle, $content, $numArray, $transferTags, $transferRealTitle, $articlePostBody, array('videoId' => $idKey));
        }

        array_push($test, $articlePostBody);
    }  

    $transfer = json_encode($test);

    echo $transfer;

?>