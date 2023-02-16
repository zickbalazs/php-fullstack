<main>
    <?php
        if (isset($_POST['send'])){
            $name = escapeshellcmd($_POST['name']);
            $leltart_nr = escapeshellcmd($_POST['leltart_nr']);
            $location = escapeshellcmd($_POST['location']);
            if (empty($name) || empty($leltart_nr) || empty($location)) echo Alert("danger", "Mementos a las bruh #23222");
            else {
                if ($db->exec("insert into tetelek (name, leltart_nr, location) values ('$name', '$leltart_nr', '$location')")!=0){
                    echo Alert("success", "Jó");
                }
                else{
                    echo Alert("warning", "Bruh");
                }
            }
        }    
        echo $db->AutoForm('method|post;action|./index.php?pg=tetelek_add;text|name|Terméknév;text|leltart_nr|Leltári szám;text|location|Hely;submit');
    ?>

</main>