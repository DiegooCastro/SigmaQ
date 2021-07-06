<?php

class EstadoCuenta extends Validator
{
    // Declaración de atributos
    private $id = null;
    private $responsable = null;	
    private $sociedad = null;		
    private $cliente = null;	
    private $codigo = null;	
    private $factura = null;
    private $asignacion = null;
    private $fechaContable = null;
    private $clase = null;
    private $vencimiento = null;
    private $diasVencidos = null;
    private $divisa = null;		
    private $total = null;

    // Metodos para asignar valores a los atributos
    public function setId($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->id = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setResponsable($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->responsable = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setSociedad($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->sociedad = $value;
            return true;
        } else {
            return false;
        }
        // $this->sociedad = $value;
        // return true;
    }

    public function setCliente($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->cliente = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setCodigo($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->codigo = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setFactura($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->factura = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setAsignacion($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->asignacion = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setClase($value)
    {
        if ($this->validateAlphabetic($value, 1, 4)) {
            $this->clase = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setFechaContable($value)
    {
        if ($this->validateDate($value)) {
            $this->fechaContable = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setVencimiento($value)
    {
        if ($this->validateDate($value)) {
            $this->vencimiento = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDiasVencidos($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->diasVencidos = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setDivisa($value)
    {
        if ($this->validateNaturalNumber($value)) {
            $this->divisa = $value;
            return true;
        } else {
            return false;
        }
    }

    public function setTotal($value)
    {
        if ($this->validateMoney($value)) {
            $this->total = $value;
            return true;
        } else {
            return false;
        }
    }

    // Funciones para obtener los valores de los atributos

    public function getId()
    {
        return $this->id;
    }

    public function getResponsable()
    {
        return $this->responsable;
    }

    public function getSociedad()
    {
        return $this->sociedad;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function getFactura()
    {
        return $this->factura;
    }

    public function getAsignacion()
    {
        return $this->asignacion;
    }

    public function getFechaContable()
    {
        return $this->fechaContable;
    }

    public function getClase()
    {
        return $this->clase;
    }

    public function getVencimiento()
    {
        return $this->vencimiento;
    }

    public function getDivisa()
    {
        return $this->divisa;
    }

    public function getTotal()
    {
        return $this->total;
    }

    // Métodos para realizar las operaciones SCRUD

    // Función para buscar un registro
    public function searchEstado($value)
    {
        $sql = "SELECT s.idsociedad, s.sociedad, CONCAT(a.nombre,' ',a.apellido) AS responsable, c.usuario, ec.codigo, ec.factura, ec.asignacion, ec.fechacontable, ec.clase, ec.vencimiento, (vencimiento - CURRENT_DATE) AS diasrestantes, d.divisa, ec.totalgeneral
                FROM estadocuentas ec
                INNER JOIN administradores a
                ON ec.responsable = a.codigoadmin
                INNER JOIN sociedades s
                ON ec.sociedad = s.idsociedad
                INNER JOIN clientes c
                ON ec.cliente = c.codigocliente
                INNER JOIN divisas d
                ON ec.divisa = d.iddivisa
                WHERE s.sociedad LIKE ? OR  CONCAT(a.nombre,' ',a.apellido) LIKE ?
                ORDER BY responsable";
        $params = array("%$value%","%$value%");
        return Database::getRows($sql, $params);
    }

    // Función para buscar un registro en el sitio público
    public function searchEstadoPublico($value)
    {
        $sql = "SELECT s.idsociedad, s.sociedad, CONCAT(a.nombre,' ',a.apellido) AS responsable, c.usuario, ec.codigo, ec.factura, ec.asignacion, ec.fechacontable, ec.clase, ec.vencimiento, (vencimiento - CURRENT_DATE) AS diasrestantes, d.divisa, ec.totalgeneral
                FROM estadocuentas ec
                INNER JOIN administradores a
                ON ec.responsable = a.codigoadmin
                INNER JOIN sociedades s
                ON ec.sociedad = s.idsociedad
                INNER JOIN clientes c
                ON ec.cliente = c.codigocliente
                INNER JOIN divisas d
                ON ec.divisa = d.iddivisa
                WHERE (s.sociedad LIKE ? OR  CONCAT(a.nombre,' ',a.apellido) LIKE ?) AND (ec.estado = true AND c.codigocliente = ?)
                ORDER BY responsable";
        $params = array("%$value%","%$value%", $_SESSION['codigocliente']);
        return Database::getRows($sql, $params);
    }

    // Función para llenar la tabla
    public function SelectEstadoCuenta()
    {
        $sql = "SELECT ec.idestadocuenta, s.idsociedad, s.sociedad, CONCAT(a.nombre,' ',a.apellido) AS responsable, c.usuario, ec.codigo, ec.factura, ec.asignacion, ec.fechacontable, ec.clase, ec.vencimiento, (vencimiento - CURRENT_DATE) AS diasrestantes, d.divisa, ec.totalgeneral, ec.estado
                FROM estadocuentas ec
                INNER JOIN administradores a
                ON ec.responsable = a.codigoadmin
                INNER JOIN sociedades s
                ON ec.sociedad = s.idsociedad
                INNER JOIN clientes c
                ON ec.cliente = c.codigocliente
                INNER JOIN divisas d
                ON ec.divisa = d.iddivisa
                ORDER BY s.sociedad";
        $params = null;
        print($params);
        return Database::getRows($sql, $params);
    }

    // Función para seleccionar solo un estado
    public function SelectOneEstadoCuenta()
    {
        $sql = "SELECT ec.idestadocuenta, s.idsociedad, s.sociedad, a.codigoadmin, CONCAT(a.nombre,' ',a.apellido) AS responsable, c.codigocliente, c.usuario, ec.codigo, ec.factura, ec.asignacion, ec.fechacontable, ec.clase, ec.vencimiento, (vencimiento - CURRENT_DATE) AS diasrestantes,d.iddivisa, d.divisa, ec.totalgeneral
                FROM estadocuentas ec
                INNER JOIN administradores a
                ON ec.responsable = a.codigoadmin
                INNER JOIN sociedades s
                ON ec.sociedad = s.idsociedad
                INNER JOIN clientes c
                ON ec.cliente = c.codigocliente
                INNER JOIN divisas d
                ON ec.divisa = d.iddivisa
                WHERE idestadocuenta = ?";
        $params = array($this->id);
        // print($params);
        return Database::getRows($sql, $params);
    }

    // Función para mostrar la tabla en el sitio público
    public function SelectEstadoCuentaPublico()
    {
        $sql = "SELECT ec.idestadocuenta, s.idsociedad, s.sociedad, CONCAT(a.nombre,' ',a.apellido) AS responsable,  ec.cliente, c.usuario, ec.codigo, ec.factura, ec.asignacion, ec.fechacontable, ec.clase, ec.vencimiento, (vencimiento - CURRENT_DATE) AS diasrestantes, d.divisa, ec.totalgeneral, ec.estado
                FROM estadocuentas ec
                INNER JOIN administradores a
                ON ec.responsable = a.codigoadmin
                INNER JOIN sociedades s
                ON ec.sociedad = s.idsociedad
                INNER JOIN clientes c
                ON ec.cliente = c.codigocliente
                INNER JOIN divisas d
                ON ec.divisa = d.iddivisa
                WHERE ec.estado = true AND ec.cliente = ?
                ORDER BY s.sociedad";
        $params = array($_SESSION['codigocliente']);;
        // print_r($_SESSION['codigocliente']);
        return Database::getRows($sql, $params);
    }

    // Función para insertar un estado
    public function insertEstado() {
        $query="INSERT INTO public.estadocuentas(responsable, sociedad, cliente, codigo, factura, asignacion, fechacontable, clase, vencimiento, divisa, totalgeneral)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $params = array($this->responsable, $this->sociedad, $this->cliente, $this->codigo, $this->factura, $this->asignacion, $this->fechaContable, $this->clase, $this->vencimiento, $this->divisa, $this->total);
        return Database::executeRow($query, $params);
    }

    // Función para actualizar un estado
    public function updateEstado() {
        $query="UPDATE public.estadocuentas
                SET responsable=?, sociedad=?, cliente=?, codigo=?, factura=?, asignacion=?, fechacontable=?, clase=?, vencimiento=?, divisa=?, totalgeneral=?
                WHERE idestadocuenta = ?";
        $params = array($this->responsable, $this->sociedad, $this->cliente, $this->codigo, $this->factura, $this->asignacion, $this->fechaContable, $this->clase, $this->vencimiento, $this->divisa, $this->total, $this->id);
        return Database::executeRow($query, $params);
    }

    //Función para desactivar un registro
    public function desableEstado() {
        $query="UPDATE estadocuentas SET estado=false WHERE idestadocuenta = ?";
        $params=array($this->id);
        return Database::executeRow($query, $params);
    }

    //Función para activar un registro
    public function enableEstado() {
        $query="UPDATE estadocuentas SET estado=true WHERE idestadocuenta = ?";
        $params=array($this->id);
        return Database::executeRow($query, $params);
    }

}