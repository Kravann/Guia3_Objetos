<?php
    # DATABASE CONNECTED FUNCTION
    function conectar(){
        $server = "localhost";
        $user = "root";
        $pass = "";
        $bd = "LemosGuia3";
        $c = mysqli_connect($server, $user, $pass, $bd);
        return $c;
    }

    # LIST CLIENT
    function crear_lista_clientes($data){?>
        <table>
            <tr>
                <th>Nro Cliente</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Nro Documento</th>
                <th>Direccion</th>
                <th>Teléfono</th>
            </tr>
            <?php while($form_data = mysqli_fetch_assoc($data)){?>
            <tr>
                <td><?php echo $form_data["cliente_id"];?></td>
                <td><?php echo $form_data["nombre"];?></td>
                <td><?php echo $form_data["apellido"];?></td>
                <td><?php echo $form_data["dni"];?></td>
                <td><?php echo $form_data["direccion"];?></td>
                <td><?php echo $form_data["telefono"];?></td>
            </tr>
            <?php }?>
        </table>
    <?php 
    }

    # LIST EMPLOYEE
    function crear_lista_empleados($data){ ?>
        <table>
                <tr>
                    <th>Nro Empleado</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Nro Documento</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Sueldo</th>
                    <th>Rol</th>
                    <th>Antiguedad</th>
                </tr>
                <?php while($form_data = mysqli_fetch_assoc($data)){?>
                <tr>
                    <td><?php echo $form_data['empleado_id'];?></td>
                    <td><?php echo $form_data['nombre'];?></td>
                    <td><?php echo $form_data['apellido'];?></td>
                    <td><?php echo $form_data['dni'];?></td>
                    <td><?php echo $form_data['direccion'];?></td>
                    <td><?php echo $form_data['telefono'];?></td>
                    <td><?php echo $form_data['sueldo'];?></td>
                    <td><?php echo $form_data['rol'];?></td>
                    <td><?php echo $form_data['antiguedad'];?></td>
                </tr>
                <?php }?>
                </table>
    <?php }

    # ABSTRACT PERSON CLASS 
    abstract class Persona{
        // Attributes
        protected $nombre;
        protected $apellido;
        protected $dni;

        // Builder
        public function __construc($nombre, $apellido, $dni){
            $this -> nombre = $nombre;
            $this -> apellido = $apellido;
            $this -> dni = $dni;
        }

        // Methods
        // mostrarDatos
        public abstract function mostrar_form_datas();
        // darDeAlta
        public abstract function dar_alta();
        // buscar
        public abstract static function buscar($term, $rol);
        // saludar
        protected function saludar(){
            echo 'Hola soy '.$this->nombre .' '.$this->apellido.' y soy de la clase '.get_class($this);
        }
    }

    # CLIENTE CLASS
    class Cliente extends Persona{
        // Attributes
        private $cliente_id;
        private $direccion;
        private $telefono;

        // Builder
        public function __construct($cliente_id, $nombre, $apellido, $dni, $direccion, $telefono){
            parent::__construc($nombre, $apellido, $dni);
            $this-> cliente_id = $cliente_id;
            $this-> direccion = $direccion;
            $this-> telefono = $telefono;
        }

        // Methods
        public function mostrar_form_datas(){
            echo "Nombre: ".$this->nombre;
            echo "Apellido: ".$this->apellido;
            echo "NroDocumento: ".$this->dni;
            echo "Dirección: ".$this->direccion;
            echo "Teléfono: ".$this->telefono;
        }

        public function dar_alta(){
            $message = "";
            $conn = conectar();
            $sql = "INSERT INTO clientes (nombre, apellido, dni, direccion, telefono) VALUES ('$this->nombre', '$this->apellido', $this->dni, '$this->direccion', $this->telefono)";
            mysqli_query($conn, $sql);

            if (mysqli_affected_rows($conn)>0){
                $message = "¡¡Se registro un cliente con éxito!!";
                }
            else{
                $message = "¡¡No se pudo registrar al nuevo cliente, intente de nuevo!!";
                }
            return $message;
        }

        public static function buscar($term, $rol){
            $conn = conectar();

            if (gettype($term) == "integer"){
                $sql = "SELECT * FROM clientes WHERE cliente_id like %$term% or dni like %$term% or telefono like %$term%;";
                }
            elseif (gettype($term) == "string"){
                $sql = "SELECT * FROM clientes where nombre like '%$term%' or apellido like '%$term%' or direccion like '%$term%';";
                }

            $result = mysqli_query($conn, $sql);
            crear_lista_clientes($result);
        }

        public static function listar(){
            $sql = "SELECT * FROM clientes";
            $result = mysqli_query(conectar() ,$sql);
            crear_lista_clientes($result);
        }

        public function saludar(){
            parent::saludar();
        }
        
    }

    // EMPLOYEE CLASS
    class Empleado extends Persona{
        // Attributes
        private $empleado_id;
        private $direccion;
        private $telefono;
        private $sueldo;
        private $rol;
        private $antiguedad;

        // Builder
        public function __construct($empleado_id, $nombre, $apellido, $dni, $direccion, $telefono, $sueldo, $rol, $antiguedad){
            echo "aqui empieza el fallo??";
            parent::__construc($nombre, $apellido, $dni);
            echo "aqui empieza el fallo??";
            $this-> empleado_id = $empleado_id;
            $this-> direccion = $direccion;
            $this-> telefono = $telefono;
            $this-> sueldo = $sueldo;
            $this-> rol = $rol;
            $this-> antiguedad = $antiguedad;
        }

        // Methods
        public function mostrar_form_datas(){
            echo "NroEmpleado: ".$this->empleado_id;
            echo "Nombre: ".$this->nombre;
            echo "Apellido: ".$this->apellido;
            echo "NroDocumento: ".$this->dni;
            echo "Direccion: ".$this->direccion;
            echo "Telefono: ".$this->telefono;
            echo "Sueldo: ".$this->sueldo;
            echo "Rol: ".$this->rol;
            echo "Antigüedad: ".$this->antiguedad;
        }

        public function dar_alta(){
            $message = "";
            $conn = conectar();
            $sql = "INSERT INTO empleados (nombre, apellido, dni, direccion, telefono, sueldo, rol, antiguedad) VALUES ('$this->nombre', '$this->apellido', $this->dni,'$this->direccion', $this->telefono, $this->sueldo, '$this->rol', '$this->antiguedad')";
            mysqli_query($conn, $sql);

            if (mysqli_affected_rows($conn)>0){
                $message = "¡¡Se registro un empleado con éxito!!";
                }
            else{
                $message = "¡¡No se pudo registrar al empleado, intente de nuevo!!";
                }
            return $message;
        }

        public static function buscar($term, $rol){
            $conn = conectar();

            if ($term == ""){
                $sql = "SELECT * FROM empleados WHERE rol = $rol;";
            }
            elseif (gettype($term) === "string"){
                $sql = "SELECT * FROM empleados WHERE nombre like '%$term%' or apellido like '%$term%' or direccion like '%$term%' or antiguedad like '%$term%' and rol = '$rol';";
            }
            elseif (gettype($term) === "integer"){
                $sql = "SELECT * FROM empleados WHERE empleado_id like %$term% or dni like %$term% or telefono like %$term% or sueldo like %$term%';";
            }
            $result = mysqli_query($conn, $sql);
            crear_lista_empleados($result);
        }

        public static function listar(){
            $sql = "SELECT * FROM empleados";
            $result = mysqli_query(conectar(), $sql);

            crear_lista_empleados($result);
        }

        public function saludar(){
            parent::saludar();
        }
    }

?>