<?php

class Comentario extends Model
{
    private $id;
    private $pregunta;
    private $usuarioId;
    private $respuesta;
    private $fechaPregunta;
    private $fechaRespuesta;
    private $productoId;
    private $usuarioUsername;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getPregunta()
    {
        return $this->pregunta;
    }

    public function setPregunta($pregunta)
    {
        $this->pregunta = $pregunta;
    }

    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    public function setUsuarioId($usuarioId)
    {
        $this->usuarioId = $usuarioId;
    }

    public function getRespuesta()
    {
        return $this->respuesta;
    }

    public function setRespuesta($respuesta)
    {
        $this->respuesta = $respuesta;
    }

    public function getFechaPregunta()
    {
        return $this->fechaPregunta;
    }

    public function setFechaPregunta($fechaPregunta)
    {
        $this->fechaPregunta = $fechaPregunta;
    }

    public function getFechaRespuesta()
    {
        return $this->fechaRespuesta;
    }

    public function setFechaRespuesta($fechaRespuesta)
    {
        $this->fechaRespuesta = $fechaRespuesta;
    }

    public function getProductoId()
    {
        return $this->productoId;
    }

    public function setProductoId($productoId)
    {
        $this->productoId = $productoId;
    }

    public function getUsuarioUsername()
    {
        return $this->usuarioUsername;
    }

    public function setUsuarioUsername($usuarioUsername)
    {
        $this->usuarioUsername = $usuarioUsername;
    }

    public function insertarComentario()
    {
        $array = [
            "Pregunta" => $this->getPregunta(),
            "FechaPregunta" => $this->getFechaPregunta(),
            "UsuarioId" => $this->getUsuarioId(),
            "UsuarioUsername" => $this->getUsuarioUsername(),
            "ProductoId" => $this->getProductoId()
        ];

        $this->setId($this->insert($array));
        return $this->getId();
    }

    public function insertarRespuesta()
    {
        $array = [
            "Id" => $this->getId(),
            "Respuesta" => $this->getRespuesta(),
            "FechaRespuesta" => $this->getFechaRespuesta()
        ];

        return $this->update($array);
    }

    public function traerUltimosComentarios($inicio, $pk)
    {
        $comentarios = array();

        $rows = $this->pageRows($inicio, 4, "ProductoId = $pk ORDER BY Id DESC");

        foreach($rows as $row)
        {
            $comentario = new Comentario();
            $comentario->db->disconnect();
            $comentario->setId($row["Id"]);
            $comentario->setPregunta($row["Pregunta"]);
            $comentario->setRespuesta($row["Respuesta"]);
            $comentario->setFechaPregunta($row["FechaPregunta"]);
            $comentario->setFechaRespuesta($row["FechaRespuesta"]);
            $comentario->setProductoId($row["ProductoId"]);
            $comentario->setUsuarioId($row["UsuarioId"]);
            $comentario->setUsuarioUsername($row["UsuarioUsername"]);
            $comentarios[] = $comentario;
        }

        return $comentarios;
    }

    public function contarComentarios($pk)
    {
        return $this->total("ProductoId = $pk");
    }
}

?>