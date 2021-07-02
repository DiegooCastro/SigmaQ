<?php

class Cliente extends Validator
{
    // Declaracion de los atributos de la clase
    private $id = null;
    private $estado = null;
    private $empresa = null;
    private $telefono = null;
    private $correo = null;  
    private $usuario = null;  
    private $clave = null;  
    private $codigo = null;  

    /* Funcion para validar si el contenido del input esta vacio
    *  Parámetro: valor del input  
    *  Retorna un valor tipo booleano
    */ 
    public function validateNull($value){
        if ($value != null) {
            return true;
        }else{
            return false;
        }
    }

    /* Funcion para validar si el contenido del input esta vacio
    *  Parámetro: valor del input  
    *  Retorna un valor tipo booleano
    */ 
    public function setId($value)
    {
        if($this->validateNaturalNumber($value)){
            $this->id = $value;
            return true;
        }else{
            return false;
        }
    }

    /* Funcion para validar si el valor del codigo es numerico
    *  Parámetro: valor del input  
    *  Retorna un valor tipo booleano
    */ 
    public function setCodigo($value)
    {
        if($this->validateNaturalNumber($value)){
            $this->codigo = $value;
            return true;
        }else{
            return false;
        }
    }

    /* Funcion para validar si el estado es booleano 
    *  Parámetro: valor del input  
    *  Retorna un valor tipo booleano
    */ 
    public function setEstado($value)
    {
        if ($this->validateBoolean($value)) {
            $this->estado = $value;
            return true;
        } else {
            return false;
        }
    }

    /* Funcion para validar si el nombre de la empresa es de tipo String 
    *  Parámetro: valor del input  
    *  Retorna un valor tipo booleano
    */ 
    public function setEmpresa($value)
    {
        if ($this->validateString($value, 1, 40)) {
            $this->empresa = $value;
            return true;
        } else {
            return false;
        }
    }

    /* Funcion para validar si el telefono posee formato correcto
    *  Parámetro: valor del input  
    *  Retorna un valor tipo booleano
    */
    public function setTelefono($value)
    {
        if ($this->validatePhone($value)) {
            $this->telefono = $value;
            return true;
        }else {
            return false;
        }
    }

    /* Funcion para validar si el correo posee formato correcto
    *  Parámetro: valor del input  
    *  Retorna un valor tipo booleano
    */ 
    public function setCorreo($value)
    {
        if ($this->validateEmail($value)) {
            $this->correo = $value;
            return true;
        } else {
            return false;
        }
    }

    /* Funcion para validar si el usuario posee el tipo de dato correcto
    *  Parámetro: valor del input  
    *  Retorna un valor tipo booleano
    */
    public function setUsuario($value)
    {
        if ($this->validateAlphanumeric($value, 1, 50)) {
            $this->usuario = $value;
            return true;
        }else {
            return false;
        }
    }

    /* Funcion para validar si la clave posee el tipo de dato correcto
    *  Parámetro: valor del input  
    *  Retorna un valor tipo booleano
    */
    public function setClave($value)
    {
        if ($this->validatePassword($value)) {
            $this->clave = $value;
            return true;
        } else {
            return false;
        }
    }

