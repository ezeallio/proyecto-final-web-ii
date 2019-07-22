<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 23/6/2019
 * Time: 12:11
 */

class RegistroCompra extends Model
{
    private $id;
    private $compraId;
    private $compra;
    private $cantidad;
    private $nombreProducto;
    private $precioUnitario;
    private $nombreImagenPrincipal;
    private $tipoMetodoEntrega;
    private $detalleEntrega;
    private $vendedorId;
    private $productoId;
    private $compradorId;
    private $comprador;
    private $estadoFacturacionId;
    private $estadoFacturacion;

    /**
     * @return Database
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param Database $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }

    /**
     * @return mixed
     */
    public function getEstadoFacturacionId()
    {
        return $this->estadoFacturacionId;
    }

    /**
     * @param mixed $estadoFacturacionId
     */
    public function setEstadoFacturacionId($estadoFacturacionId)
    {
        $this->estadoFacturacionId = $estadoFacturacionId;
    }

    /**
     * @return mixed
     */
    public function getEstadoFacturacion()
    {
        return $this->estadoFacturacion;
    }

    /**
     * @param mixed $estadoFacturacion
     */
    public function setEstadoFacturacion($estadoFacturacion)
    {
        $this->estadoFacturacion = $estadoFacturacion;
    }

    /**
     * @return mixed
     */
    public function getComprador()
    {
        return $this->comprador;
    }

    /**
     * @param mixed $comprador
     */
    public function setComprador($comprador)
    {
        $this->comprador = $comprador;
    }

    /**
     * @return mixed
     */
    public function getProductoId()
    {
        return $this->productoId;
    }

    /**
     * @param mixed $productoId
     */
    public function setProductoId($productoId)
    {
        $this->productoId = $productoId;
    }

    /**
     * @return mixed
     */
    public function getCompradorId()
    {
        return $this->compradorId;
    }

    /**
     * @param mixed $compradorId
     */
    public function setCompradorId($compradorId)
    {
        $this->compradorId = $compradorId;
    }

    /**
     * @return mixed
     */
    public function getVendedorId()
    {
        return $this->vendedorId;
    }

    /**
     * @param mixed $vendedorId
     */
    public function setVendedorId($vendedorId)
    {
        $this->vendedorId = $vendedorId;
    }

    /**
     * @return mixed
     */
    public function getTipoMetodoEntrega()
    {
        return $this->tipoMetodoEntrega;
    }

    /**
     * @param mixed $tipoMetodoEntrega
     */
    public function setTipoMetodoEntrega($tipoMetodoEntrega)
    {
        $this->tipoMetodoEntrega = $tipoMetodoEntrega;
    }

    /**
     * @return mixed
     */
    public function getDetalleEntrega()
    {
        return $this->detalleEntrega;
    }

    /**
     * @param mixed $detalleEntrega
     */
    public function setDetalleEntrega($detalleEntrega)
    {
        $this->detalleEntrega = $detalleEntrega;
    }

    /**
     * @return mixed
     */
    public function getNombreProducto()
    {
        return $this->nombreProducto;
    }

    /**
     * @param mixed $nombreProducto
     */
    public function setNombreProducto($nombreProducto)
    {
        $this->nombreProducto = $nombreProducto;
    }

    /**
     * @return mixed
     */
    public function getPrecioUnitario()
    {
        return $this->precioUnitario;
    }

    /**
     * @param mixed $precioUnitario
     */
    public function setPrecioUnitario($precioUnitario)
    {
        $this->precioUnitario = $precioUnitario;
    }

    /**
     * @return mixed
     */
    public function getNombreImagenPrincipal()
    {
        return $this->nombreImagenPrincipal;
    }

