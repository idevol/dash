<?php
function contains($url){
    return str_contains($url, 'dash') ? $url : '';
}

function out_calc(){
    $urls=json_decode(getenv('LANDO_INFO'), TRUE)['dash']['urls'];
    $url_cal=array_map('contains', $urls);
    $out='';
    foreach($url_cal as $value){
        if($value!=''){
            $out=$value;
            break;
        }
    }
    return $out;
}
$url_out=out_calc();
print_r(substr($url_out, 0, -1));