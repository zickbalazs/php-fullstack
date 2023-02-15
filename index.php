<!DOCTYPE html>
<?php
require("resources.php");
require("database.php");
$db = new DB($dbhost, $dbname, $dbuser, $dbpass);
?>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link href="./css/app.css" rel="stylesheet">
    <title><?php echo $appTitle ?></title>
</head>
<body>
    <div class="container-fluid px-0" id="app">
    <div>
        <header>
                <h1><?php echo $appTitle ?></h1>
        </header>
        <?php include("nav.php") ?>
    </div>    
    <main>
        <?php 
            include('loader.php');
        ?>
    </main>
    <footer>
        <?php echo $author ?>
    </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>