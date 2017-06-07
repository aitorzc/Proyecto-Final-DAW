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
        return $this->tableName;
    }
    //insertar lineas en la db y que devuelva el id
    protected function insertRow(array $changes) {
        $consulta = "INSERT INTO {$this->getTableName()} (".implode(",", array_keys($changes)).") VALUES (" . "'" . implode("','", $changes) . "'" . ");";

        if ($this->db->query($consulta) === true) {
            if($this->db->insert_id){
                return $this->db->insert_id;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }
    //borrar lineas en la db
    public function deleteWhere($where) {
        $where = mysqli_real_escape_string($where);
        $consulta = "DELETE FROM {$this->getTableName()} WHERE {$where}";
        if ($this->db->query($consulta) === true) {
            return true;
        } else {
            echo "<br>Error BORRANDO: " . $this->db->error;
        }
    }
    //Actualizar lineas en la db pasando parámetro de los valores a cambiar un array asociativo y string para where
    public function updateRow(array $changes, $where){
        $where = mysqli_real_escape_string($this->db, $where);
        $setVals = array();
        foreach ($changes as $field => $value){
            array_push($setVals, "{$field} = '{$value}'");
        }
        $consulta = "UPDATE {$this->getTableName()} SET ". implode(', ', $setVals)." WHERE {$where}";
        if ($this->db->query($consulta) === true) {
            return true;
        } else {
            echo "Error actualizando: " . $this->db->error;
        }
    }
    //Actualizar lineas en la db consulta limpia
    public function updateCleanRow($data){
        $data = mysqli_real_escape_string($this->db, $data);
        $consulta = "UPDATE {$this->getTableName()} SET ".$data."";
        echo $consulta;
        if ($this->db->query($consulta) === true) {
            echo "Actualizado correctamente.";
        } else {
            echo "Error actualizando: " . $this->db->error;
        }
    }
    //Select en la db con fetch asociativo
    public function selectAssoc($select){
        $select = mysqli_real_escape_string($this->db, $select);
        $consulta = $this->db->query($select);
        $list = array();
        while ($row = $consulta->fetch_assoc()) {
            array_push($list, $row);
        }
        return $list;
    }
    //Select a la db pasando por parámetros valores a seleccionar con array asociativa y string para el where
    public function selectWhere(array $select, $where) {
        $consulta = $this->db->query("SELECT ".implode(', ', $select)." FROM {$this->getTableName()} WHERE {$where}");
        $list = array();
        while ($obj = $consulta->fetch_object(get_class($this))) {
            array_push($list, $obj);
        }
        return $list;
    }
    //Select a la db pasando los dos parámetros como strings
    public function selectAdd($select, $add) {
        $add = mysqli_real_escape_string($this->db, $add);
        $consulta = $this->db->query("SELECT {$select} FROM {$this->getTableName()} {$add}");
        $list = array();
        
        while ($obj = $consulta->fetch_object(get_class($this))) {
            array_push($list, $obj);
        }
        return $list;
    }
    //Select a la db limpio
    public function selectClean($select) {
        $consulta = $this->db->query($select);
        $list = array();
        
        while ($obj = $consulta->fetch_object(get_class($this))) {
            array_push($list, $obj);
        }
        return $list;
    }
    // Recoger todos los resultados de una tabla (dependiendo de con que objeto estemos llamando a esta función devolvera una tabla u otra)
    public function getAll() {
        $consulta = $this->db->query("SELECT * FROM {$this->getTableName()}");
        $list = array();
        
        while ($obj = $consulta->fetch_object(get_class($this))) {
            array_push($list, $obj);
        }
        return $list;
    }
    // Función para empezar una transacción nueva (de esta forma al hacer un número de querys grande si uno falla no se ejecuta ninguno)
    public function beginTransaction(){
        $this->db->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);
        $this->db->autocommit(FALSE);
    }
    // Finalizar transacción
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
    

