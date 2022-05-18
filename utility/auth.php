<?php
function readauth (){
    $string = file_get_contents("../auth/serverauth.json");
    $json_a = json_decode($string, true);
    return $json_a;
}
?>