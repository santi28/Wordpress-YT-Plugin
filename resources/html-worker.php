<?php
    function explodeHtml($htmlString){
        $dec_html = explode("<", $htmlString);

        $parsedReturn = [];

        foreach ($dec_html as $key) {    
            if($key != null or "" or " "){
                $completedParsed = explode('>', $key, 2)[0]; 
                array_push($parsedReturn, $completedParsed);
            }        
        }

        return $parsedReturn;
    }

    function startsWith ($string, $startString) 
    { 
        $len = strlen($startString); 
        return (substr($string, 0, $len) === $startString); 
    } 

    function findAttr($parsedReturn, $findAttr){
        $attr = strlen($findAttr);
        $attrParsed = explode(' ', $parsedReturn); 
        foreach ($attrParsed as $key) {
            if(startsWith($key, $findAttr)){
                $decodedAttr = $key;
            }
        }
        return $decodedAttr;
    }

    function getAttrValue($parsedReturn, $findAttr){
        $attr = strlen($findAttr);
        $attrParsed = explode(' ', $parsedReturn); 
        foreach ($attrParsed as $key) {
            if(startsWith($key, $findAttr)){
                $decodedAttr = $key;
                $decodedAttr = explode('"', $decodedAttr)[1]; 
            }
        }
        return $decodedAttr;
    }