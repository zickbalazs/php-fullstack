<?php 

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "2123szft_leltarozo";
    $appTitle = "Leltározó";
    $company = "BSZC Türr";
    $author = "ZB";
    function Alert($type, $text){
        return  "<div class='alert-dismissible alert alert-$type col-11 mx-auto my-3'>$text <button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
    }
?>