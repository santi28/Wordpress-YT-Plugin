<?php
    include '../../../../wp-load.php';

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

    $config = file_get_contents(esc_url( plugins_url( '../config/config.json', __FILE__ ) ));
    $config = json_decode($config);

    $ytApiSearch = $_GET['ytApiSearch'];
    $ytApiFilterDate = $_GET['ytApiFilterDate'];
    $ytApiFilterOrder = $_GET['ytApiFilterOrder'];
    $ytApiToken = $_GET['pageToken'];    

    $avivableKeys = $config->keys;

    $exclusionList = $config->exclude;
    $decodedExclusionList = [];

    foreach ($exclusionList as $key) {
        $key = $key[1];
        array_push($decodedExclusionList, $key);
    }

    $avivableRand = array_rand($avivableKeys);
    $avivableKeys = $avivableKeys[$avivableRand];

    $ytApiSearch = str_replace(" ","-",$ytApiSearch);

    $apiSender = [];
    $apiPostExsist = [];
    $apiPostExclude = [];
    $apiIdMeta = [];

    $postExsist;

    if($ytApiSearch != ""){
        switch ($ytApiFilterDate) {
            case 'hora':
                $ytApiFilterDate = date("Y-m-d\TH:i:sP",strtotime($currentDate."- 1 hours"));
                break;
            case 'hoy':
                $ytApiFilterDate = date("Y-m-d\TH:i:sP",strtotime($currentDate."- 1 days"));
                break;
            case 'seamana':
                $ytApiFilterDate = date("Y-m-d\TH:i:sP",strtotime($currentDate."- 1 week"));
                break;
            case 'mes':
                $ytApiFilterDate = date("Y-m-d\TH:i:sP",strtotime($currentDate."- 1 month"));
                break;
            case 'año':
                $ytApiFilterDate = date("Y-m-d\TH:i:sP",strtotime($currentDate."- 1 year"));
                break;
            default:
                $ytApiFilterDate = "";
                break;
        }

        $ytApiFilterDate = str_replace("+00:00", "Z", $ytApiFilterDate);

        if($ytApiFilterDate != ""){
            $finalytApiFilterDate = '&publishedAfter='.$ytApiFilterDate;
        }

        switch ($ytApiFilterOrder) {
            case 'relevance':
                $ytApiFilterOrder = "relevance";
                break;
            case 'uploadDate':
                $ytApiFilterOrder = "date";
                break;
            case 'viewsNumber':
                $ytApiFilterOrder = "viewCount";
                break;
            case 'rating':
                $ytApiFilterOrder = "rating";
                break;
            default:
                $ytApiFilterOrder = "";
                break;
        }

        if($ytApiFilterOrder != ""){
            $finalytApiFilterOrder = '&order='.$ytApiFilterOrder;
        }

        if($ytApiToken != ""){
            $finalTokenRequest = '&pageToken='.$ytApiToken;
        }

        $json = 'https://www.googleapis.com/youtube/v3/search?part=snippet&type=video&key='.$avivableKeys.'&maxResults=50&q='.$ytApiSearch.$finalytApiFilterDate.$finalTokenRequest.$finalytApiFilterOrder;
        //$json = esc_url( plugins_url( 'test.json', __FILE__ ) );
        $jsonText = $json;
        $json = file_get_contents($json);
        $data = json_decode($json);
        $dataItemsNoneUse = $data->items;

        $dataNextToken = $data->nextPageToken;
        $dataPrevToken = $data->prevPageToken;

        foreach ($dataItemsNoneUse as $key) {
            $transferRealTitle = $key->snippet->title;
            $transferVideoId = $key->id->videoId;

            $transferRealTitle = sanitize_title($transferRealTitle);

            if(in_array($transferVideoId ,$decodedExclusionList)){
                $postExclusion = "true";
            }
            else{
                $postExclusion = "false";
            }

            if(getPostByMetaKey($transferVideoId)){
                $postExsist = "true";
            }
            else{
                $postExsist = "false";
            }

            array_push($apiPostExsist, $postExsist);
            array_push($apiPostExclude, $postExclusion);
        }

        $dataItems = json_encode($dataItemsNoneUse);

        array_push($apiSender, $dataItems);        
        array_push($apiSender, $apiPostExsist);
        array_push($apiSender, $apiPostExclude);
        array_push($apiSender, $dataNextToken);
        array_push($apiSender, $dataPrevToken);
        array_push($apiSender, $jsonText);
        array_push($apiSender, $avivableKeys);
        array_push($apiSender, $apiIdMeta);
        array_push($apiSender, $json);   
    }

    $apiSender = json_encode($apiSender);

    echo $apiSender;