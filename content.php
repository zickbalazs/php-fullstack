<h3 class="mt-3">Leltár</h3>
<hr>


<?php
    $db->query("select ID, name, date from tetelek");
    echo $db->ConvertToTable($db->results, 'i|u|c|d');
?>