<?php
    include "clases.php";
    $menssage_client = "";
    $menssage_employee = "";
    $listado = 0; 
    $rol = ["", "cliente", "empleado", "administrador"];
    if (isset($_POST["nombre_cliente"]) && $_POST["nombre_cliente"] != ""){
        $nombre_cliente = $_POST["nombre_cliente"];
        $apellido_cliente = $_POST["apellido_cliente"];
        $dni_cliente = $_POST["dni_cliente"];
        $direccion_cliente = $_POST["direccion_cliente"];
        $telefono_cliente = $_POST["telefono_cliente"];
        $queryid = "SELECT * FROM clientes ORDER BY cliente_id DESC LIMIT 1;";
        $sql = mysqli_query(conectar(), $queryid);
        $id_cliente = mysqli_fetch_row($sql);
        // $id_cliente[0]++;
        $cliente = new Cliente($id_cliente, $nombre_cliente, $apellido_cliente, $dni_cliente, $direccion_cliente, $telefono_cliente);
        $menssage_client = $cliente->dar_alta();
    }

    elseif (isset($_POST["nombre_empleado"]) && $_POST["nombre_empleado"] != ""){
        $nombre_empleado = $_POST["nombre_empleado"];
        $apellido_empleado = $_POST["apellido_empleado"];
        $dni_empleado = $_POST["dni_empleado"];
        $direccion_empleado = $_POST["direccion_empleado"];
        $telefono_empleado = $_POST["telefono_empleado"];
        $sueldo_empleado = $_POST["sueldo_empleado"];
        $rol_empleado = $_POST["rol_empleado"];
        $fecha_empleado = $_POST["fecha_empleado"];
        $queryid = "SELECT * FROM empleados ORDER BY empleado_id DESC LIMIT 1;";
        $sql = mysqli_query(conectar(), $queryid);
        $id_empleado = mysqli_fetch_row($sql);
        //$id_empleado[0]++;
        $empleado = new Empleado($id_empleado, $nombre_empleado, $apellido_empleado, $dni_empleado, $direccion_empleado, $telefono_empleado, $sueldo_empleado, $rol_empleado, $fecha_empleado);
        $menssage_employee = $empleado->dar_alta();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=|, initial-scale=1.0">
    <title>Guia 3 | Lemos Fernando</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="contenedor_general">
        <h1><a href="index.php" class="linkTittle">Administrar alta y listado de clientes - empleados.</a></h1>
        <div class="contenedor_form">
            <div class="contenedor_cliente">
                <h2>Alta de cliente</h2>
                    <form class="cliente_form" action="" method="POST">
                        <label for="nombre_cliente">
                            Nombre
                            <input type="text" name="nombre_cliente" id="nombre_cliente">
                        </label>
                        <label for="apellido_cliente">
                            Apellido
                            <input type="text" name="apellido_cliente" id="apellido_cliente">
                        </label>
                        <label for="dni_cliente">
                            Nro Documento
                            <input type="number" maxlength="8"  pattern="[0-9]{10}" name="dni_cliente" id="dni_cliente">
                        </label>
                        <label for="direccion_cliente">
                            Dirección
                            <input type="text" name="direccion_cliente" id="direccion_cliente">
                        </label>
                        <label for="telefono_cliente">
                            Teléfono
                            <input type="text" maxlength="10"  pattern="[0-9]{10}" name="telefono_cliente" id="telefono_cliente">
                        </label>
                        <button class="btn">Cargar Cliente</button>
                            <?php if($menssage_client != ""){?>
                        <div class="menssage_client">
                            <p><?php echo $menssage_client;?></p>
                        </div>
                            <?php } ?>
                    </form>
            </div>
            <div class="contenedor_empleado">
                <h2>Alta de empleados</h2>
                <form class="empleado_form" action="" method="POST">
                    <label for="nombre_empleado">
                        Nombre
                        <input type="text" name="nombre_empleado" id="nombre_empleado">
                    </label>
                    <label for="apellido_empleado">
                        Apellido
                        <input type="text" name="apellido_empleado" id="apellido_empleado">
                    </label>
                    <label for="dni_empleado">
                        Nro Documento
                        <input type="number" maxlength="8" pattern="[0-9]{10}" name="dni_empleado" id="dni_empleado">
                    </label>
                    <label for="direccion_empleado">
                        Direccion
                        <input type="text" name="direccion_empleado" id="direccion_empleado">
                    </label>
                    <label for="telefono_empleado">
                        Telefono
                        <input type="text" maxlength="10" pattern="[0-9]{10}" name="telefono_empleado" id="telefono_empleado">
                    </label>
                    <label for="sueldo_empleado">
                        Sueldo
                        <input type="number" maxlength="9" step="0.01" name="sueldo_empleado" id="sueldo_empleado">
                    </label>
                    <label for="rol_empleado">
                        Rol
                        <select name="rol_empleado" id="rol_empleado">
                            <option value="administrador">Administrador</option>
                            <option value="empleado">Empleado</option>
                        </select>
                    </label>
                    <label for="fecha_empleado">
                        Fecha de ingreso
                        <input type="date" name="fecha_empleado" id="fecha_empleado">
                    </label>
                    <button class="btn">Cargar Empleado</button>
                        <?php if($menssage_employee != ""){?>
                    <div class="menssage_employee">
                            <p><?php echo $menssage_employee;?></p>
                    </div>
                        <?php }?>
                </form>
            </div>
        </div>
        <section class="contenedor_listas">
            <h1>Listados</h1>
            <form action="" method="POST" class="contenedor_buscador">
                <label class="menu_listas">
                    <input type="text" step="0.01" name="buscador">
                    <select name="rol">
                        <option value="1">Cliente</option>
                        <option value="2">Empleado</option>
                        <option value="3">Administrador</option>
                    </select>
                    <button class="btn"class="btn">buscar</button>
                </label>
            </form>

            <div class="contenedor_btn_listar">
                <form action="index.php#listado" method="POST">
                    <input type="hidden" name="listar" value="Cliente">
                    <button class="btn">Listar Clientes</button>
                </form>
                <form action="index.php#listado" method="POST">
                    <input type="hidden" name="listar" value="Empleado">
                    <button class="btn">Listar Empleados</button>
                </form>
            </div>
            
            <div id="listado">
            <?php 
            
            (isset($_POST['listar']) && $_POST['listar'] !== "") ? $_POST['listar']::listar() : "";

            if (isset($_POST["rol"]) && $_POST["rol"] == 1){
                Cliente::buscar($_POST['buscador'],$_POST["rol"]);
            }
            elseif (isset($_POST["rol"]) && $_POST["rol"] >= 2){
                Empleado::buscar($_POST['buscador'], $rol[$_POST["rol"]]);
            }
            
            ?>
            </div>
        </section>
    </main>
</body>
</html>    