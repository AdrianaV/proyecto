<?php
include "config.php";
include "utils.php";

$dbConn =  connect($db);

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['id']))
    {
      //Mostrar un post
      $sql = $dbConn->prepare("SELECT * usuario where id=:id");
      $sql->bindValue(':id', $_GET['id']);
      $sql->execute();
      header("HTTP/1.1 200 OK");
      echo json_encode(  $sql->fetch(PDO::FETCH_ASSOC)  );
      exit();
    }
else {
      //Mostrar lista de post
      $sql = $dbConn->prepare("SELECT * FROM usuario where rol=3");
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode( $sql->fetchAll()  );
      exit();
  }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $input = $_POST;

     // Validación básica de los campos de entrada
    $requiredFields = ['documento', 'nombres', 'apellidos', 'correo', 'telefono', 'password', 'rol'];
    foreach ($requiredFields as $field) {
        if (empty($input[$field])) {
            header("HTTP/1.1 400 Bad Request 1 $field");
            echo json_encode(['error' => "El campo $field es obligatorio."]);
            exit();
        }
    }

    // Determinar qué lógica ejecutar en función del rol
    if ($input['rol'] == 2) {
        insertarUsuarioRol2($dbConn, $input);
    } elseif ($input['rol'] == 3) {
        insertarUsuarioRol3($dbConn, $input);
    } else {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(['error' => "Rol no válido."]);
        exit();
    }
}

function insertarUsuarioRol2($dbConn, $input) {
    $sql = "INSERT INTO usuario
            (documento, nombres, apellidos, correo, telefono, password, rol)
            VALUES
            (:documento, :nombres, :apellidos, :correo, :telefono, :password, :rol)";

    try {
        $statement = $dbConn->prepare($sql);
        bindAllValues($statement, $input);
        $statement->execute();

        $postCodigo = $dbConn->lastInsertId();
        if ($postCodigo) {
            $input['codigo'] = $postCodigo;
            header("HTTP/1.1 200 OK");
            echo json_encode($input);
            exit();
        } else {
            header("HTTP/1.1 500 Internal Server Error 1");
            echo json_encode(['error' => 'Failed to insert data.']);
            exit();
        }
    } catch (Exception $e) {
        header("HTTP/1.1 500 Internal Server Error 2");
        echo json_encode(['error' => $e->getMessage()]);
        exit();
    }
}

function insertarUsuarioRol3($dbConn, $input) {
    $requiredFields = ['ubicacion', 'negocio', 'detalle', 'referencias'];
    foreach ($requiredFields as $field) {
        if (empty($input[$field])) {
            header("HTTP/1.1 400 Bad Request 2 $field ");
            echo json_encode(['error' => "El campo $field es obligatorio."]);
            exit();
        }
    }

    $sql = "INSERT INTO usuario
            (documento, nombres, apellidos, correo, telefono, password, rol, ubicacion, negocio, detalle, referencias)
            VALUES
            (:documento, :nombres, :apellidos, :correo, :telefono, :password, :rol, :ubicacion, :negocio, :detalle, :referencias)";

    try {
        $statement = $dbConn->prepare($sql);
        bindAllValues($statement, $input);
        $statement->execute();

        $postCodigo = $dbConn->lastInsertId();
        if ($postCodigo) {
            $input['codigo'] = $postCodigo;
            header("HTTP/1.1 200 OK");
            echo json_encode($input);
            exit();
        } else {
            header("HTTP/1.1 500 Internal Server Error 1");
            echo json_encode(['error' => 'Failed to insert data.']);
            exit();
        }
    } catch (Exception $e) {
        header("HTTP/1.1 500 Internal Server Error 2");
        echo json_encode(['error' => $e->getMessage()]);
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    $input = $_GET;
    if (!isset($input['id']) || !isset($input['password'])) {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(['error' => 'Faltan parámetros obligatorios.']);
        exit();
    }

    $id = $input['id'];
    $nuevaContraseña = $input['password'];
    
    $sql = "
        UPDATE usuario
        SET password = :password
        WHERE id = :id
    ";

    try {
        $statement = $dbConn->prepare($sql);
        
        // Enlazar los valores a la consulta preparada
        $statement->bindValue(':password', $nuevaContraseña);
        $statement->bindValue(':id', $id);
        
        // Ejecutar la consulta
        $statement->execute();
        
        // Verificar si se realizó la actualización correctamente
        $rowCount = $statement->rowCount();
        if ($rowCount > 0) {
            header("HTTP/1.1 200 OK");
            echo json_encode(['message' => 'Contraseña actualizada correctamente.']);
            exit();
        } else {
            header("HTTP/1.1 404 Not Found");
            echo json_encode(['error' => 'Usuario no encontrado o ninguna contraseña actualizada.']);
            exit();
        }
    } catch (Exception $e) {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(['error' => $e->getMessage()]);
        exit();
    }
}

 ?>