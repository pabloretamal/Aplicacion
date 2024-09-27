<?php
include 'conexion.php';

// Crear nuevo producto
if (isset($_POST['save'])) {
    $codigo_barra = $_POST['codigo_barra'];
    $codigo_qr = $_POST['codigo_qr'];
    $nombre = $_POST['nombre'];
    $lote = $_POST['lote'];
    $tipo = $_POST['tipo'];
    $ciudad = $_POST['ciudad'];
    $numero_estante = $_POST['numero_estante'];
    $cantidad_inventario = $_POST['cantidad_inventario'];
    $cantidad_inventariada_cajas = $_POST['cantidad_inventariada_cajas'];
    $cantidad_piezas_cajas = $_POST['cantidad_piezas_cajas'];
    $total_piezas = $_POST['total_piezas'];

    // Manejar la imagen si se subió
    $imagen = $_FILES['imagen']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($imagen);

    if ($imagen) {
        move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file);
    }

    $sql = "INSERT INTO productos (codigo_barra, codigo_qr, nombre, lote, tipo, ciudad, numero_estante, cantidad_inventario, cantidad_inventariada_cajas, cantidad_piezas_cajas, total_piezas, imagen) 
            VALUES ('$codigo_barra', '$codigo_qr', '$nombre', '$lote', '$tipo', '$ciudad', '$numero_estante', '$cantidad_inventario', '$cantidad_inventariada_cajas', '$cantidad_piezas_cajas', '$total_piezas', '$imagen')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo producto agregado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    header('Location: formulario.php');
}

// Editar producto existente
if (isset($_POST['edit'])) {
    $id = $_POST['id'];

    $sql = "SELECT * FROM productos WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    echo "<script>
            document.getElementById('productId').value = '{$row['id']}';
            document.getElementById('codigo_barra').value = '{$row['codigo_barra']}';
            document.getElementById('codigo_qr').value = '{$row['codigo_qr']}';
            document.getElementById('nombre').value = '{$row['nombre']}';
            document.getElementById('lote').value = '{$row['lote']}';
            document.getElementById('tipo').value = '{$row['tipo']}';
            document.getElementById('ciudad').value = '{$row['ciudad']}';
            document.getElementById('numero_estante').value = '{$row['numero_estante']}';
            document.getElementById('cantidad_inventario').value = '{$row['cantidad_inventario']}';
            document.getElementById('cantidad_inventariada_cajas').value = '{$row['cantidad_inventariada_cajas']}';
            document.getElementById('cantidad_piezas_cajas').value = '{$row['cantidad_piezas_cajas']}';
            document.getElementById('total_piezas').value = '{$row['total_piezas']}';
        </script>";
}

// Guardar cambios en el producto actualizado
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $codigo_barra = $_POST['codigo_barra'];
    $codigo_qr = $_POST['codigo_qr'];
    $nombre = $_POST['nombre'];
    $lote = $_POST['lote'];
    $tipo = $_POST['tipo'];
    $ciudad = $_POST['ciudad'];
    $numero_estante = $_POST['numero_estante'];
    $cantidad_inventario = $_POST['cantidad_inventario'];
    $cantidad_inventariada_cajas = $_POST['cantidad_inventariada_cajas'];
    $cantidad_piezas_cajas = $_POST['cantidad_piezas_cajas'];
    $total_piezas = $_POST['total_piezas'];

    // Manejar la imagen si se subió
    $imagen = $_FILES['imagen']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($imagen);

    if ($imagen) {
        move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file);
        $sql = "UPDATE productos SET codigo_barra='$codigo_barra', codigo_qr='$codigo_qr', nombre='$nombre', lote='$lote', tipo='$tipo', ciudad='$ciudad', numero_estante='$numero_estante', cantidad_inventario='$cantidad_inventario', cantidad_inventariada_cajas='$cantidad_inventariada_cajas', cantidad_piezas_cajas='$cantidad_piezas_cajas', total_piezas='$total_piezas', imagen='$imagen' WHERE id=$id";
    } else {
        $sql = "UPDATE productos SET codigo_barra='$codigo_barra', codigo_qr='$codigo_qr', nombre='$nombre', lote='$lote', tipo='$tipo', ciudad='$ciudad', numero_estante='$numero_estante', cantidad_inventario='$cantidad_inventario', cantidad_inventariada_cajas='$cantidad_inventariada_cajas', cantidad_piezas_cajas='$cantidad_piezas_cajas', total_piezas='$total_piezas' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Producto actualizado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    header('Location: formulario.php');
}

// Eliminar producto
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM productos WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Producto eliminado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    header('Location: formulario.php');
}

$conn->close();
?>
