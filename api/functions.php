<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once 'conexion.php';
$token    = isset($_POST['token']) ? $_POST['token'] : "";
$function = isset($_POST['function']) ? $_POST['function'] : "";

if ($token == "cmVnaXN0cm9fYmQ=") /* Validacion de token*/ {
    /* Listar registros */
    if ($function == "listRegs") {
        /* Query traer registros */
        $sql    = "SELECT * FROM regs";
        $stm    = $conexion->prepare($sql);
        $stm->execute();
        $select = $stm->fetchAll(); /* Almacena el resultado en un arreglo */
        $stm->closeCursor();
        $info = [];
        foreach ($select as $regs) {/* Crean un arreglo con la estructura adecuada para la tabla */
            $btnExam = "<div style='text-align: center;'>
			<button type=\"button\" class=\"btn btn-primary\" style=\"border: 0;  margin-bottom: 5px; margin-right: 5px;padding: 3%;\" onclick=\"editReg('" . $regs->id . "|" . $regs->name . "|" . $regs->lastName . "')\">
			<i class=\"material-icons\">edit</i>
			</button>
			<button type=\"button\" class=\"btn btn-danger\" style=\"border: 0;  margin-bottom: 5px; padding: 3%; margin-right: 5px;\" onclick=\"deleteReg(" . $regs->id . ")\">
			<i class=\"material-icons\">delete</i>
			</button>
			</div>";
            $onclick = "revisar(" . $regs->id . ")";
            $datos = array(
                'id'       => $regs->id,
                'name'     => $regs->name,
                'lastName' => $regs->lastName,
                'btn'      => $btnExam
            );
            array_push($info, $datos);
        }
        $result["tablaRegs"] = $info;
        echo json_encode($result);/* Retorna los datos procesados para ser mostrados en la tabla */
    }

    /* Guarda los cambios realizados a los registros nuevos/existentes */
    if ($function == "saveReg") {
        $regId       = isset($_POST['regId'])       ? $_POST['regId']       : "";
        $regName     = isset($_POST['regName'])     ? $_POST['regName']     : "";
        $regLastName = isset($_POST['regLastName']) ? $_POST['regLastName'] : "";
        $date            = date('Y-m-d');
        if ($regId == "") {/* Realiza el inser de registros nuevos, validando si no traen un id */
            $sql    = "INSERT INTO regs (name,lastName,date) VALUES ((?),(?),(?))";
            $stm    = $conexion->prepare($sql);
            $stm->bindValue(1, $regName,     PDO::PARAM_STR);
            $stm->bindValue(2, $regLastName, PDO::PARAM_STR);
            $stm->bindValue(3, $date,        PDO::PARAM_STR);
            $stm->execute();
            $stm->closeCursor();
        } else {/* Realiza el update de registros existentes */
            $sql    = "UPDATE regs SET name = (?), lastName = (?), date = (?) WHERE id =(?)";
            $stm    = $conexion->prepare($sql);
            $stm->bindValue(1, $regName,     PDO::PARAM_STR);
            $stm->bindValue(2, $regLastName, PDO::PARAM_STR);
            $stm->bindValue(3, $date,        PDO::PARAM_STR);
            $stm->bindValue(4, $regId,       PDO::PARAM_STR);
            $stm->execute();
            $stm->closeCursor();
        }
        echo json_encode(array("mensaje" => "Se guardo el registro"));/* Notifica que la operacion fue realizada */
    }

    /* Realiza la eliminacion de los registros */
    if ($function == "deleteReg") {
        $id     = isset($_POST['regId'])       ? $_POST['regId']       : "";
        /* Realiza la eliminacion del registro seleccionado con base en su id */
        $sql    = "DELETE FROM regs WHERE id = (?)";
        $stm    = $conexion->prepare($sql);
        $stm->bindValue(1, $id, PDO::PARAM_STR);
        $stm->execute();
        $stm->closeCursor();
        echo json_encode(array("mensaje" => "Se elimino el registro"));/* Notifica que la operacion fue realizada */
    }
}
