<?php


abstract class dbObject {
    
    protected $tableName;
    protected $db;
    private static $_db;
    
    public function __construct() {
        $this->db = self::$_db;
    }
    
    public static function setDbCon($db){
        self::$_db = $db;
    }
    protected function setTable($name){
        $this->tableName = $name;
    }
    //Función para utilizar el nombre de clase como nombre de tabla de base de datos para ahorrar código
    private function getTableName() {
        //return empty($this->tableName) ? get_class($this) : $this->tableName;
        return $this->tableName;
    }
    
    protected function insertRow(array $changes) {
        $consulta = "INSERT INTO {$this->getTableName()} (".implode(",", array_keys($changes)).") VALUES (" . "'" . implode("','", $changes) . "'" . ");";

        if ($this->db->query($consulta) === true) {
            if($this->db->insert_id){
                return $this->db->insert_id;
                echo "insertado correctamente";
            }else{
                return true;
            }
        }else{
            echo "error al insertar: ".$this->db->error;
            return false;
        }
    }

    public function deleteWhere($where) {
        
        $consulta = "DELETE FROM {$this->getTableName()} WHERE {$where}";
        
        if ($this->db->query($consulta) === true) {
            echo "<br>BORRADO correctamente.";
        } else {
            echo "<br>Error BORRANDO: " . $this->db->error;
        }
    }
    
    public function updateRow(array $changes, $where){
   
        $setVals = array();
        foreach ($changes as $field => $value){
            array_push($setVals, "{$field} = '{$value}'");
        }
        
        $consulta = "UPDATE {$this->getTableName()} SET ". implode(', ', $setVals)." WHERE {$where}";

        if ($this->db->query($consulta) === true) {
            echo "Actualizado correctamente.";
        } else {
            echo "Error actualizando: " . $this->db->error;
        }
    }
    
    public function selectWhere(array $select, $where) {
        $consulta = $this->db->query("SELECT ".implode(', ', $select)." FROM {$this->getTableName()} WHERE {$where}");
        $list = array();
        
        while ($obj = $consulta->fetch_object(get_class($this))) {
            array_push($list, $obj);
        }
        return $list;
    }
    public function selectAdd($select, $add) {
        $consulta = $this->db->query("SELECT {$select} FROM {$this->getTableName()} {$add}");
        $list = array();
        
        while ($obj = $consulta->fetch_object(get_class($this))) {
            array_push($list, $obj);
        }
        return $list;
    }
    public function selectClean($select) {
        $consulta = $this->db->query($select);
        $list = array();
        
        while ($obj = $consulta->fetch_object(get_class($this))) {
            array_push($list, $obj);
        }
        return $list;
    }
    public function getAll() {

        $consulta = $this->db->query("SELECT * FROM {$this->getTableName()}");
        $list = array();
        
        while ($obj = $consulta->fetch_object(get_class($this))) {
            array_push($list, $obj);
        }
        return $list;
    }

    public function beginTransaction(){
        $this->db->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
        $this->db->autocommit(FALSE);
    }
    
    public function finishTransaction(){
        if($this->db->commit()){
            $this->db->autocommit(TRUE);
            return true;
        }else{
            $this->db->rollback();
            $this->db->autocommit(TRUE);
            return false;
        }
    }
    
}
    

