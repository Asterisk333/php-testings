<?php
    function readauth (){
        $string = file_get_contents("../auth/my_app_db_auth.json");
        $json_a = json_decode($string, true);
        return $json_a;
    }
?>