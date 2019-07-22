<?php

class Database
{
    protected $conn = false;  //DB connection resources
    protected $stmt;

    public function __construct($config = array())
    {
        $host = isset($config['host'])? $config['host'] : 'localhost';
        $user = isset($config['user'])? $config['user'] : 'root';
        $password = isset($config['password'])? $config['password'] : '';
        $dbname = isset($config['dbname'])? $config['dbname'] : '';
        $port = isset($config['port'])? $config['port'] : '3306';

        $this->conn = mysqli_connect($host, $user, $password) or die("Error en la conexión a la base de datos");

        mysqli_select_db($this->conn, $dbname) or die("Error en la selección de la base de datos");

        /* change character set to utf8 */
        if (!$this->conn->set_charset("utf8"))
            die("Error cargando charset UTF-8");
    }

    public function query($sql){

        $this->stmt = $sql;

        // Escribo statement en el log

        $str = "[". date("Y-m-d H:i:s") ."]  " . $sql . PHP_EOL;

        file_put_contents("sql-log.txt", $str,FILE_APPEND);

        $result = mysqli_query($this->conn, $this->stmt);



        if (! $result) {

            die($this->errno().':'.$this->error().'<br />Error SQL statement is '.$this->stmt.'<br />');

        }

        return $result;

    }

    /**

     * Obtiene número de error

     * @access private

     * @return int

     */
    public function errno(){

        return mysqli_errno($this->conn);

    }

    /**

     * Obtiene mensaje de error

     * @access private

     * @return string

     */
    public function error(){

        return mysqli_error($this->conn);

    }

    /**

     * Obtiene la primera columna de la primera fila

     * @access public

     * @param $sql

     * @return bool

     */
    public function getOne($sql){

        $result = $this->query($sql);

        $row = mysqli_fetch_row($result);

        return $row ? $row[0] : false;
    }

    /**

     * Obtiene la primera fila

     * @access public

     * @param $sql

     * @return mixed

     */

    public function getRow($sql){

        if ($result = $this->query($sql)) {
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            return false;
        }

    }

    /**

     * Obtener todas las filas de la consulta

     * @access public

     * @param $sql

     * @return $list an 2D array containing all result records

     */

    public function getAll($sql){

        $result = $this->query($sql);

        $list = array();

        while ($row = mysqli_fetch_assoc($result))
            $list[] = $row;

        return $list;

    }

    /**

     * Obtiene el valor de la primera columna en todas las filas seleccionadas

     * @access public

     * @param $sql string SQL query statement

     * @return $list array an array of the value of this column

     */

    public function getCol($sql){

        $result = $this->query($sql);

        $list = array();

        while ($row = mysqli_fetch_row($result))
            $list[] = $row[0];

        return $list;
    }

    /**

     * Obtiene el id autogenerado que se utilizó en el último insert o update

     */

    public function getInsertId(){
        return mysqli_insert_id($this->conn);
    }

    /**
     * Obtener Cantidad de Filas Afectadas
     *
     * Obtiene la cantidad de filas afectadas por la última query
     *
     * @access public
     * @return int
     */
    public function getAffectedRows()
    {
        return $this->conn->affected_rows;
    }

    /**
     * Desconectar
     *
     * Cierra la conexión con la base de datos
     *
     * @access public
     */
    public function disconnect()
    {
        $this->conn->close();
    }
}
?>