<?php
    if (isset($_GET['pg'])){
        $page = $_GET['pg'];
        switch ($page){
            case 'stats':
                echo include('stats.php'); break;
            case 'tetelek_add':
                echo include('tetelek_add.php'); break;
            case 'tetelek_mod':
                echo include('tetelek_mod.php');break;
            case 'tetelek_del':
                echo include('tetelek_del.php'); break;
            case 'tetelek_inf':
                echo include('tetelek_inf.php'); break;
            default: echo include('content.php'); break;
        }        
    }
    else echo include('content.php');
?>