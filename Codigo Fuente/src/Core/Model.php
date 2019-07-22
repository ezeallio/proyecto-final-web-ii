<?php

class Model
{
    protected $db; //objeto de conexión a la bd

    protected $table; //nombre de tabla

    protected $fields = array();  //lista de campos

    public function __construct()
    {

        require ROOT . 'Config/config.php';

        $dbconfig['host'] = $host;

        $dbconfig['user'] = $user;

        $dbconfig['password'] = $password;

        $dbconfig['dbname'] = $dbname;

        $dbconfig['port'] = $port;

        $this->db = new Database($dbconfig);

        $this->table = get_called_class();

        $this->getFields();

    }

    /**
     * Obtiene una lista de los campos de una tabla
     */
    private function getFields()
    {

        $sql = "DESC " . $this->table;

        $result = $this->db->getAll($sql);

        foreach ($result as $v) {

            $this->fields[] = $v['Field'];

            if (!strcasecmp($v['Key'], 'PRI') && !strcasecmp($v['Field'], 'Id')) {

                // Si hay una PK, la guardo en $pk

                $pk = $v['Field'];

            }

        }

        //Si hay una PK, la agrego dentro de la lista de campos

        if (isset($pk))
            $this->fields['pk'] = $pk;
    }

    /**
     * Insertar filas
     * @access public
     * @param $list array asociativo
     * @return mixed Si sale bien, se retorna el id asociado a la inserción. Sino, false
     */
    public function insert($list)
    {

        $field_list = '';  //Lista de campos string

        $value_list = '';  //Lista de valores string

        foreach ($list as $k => $v) {
            if (in_array($k, $this->fields)) {
                $field_list .= "`" . $k . "`" . ',';
                $value_list .= "'" . $v . "'" . ',';
            }
        }

        // Recorto la coma en la derecha

        $field_list = rtrim($field_list, ',');

        $value_list = rtrim($value_list, ',');

        // Construyo sql statement

        $sql = "INSERT INTO `{$this->table}` ({$field_list}) VALUES ($value_list)";

        if ($this->db->query($sql)) {

            // La inserción resultó, entonces retorno el id de la última fila insertada.

            return $this->db->getInsertId();

            //Retorna true;

        } else {

            // Si falló, entonces FALSE.

            return false;

        }
    }

    /**
     * Actualizar filas
     * @access public
     * @param $list array asociativo que necesita ser actualizado
     * @return mixed Si sale bien, retorno cant de filas afectadas. Sino, false
     */
    public function update($list)
    {

        $uplist = ''; //Campos a actualizar

        $where = 0;   //Condición de actualización. El default es 0.

        foreach ($list as $k => $v) {

            if (in_array($k, $this->fields)) {

                if (!strcasecmp($k, $this->fields['pk'])) {

                    // Si es PK, construyo condición WHERE.

                    $where = "`$k`=$v";

                } else {

                    // De lo contrario, construyo lista de actualización

                    $uplist .= "`$k`= " . ($v == null ? "NULL" : "'$v'") . ",";

                }

            }

        }

        // Recorto coma en la derecha de la lista de actualización

        $uplist = rtrim($uplist, ',');

        // Construyo statement

        $sql = "UPDATE `{$this->table}` SET {$uplist} WHERE {$where}";


        if ($this->db->query($sql)) {

            // Si salió bien, retorno la cantidad de filas afectadas

            if ($rows = $this->db->getAffectedRows()) {

                // Tiene cantidad de filas afectadas

                return $rows;

            } else {

                // No tiene filas afectadas

                return false;

            }

        } else {

            // Si falla, FALSE

            return false;

        }
    }

    /**
     * Borrar filas
     * @access public
     * @param $pk mixed puede ser un int o un array
     * @return mixed Si sale bien, devuelve la cantidad de filas eliminadas. Sino, FALSE.
     */
    public function delete($pk)
    {

        $where = 0; //Condición string

        //Chequeo is $pk es un solo valor o un array de valores, y construyo la condición where acorde a ello.

        if (is_array($pk)) {

            // array

            $where = "`{$this->fields['pk']}` in (" . implode(',', $pk) . ")";

        } else {

            // solo un valor

            $where = "`{$this->fields['pk']}`=$pk";

        }

        // Construyo statement

        $sql = "DELETE FROM `{$this->table}` WHERE $where";

        if ($this->db->query($sql)) {

            // Si sale bien, retorno la cantidad de filas afectadas

            if ($rows = $this->db->getAffectedRows()) {

                // Tiene cantidad de filas afectadas

                return $rows;

            } else {

                // No tiene cantidad de filas afectadas

                return false;

            }

        } else {

            // Si falló, retorno false.

            return false;

        }

    }

    /**
     * Obtener info por PK
     * @param $pk int Primary Key
     * @return array de una sola fila
     */
    public function selectByPk($pk)
    {

        $sql = "select * from `{$this->table}` where `{$this->fields['pk']}`=$pk";

        return $this->db->getRow($sql);

    }

    /**
     * Obtiene la cantidad de todas las filas
     * @param string $where opcional. Condicion where para contar
     * @return bool
     */
    public function total($where = '')
    {
        $sql = "select count(*) from {$this->table}";

        if(!empty($where))
            $sql .= " where $where";

        return $this->db->getOne($sql);
    }

    /**
     * Obtiene información con paginado
     * @param string $offset int offset
     * @param string $limit int número de filas en cada página
     * @param $where string condición WHERE. Default es vacío
     *
     * @param array $columns array de columnas a filtrar
     * @param bool $distinct activa el distinct
     * @return array
     */
    public function pageRows($offset = '', $limit = '', $where = '', $columns = [], $distinct = false)
    {
        $sql = "select ";

        if($distinct)
            $sql .= "distinct (*) ";
        else
            $sql .= "* ";

        if(count($columns)) {
            $tmp = "";

            foreach ($columns as $column)
                $tmp .= $column . ", ";

            $sql = str_replace("*", substr_replace($tmp, "", strripos($tmp, ", ")), $sql);
        }

        $sql .= "from {$this->table}";

        if(!empty($where))
            $sql .= " where $where";

        if(is_numeric($offset) && is_numeric($limit))
            $sql .= " limit $offset, $limit";

//        if (empty($where))
//            $sql = "select * from {$this->table} limit $offset, $limit";
//        else
//            $sql = "select * from {$this->table}  where $where limit $offset, $limit";
        return $this->db->getAll($sql);
    }
}

?>