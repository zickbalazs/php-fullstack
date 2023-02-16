<?php 
class DB {
    private $dbhost;
    private $dbname;
    private $dbuser;
    private $dbpass;
    private $connection;
    private $tablename;
    public $results;
    public function __construct($dbhost, $dbname, $dbuser, $dbpass){
        $this->dbhost = $dbhost;
        $this->dbname = $dbname;
        $this->dbuser = $dbuser;
        $this->dbpass = $dbpass;
        $this->connection = new PDO("mysql:host=$this->dbhost;dbname=$this->dbname", $this->dbuser, $this->dbpass);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->connection->exec('SET NAMES utf8');
    }
    public function query($sql){
        $res = $this->connection->query($sql);
        $this->tablename = $res->getColumnMeta(0)["table"];
        $this->results = $res->fetchAll();
        return $this->results;
    }
    public function exec($sql){
        return $this->connection->exec($sql);
    }
    public function ConvertToTable($data, $buttons){
        if (isset($data[0])){
            $bigstr="";
            if (in_array('c',explode('|', $buttons))){
                $bigstr = "<a class='btn btn-primary' href='index.php?pg='".$this->tablename."_add'><i class='bi bi-plus-lg'></i> Hozzáadás</a>";
            }
            $bigstr .= "<div class='table-responsive'><table class='table table-striped table-hover'><thead class='table-primary'><tr>";
            foreach ($data[0] as $item=>$value){
                $bigstr.= "<th>$item</th>";
            }
            $count = 0;
            if (!empty($buttons)){
                if ($buttons!="c"){
                    $count = count(explode('|', $buttons));
                    $bigstr.="<th colspan='$count'>Műveletek</th>" ;
                }
            }
            $bigstr.= "</tr></thead>";
            $bigstr.= "<tbody>";
            foreach ($data as $item){
                $bigstr .= "<tr>";
                foreach ($item as $key=> $value){
                    $bigstr.="<td>$value</td>";
                }
                if (!empty($buttons)){
                    $actions = explode('|', $buttons);
                    if (in_array('i', $actions)){
                        $bigstr.="<td><a class='btn btn-primary' href='index.php?pg=".$this->tablename."_inf&ID".$item["ID"]."'><i class='bi bi-info-circle'></i></a></td>";
                    }
                    if (in_array('u', $actions)){
                        $bigstr.="<td><a class='btn btn-warning' href='index.php?pg=".$this->tablename."_mod&ID".$item["ID"]."'><i class='bi bi-wrench'></i></a></td>";
                    }
                    if (in_array('d', $actions)){
                        $bigstr.="<td><a class='btn btn-danger' href='index.php?pg=".$this->tablename."_del&ID".$item["ID"]."'><i class='bi bi-trash2'></i></a></td>";
                    }
                }
                $bigstr.="</tr>";
            }
            $counts = count($data[0]) + $count;
            $bigstr .= "</tbody><tfoot class='table-primary'><tr><td colspan='$counts'>Rekordok: ".count($data)."</td></tr></tfoot>";

            $bigstr .= "</table></div>";
            return $bigstr;
        }
        return "";
    }
    public function AutoForm($form){
        $inputs = explode(";", $form);
        $method = "";
        $action = "";
        $inputs = [];
        foreach (explode(';', $form) as $input){
            $items = explode('|', $input);
            switch ($items[0]){
                case 'method':
                    $method = $items[1];
                    break;
                case 'action':
                    $action = $items[1];
                    break;
                case 'dropdown':
                    $options = explode('>', $input)[1];
                    $optStr = "";
                    foreach ($options as $option){
                        $vls = explode('=', $option); 
                        $optStr.="<options value='$vls[1]'>$vls[1]</options>";
                    }
                    var_dump($optStr);
                    break;
                case 'submit':
                    $inputs[count($inputs)] = "<input type='submit' class='btn btn-success' value='Send' name='send' />";
                    break;
                default:
                    $inputs[count($inputs)] = "
                        <div class='mb-3'>
                            <label for='$items[1]' class='form-label'>$items[2]</label>
                            <input type='$items[0]' name='$items[1]' class='form-control' />
                        </div>
                    ";
                    break;
            }
        }
        return "<form action='$action' method='$method' class='col-11 mx-auto'>".join($inputs, "")."</form>";
    }
}

?>