<!DOCTYPE html>
<html>
<head>
    <title>Tabla de Datos</title>
</head>
<body>
    <div align="center">
        <h2>Tabla de Datos</h2>
        <form method="post">
            <label for="orden">Selecciona el orden:</label>
            <select name="orden" id="orden">
                <option value="1">Descendente por Matricula</option>
                <option value="2">Ascendente por Matricula</option>
                <!-- Agrega más opciones según tus necesidades -->
            </select>
            <input type="submit" value="Ordenar">
        </form>
        <br>
        <table width="600" border="1" bgcolor="#CCFFCC" align="center">
            <tr bgcolor="#E8E8E8">
                <th align="center">No.</th>
                <th align="center">Matricula</th>
                <th align="center">Fecha_I</th>
                <th align="center">Hora</th>
                <th align="center">Actualidad</th>
                <th align="center">Responsable</th>
                <th align="center">Materiales</th>
                <th align="center">Producto</th>
                <th align="center">Evidencia</th>
            </tr>
            <?php
            $conexion = new mysqli("localhost", "root", "", "agenda");
            if ($conexion->connect_error) {
                die("Conexión fallida: " . $conexion->connect_error);
            }
            
            $orden = isset($_POST['orden']) ? $_POST['orden'] : 1;

            if ($orden == 1) {
                $sql = "SELECT Matricula, Fecha_I, Hora, Actualidad, Responsable, Materiales, Producto, Evidencia FROM 04_joseantonio ORDER BY Matricula DESC";
            } else {
                $sql = "SELECT Matricula, Fecha_I, Hora, Actualidad, Responsable, Materiales, Producto, Evidencia FROM 04_joseantonio ORDER BY Matricula ASC";
            }

            $resultado = $conexion->query($sql);
            $cont = 1;

            if ($resultado->num_rows > 0) {
                while($reg = $resultado->fetch_assoc()) {
                    echo "
                    <tr>
                        <td align='center'>$cont</td>
                        <td bgcolor='#FFFFCC' align='center'>{$reg['Matricula']}</td>
                        <td align='center'>{$reg['Fecha_I']}</td>
                        <td align='center'>{$reg['Hora']}</td>
                        <td align='center'>{$reg['Actualidad']}</td>
                        <td align='center'>{$reg['Responsable']}</td>
                        <td align='center'>{$reg['Materiales']}</td>
                        <td align='center'>{$reg['Producto']}</td>
                        <td align='center'>{$reg['Evidencia']}</td>
                    </tr>";
                    $cont++;
                }
            } else {
                echo "<tr><td colspan='5' align='center'>No hay resultados</td></tr>";
            }

            $conexion->close();
            ?>
        </table>
    </div>
</body>
</html>