    /**
     * @param mixed $nombreImagenPrincipal
     */
    public function setNombreImagenPrincipal($nombreImagenPrincipal)
    {
        $this->nombreImagenPrincipal = $nombreImagenPrincipal;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCompraId()
    {
        return $this->compraId;
    }

    /**
     * @param mixed $compraId
     */
    public function setCompraId($compraId)
    {
        $this->compraId = $compraId;
    }

    /**
     * @return mixed
     */
    public function getCompra()
    {
        return $this->compra;
    }

    /**
     * @param mixed $compra
     */
    public function setCompra($compra)
    {
        $this->compra = $compra;
    }

    /**
     * @return mixed
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * @param mixed $cantidad
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    public function insertarRegistroCompra()
    {
        $array = [
            "CompraId" => $this->getCompraId(),
            "Cantidad" => $this->getCantidad(),
            "NombreProducto" => $this->getNombreProducto(),
            "PrecioUnitario" => $this->getPrecioUnitario(),
            "NombreImagenPrincipal" => $this->getNombreImagenPrincipal(),
            "TipoMetodoEntrega" => $this->getTipoMetodoEntrega(),
            "DetalleEntrega" => $this->getDetalleEntrega(),
            "VendedorId" => $this->getVendedorId(),
            "ProductoId" => $this->getProductoId(),
            "CompradorId" => $this->getCompradorId(),
            "EstadoFacturacionId" => 1
        ];

        $id = $this->insert($array);

        if ($id)
            $this->setId($id);

        return $id;
    }

    public function traerRegistrosCompras($pk)
    {
        $traerRegistroCompra = array();

        $rows = $this->pageRows(0, PHP_INT_MAX, "CompraId = $pk");

        foreach ($rows as $row) {
            $registroCompra = new RegistroCompra();
            $registroCompra->db->disconnect();
            $registroCompra->setId($row["Id"]);
            $registroCompra->setCompraId($row["CompraId"]);
            $registroCompra->setCantidad($row["Cantidad"]);
            $registroCompra->setDetalleEntrega($row["DetalleEntrega"]);
            $registroCompra->setNombreImagenPrincipal($row["NombreImagenPrincipal"]);
            $registroCompra->setPrecioUnitario($row["PrecioUnitario"]);
            $registroCompra->setNombreProducto($row["NombreProducto"]);
            $registroCompra->setTipoMetodoEntrega($row["TipoMetodoEntrega"]);
            $registroCompra->setVendedorId($row["VendedorId"]);
            $registroCompra->setProductoId($row["ProductoId"]);
            $registroCompra->setCompradorId($row["CompradorId"]);
            $traerRegistroCompra[] = $registroCompra;
        }

        return $traerRegistroCompra;
    }

    /**
     * Retorna si el usuario dado realizó una compra del producto dado
     *
     * @param $idUsuario
     * @param $idProducto
     * @return bool
     */
    public function realizoUsuarioCompraProducto($idUsuario, $idProducto)
    {
        return $this->pageRows(0, 1, "ProductoId = $idProducto AND CompradorId = $idUsuario") ? true : false;
    }

    public function traerListaDeRegistroCompraPorVendedor($pk)
    {
        $registroCompras = array();

        $rows = $this->pageRows(0, PHP_INT_MAX, "VendedorId = $pk and EstadoFacturacionId = 1");

        foreach ($rows as $row) {

            $registroCompra = new RegistroCompra();
            $registroCompra->db->disconnect();

            $registroCompra->setCompraId($row["CompraId"]);

            $registroCompra->setCompra(new Compra());
            $registroCompra->getCompra()->traerCompra($registroCompra->getCompraId());
            $registroCompra->getCompra()->db->disconnect();

            $mesCompra = date("m", strtotime($registroCompra->getCompra()->getFechaCompra()));

            if ($mesCompra == date("m")) {

                $registroCompra->setId($row["Id"]);
                $registroCompra->setCompradorId($row["CompradorId"]);
                $registroCompra->setCantidad($row["Cantidad"]);
                $registroCompra->setNombreProducto($row["NombreProducto"]);
                $registroCompra->setPrecioUnitario($row["PrecioUnitario"]);
                $registroCompra->setVendedorId($row["VendedorId"]);
                $registroCompras[] = $registroCompra;
            }
        }

        return $registroCompras;
    }

    public function traerListaDeRegistroComprasPorCompraId($compraId)
    {
        $registroCompras = array();

        $rows = $this->pageRows("", "", "EstadoFacturacionId = 1 AND CompraId = $compraId ORDER BY VendedorId");

        foreach ($rows as $row) {

            $registroCompra = new RegistroCompra();
            $registroCompra->db->disconnect();

            $registroCompra->setId($row["Id"]);
            $registroCompra->setCompraId($row["CompraId"]);
            $registroCompra->setVendedorId($row["VendedorId"]);
            $registroCompra->setCantidad($row["Cantidad"]);
            $registroCompra->setNombreProducto($row["NombreProducto"]);
            $registroCompra->setPrecioUnitario($row["PrecioUnitario"]);
            $registroCompras[] = $registroCompra;
        }

        return $registroCompras;
    }

    public function actualizarFacturado($pk)
    {

        $rows = $this->pageRows(0, PHP_INT_MAX, "VendedorId = $pk and EstadoFacturacionId = 1 ");

        if ($rows) {
            foreach ($rows as $row) {
                $row["EstadoFacturacionId"] = 2;

                if (!$this->update($row)) {
                    $rows = null;
                    break;
                }
            }
        }

    }

    public function actualizarFacturadoMensual($array)
    {

        foreach ($array as $vendedorId) {

            $row = $this->pageRows(0, PHP_INT_MAX, "VendedorId = $vendedorId and EstadoFacturacionId = 1 ");

            $row[0]["EstadoFacturacionId"] = 2;

            if (!$this->update($row[0])) {
                $row = null;
                break;
            }
        }

    }

    public function traerCantidadDeRegistoCompras($vendedorId)
    {
        return $this->total("VendedorId = $vendedorId and EstadoFacturacionId = 1");
    }
}