    // Funciones get para obtener el valor de los atributos de la clase
    public function getId()
    {
        return $this->id;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function getEmpresa()
    {
        return $this->empresa;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }
    
    public function getCorreo()
    {
        return $this->correo;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getClave()
    {
        return $this->clave;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    // Funcion para verificar si el usuario esta activo requiere del parametro del nombre de usuario
    public function checkState($usuario)
    {
        // Declaracion de la sentencia SQL 
        $sql = 'SELECT estado FROM clientes where usuario = ? and estado = true';
        $params = array($usuario);
        if ($data = Database::getRow($sql, $params)) {
            return true;
        } else {
            return false;
        }
    }

    // Funcion para desactivar un cliente por superar el limite de intentos permitidos
    public function desactivateClient($usuario)
    {
        // Declaracion de la sentencia SQL 
        $sql = 'UPDATE clientes
        SET estado = false
        WHERE usuario = ?;';
        $params = array($usuario);
        return Database::executeRow($sql, $params);
    }

    // Funcion para validar si existe un usuario en la base de datos requiere el nombre del usuario como parametro
    public function checkUser($usuario)
    {
        // Declaracion de la sentencia SQL 
        $sql = 'SELECT codigocliente,estado,empresa FROM clientes WHERE usuario = ?';
        $params = array($usuario);
        if ($data = Database::getRow($sql, $params)) {
            $this->id = $data['codigocliente'];
            $this->empresa = $data['empresa'];
            $this->usuario = $usuario;
            return true;
        } else {
            return false;
        }
    }

    // Funcion para validar si la clave corresponde al usuario ingresado requiere la clave ingresada de parametro
    public function checkPassword($password)
    {
        // Declaracion de la sentencia SQL 
        $sql = 'SELECT clave FROM clientes WHERE codigocliente = ?';
        $params = array($this->id);
        $data = Database::getRow($sql, $params);
        if (password_verify($password, $data['clave'])) {
            return true;
        } else {
            return false;
        }
    }

    // Funcion para busqueda filtrada requiere el valor que se desea buscar 
    public function searchRows($value)
    {
        // Declaracion de la sentencia SQL 
        $sql = 'SELECT codigocliente,estado,empresa,telefono,correo,usuario,clave,intentos 
        from clientes
        WHERE codigocliente = ? 
        order by codigocliente';
        $params = array($value);
        return Database::getRows($sql, $params);
    }

    // Funcion verificar si existen usuarios activos en la base de daots
    public function readIndex()
    {
        // Declaracion de la sentencia SQL 
        $sql = 'SELECT codigocliente,estado,empresa,telefono,correo,usuario,clave,intentos 
        from clientes
        where estado = true';
        $params = null;
        return Database::getRows($sql, $params);
    }
    
    // Funcion para cargar todos los registros en la tabla 
    public function readAll()
    {
        // Declaracion de la sentencia SQL 
        $sql = 'SELECT codigocliente,estado,empresa,telefono,correo,usuario,clave,intentos 
        from clientes 
        order by codigocliente';
        $params = null;
        return Database::getRows($sql, $params);
    }

    // Funcion para cambiar el estado de un usuario a activo
    public function activateUser()
    {
        // Declaracion de la sentencia SQL 
        $sql = 'UPDATE clientes
        SET estado = true
        WHERE codigocliente = ?;';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

    // Funcion para registrar un usuario en la base de datos
    public function createRow()
    {
        // Encriptacion de la clave mediante el metodo password_hash
        $hash = password_hash($this->clave, PASSWORD_DEFAULT);
        // Declaracion de la sentencia SQL 
        $sql = 'INSERT INTO clientes(codigocliente, estado, empresa, telefono, correo, usuario, clave, intentos)
            VALUES (?, default, ?, ?, ?, ?, ?, default)';
        $params = array($this->id,$this->empresa, $this->telefono,$this->correo,$this->usuario, $hash);
        return Database::executeRow($sql, $params);
    }

    // Funcion para actualizar los datos de un cliente de la base de datos
    public function updateRow()
    {
        // Verifica si existe clave en caso de no existir se actualizan los datos menos la clave
        if ($this->clave != null) {
            // Se encripta la contraseña mediante el metodo password_hash
            $hash = password_hash($this->clave, PASSWORD_DEFAULT);
            // Declaracion de la sentencia SQL 
            $sql = 'UPDATE clientes
            SET codigocliente = ?, empresa= ?, telefono = ?, correo = ?, usuario = ?, clave = ?
            WHERE codigocliente = ?';
            $params = array($this->id ,$this->empresa, $this->telefono, $this->correo,$this->usuario,$hash,$this->codigo);
        } else {
            $sql = 'UPDATE clientes
            SET codigocliente = ?, empresa= ?, telefono = ?, correo = ?, usuario = ?
            WHERE codigocliente = ?';
            $params = array($this->id ,$this->empresa, $this->telefono, $this->correo,$this->usuario,$this->codigo);
        }    
        return Database::executeRow($sql, $params);
    }

    // Funcion para cargar los datos de un cliente en especifico
    public function readRow()
    {
        // Declaracion de la sentencia SQL 
        $sql = 'SELECT codigocliente,estado,empresa,telefono,correo,usuario,clave,intentos 
        from clientes 
        where codigocliente = ?';
        $params = array($this->id);
        return Database::getRow($sql, $params);
    }

    // Funcion para cambiar el estado de un cliente a desactivado 
    public function desactivateUser()
    {
        // Declaracion de la sentencia SQL 
        $sql = 'UPDATE clientes
        SET estado = false
        WHERE codigocliente = ?;';
        $params = array($this->id);
        return Database::executeRow($sql, $params);
    }

}