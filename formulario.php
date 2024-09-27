<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario de Productos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="mt-4">Formulario de Inventario</h2>
    <form action="procesar.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" id="productId">
        <div class="form-group">
            <label for="codigo_barra">Código de Barra:</label>
            <input type="text" class="form-control" id="codigo_barra" name="codigo_barra" required>
        </div>
        <div class="form-group">
            <label for="codigo_qr">Código QR:</label>
            <input type="text" class="form-control" id="codigo_qr" name="codigo_qr">
        </div>
        <div class="form-group">
            <label for="nombre">Nombre del Producto:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="lote">Identificador de Lote:</label>
            <input type="text" class="form-control" id="lote" name="lote" required>
        </div>
        <div class="form-group">
            <label for="tipo">Tipo de Producto:</label>
            <select class="form-control" id="tipo" name="tipo" required>
                <option value="oficina">Oficina</option>
                <option value="escolar">Escolar</option>
                <option value="mueblería">Mueblería</option>
            </select>
        </div>
        <div class="form-group">
            <label for="ciudad">Ciudad:</label>
            <select class="form-control" id="ciudad" name="ciudad" required>
                <option value="Santiago">Santiago</option>
                <option value="Valparaíso">Valparaíso</option>
            </select>
        </div>
        <div class="form-group">
            <label for="numero_estante">Número de Estante:</label>
            <input type="text" class="form-control" id="numero_estante" name="numero_estante" required>
        </div>
        <div class="form-group">
            <label for="cantidad_inventario">Cantidad de Inventario de Piezas:</label>
            <input type="number" class="form-control" id="cantidad_inventario" name="cantidad_inventario" required>
        </div>
        <div class="form-group">
            <label for="cantidad_inventariada_cajas">Cantidad Inventariada de Cajas/Empaques:</label>
            <input type="number" class="form-control" id="cantidad_inventariada_cajas" name="cantidad_inventariada_cajas" required>
        </div>
        <div class="form-group">
            <label for="cantidad_piezas_cajas">Cantidad de Piezas en Cajas/Empaques:</label>
            <input type="number" class="form-control" id="cantidad_piezas_cajas" name="cantidad_piezas_cajas" required>
        </div>
        <div class="form-group">
            <label for="total_piezas">Total de Piezas Inventariadas:</label>
            <input type="number" class="form-control" id="total_piezas" name="total_piezas" required>
        </div>
        <div class="form-group">
            <label for="imagen">Imagen del Producto:</label>
            <input type="file" class="form-control-file" id="imagen" name="imagen">
        </div>
        <button type="submit" name="save" class="btn btn-primary">Guardar Producto</button>
        <button type="submit" name="update" class="btn btn-success">Actualizar Producto</button>
    </form>

    <h2 class="mt-5">Productos Registrados</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Código de Barra</th>
                <th>Código QR</th>
                <th>Nombre</th>
                <th>Lote</th>
                <th>Tipo</th>
                <th>Ciudad</th>
                <th>Estante</th>
                <th>Inventario (Piezas)</th>
                <th>Cajas</th>
                <th>Piezas/Caja</th>
                <th>Total Piezas</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'conexion.php';
            $sql = "SELECT * FROM productos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['codigo_barra']}</td>
                        <td>{$row['codigo_qr']}</td>
                        <td>{$row['nombre']}</td>
                        <td>{$row['lote']}</td>
                        <td>{$row['tipo']}</td>
                        <td>{$row['ciudad']}</td>
                        <td>{$row['numero_estante']}</td>
                        <td>{$row['cantidad_inventario']}</td>
                        <td>{$row['cantidad_inventariada_cajas']}</td>
                        <td>{$row['cantidad_piezas_cajas']}</td>
                        <td>{$row['total_piezas']}</td>
                        <td><img src='uploads/{$row['imagen']}' width='50' height='50'></td>
                        <td>
                            <form action='procesar.php' method='POST'>
                                <input type='hidden' name='id' value='{$row['id']}'>
                                <button type='submit' name='edit' class='btn btn-info'>Editar</button>
                                <button type='submit' name='delete' class='btn btn-danger'>Eliminar</button>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='14'>No se encontraron productos</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
