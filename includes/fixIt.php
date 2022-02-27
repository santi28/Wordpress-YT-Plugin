<?php 
    include '../../../../wp-load.php';
    include '../resources/html-worker.php';

    $c = get_posts();

    foreach ($c as $key) {
        $content = $key->post_content;
        $title = $key->post_title;
        $id = $key->ID;
        if(strpos($content, 'src="'.get_site_url().'/wp-content/plugins/Ajust3/includes/../resources/gpIcon.png"') !== false){
            $parsedReturn = explodeHtml($content)[1];
            $parsedReturn = getAttrValue($parsedReturn, 'src');
            $parsedReturn = explode("/", $parsedReturn)[4];

            $firstIMG = explodeHtml($content)[1];
            $firstIMG = getAttrValue($firstIMG, 'src');
            $secondTAG = explodeHtml($content)[2];
            $secondTAG = getAttrValue($secondTAG, 'href');
            $thirdTAG = explodeHtml($content)[3];
            $thirdTAG = getAttrValue($thirdTAG, 'src');

            update_post_meta($id, 'videoId', $parsedReturn);
            
            $return = array('ok'=>TRUE, 'msg' => "La corrección ha sido exsitosa");

            $newText = trim(strip_tags($content));

            $newContent = '
                <img src="' . $firstIMG . '" height="106" width="189"/>
                <a href="' . $secondTAG . '">
                    <img src="' . $thirdTAG . '" height="132" width="189">
                </a>
                '.$newText.'
            ';

            $my_post = array(
                'ID' => $id,
                'post_content' => $newContent,
            );
            
            wp_update_post( $my_post );
            $return = array('ok'=>TRUE, 'msg' => 'La correción fue exsitosa');
        }
        else{
            $return = array('ok'=>TRUE, 'msg' => 'No se han encontrado coincidencias');
            print_r($content);
        }
    }

    echo json_encode($return);