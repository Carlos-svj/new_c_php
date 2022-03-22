<div id="contenido">
    <form autocomplete="on" method="post" name="update_vehicle" id="update_vehicle">
        <h1>Modificar vehiculo</h1>
        <table border='0'>
            <tr>
                <td>id_vehicle: </td>
                <td><input type="text" id="id_vehicle" name="id_vehicle" placeholder="id_vehicle" value="<?php echo $vehicle['id_vehicle']; ?>" readonly /></td>
                <td>
                    <font color="red">
                        <span id="error_id_vehicle" class="error">
                            <?php
                            if (isset($error_id_vehicle)) {
                                echo $error_id_vehicle;
                            }                            
                            ?>
                        </span>
                </td>
            </tr>

            <tr>
                <td>marca: </td>
                <td><input type="t  ext" id="marca" name="marca" placeholder="marca" value="<?php echo $vehicle['marca']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_marca" class="error">
                            <?php
                            if (isset($error_marca)) {
                                echo ($error_marca);
                            }
                            ?>
                        </span>
                </td>
            </tr>

            <tr>
                <td>modelo: </td>
                <td><input type="text" id="modelo" name="modelo" placeholder="modelo" value="<?php echo $vehicle['modelo']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_modelo" class="error">
                            <?php
                            // echo "$error_modelo";
                            ?>
                        </span>
                </td>
            </tr>

            <tr>
                <td>HP: </td>
                <td><input type="text" id="HP" name="HP" placeholder="HP" value="<?php echo $vehicle['HP']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_HP" class="error">
                            <?php
                            // echo "$error_HP";
                            ?>
                        </span>
                </td>
            </tr>


            <tr>
                <td>Km: </td>
                <td><input type="text" id="Km" name="Km" placeholder="Km" value="<?php echo $vehicle['Km']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_Km" class="error">
                            <?php
                            // echo "$error_Km";
                            ?>
                        </span>
                </td>
            </tr>

            <tr>
                <td>Anyo_produccion: </td>
                <td><input type="text" id="Anyo_produccion" name="Anyo_produccion" placeholder="Anyo_produccion" value="<?php echo $vehicle['Anyo_produccion']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_Anyo_produccion" class="error">
                            <?php
                            // echo "$error_Anyo_produccion";
                            ?>
                        </span>
                </td>

            </tr>



            <tr>
                <td>color: </td>
                <td><input type="text" id="color" name="color" placeholder="color" value="<?php echo $vehicle['color']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_color" class="error">
                            <?php
                            // echo "$error_color";
                            ?>
                        </span>
                </td>
            </tr>

            <tr>
                <td>precio: </td>
                <td><input type="text" id="precio" name="precio" placeholder="precio" value="<?php echo $vehicle['precio']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_precio" class="error">
                            <?php
                            // echo "$error_precio";
                            ?>
                        </span>
                </td>
            </tr>

            <tr>
                <td><input type="button" onclick="validate()" name="update" id="update" /></td>
                <td align="right"><a href="index.php?page=controller_vehicle&op=list">Volver</a></td>
            </tr>
        </table>
    </form>
</div>