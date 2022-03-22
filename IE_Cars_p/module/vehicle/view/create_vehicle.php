<div id="contenido">
    <form autocomplete="on" method="post" name="alta_vehicle" id="alta_vehicle">
        <h1>Vehiculo nuevo</h1>
        <table border='0'>
            <tr>
                <td>id_vehicle: </td>
                <td><input type="text" id="id_vehicle" name="id_vehicle" placeholder="vehiculo" value="" /></td>
                <td>
                    <font color="red">
                        <span id="error_id_vehicle" class="error">
                            <?php

                            if ($check == false) { //si esta
                                echo 'El id_vehicle introducido ja esta en uso';
                            }
                            /* if (isset($error_id_vehicle)) {
                                echo $error_id_vehicle;
                            } */
                            /*     echo '$error_id_vehicle';  */
                            ?>

                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>Marca: </td>
                <td><input type="marca" id="marca" name="marca" placeholder="marca" value="" /></td>
                <td>
                    <font color="red">
                        <span id="error_marca" class="error">
                            <?php
                            if (isset($error_marca)) {
                                echo $error_marca;
                            }                        ?>
                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>Modelo: </td>
                <td><input type="text" id="modelo" name="modelo" placeholder="modelo" value="" /></td>
                <td>
                    <font color="red">
                        <span id="error_modelo" class="error">
                            <?php
                            if (isset($error_modelo)) {
                                echo $error_modelo;
                            }                        ?>
                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>HP: </td>
                <td><input type="text" id="HP" name="HP" placeholder="HP" value="" /></td>
                <td>
                    <font color="red">
                        <span id="error_HP" class="error">
                            <?php
                            if (isset($error_HP)) {
                                echo $error_HP;
                            }
                            ?>
                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>Km: </td>
                <td><input type="text" id="Km" name="Km" placeholder="Km" value="" /></td>
                <td>
                    <font color="red">
                        <span id="error_Km" class="error">
                            <?php
                            if (isset($error_Km)) {
                                echo $error_Km;
                            }
                            ?>
                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>Anyo de produccion: </td>
                <td><input type="text" id="Anyo_produccion" name="Anyo_produccion" placeholder="Anyo de produccion" value="" /></td>
                <td>
                    <font color="red">
                        <span id="error_Anyo_produccion" class="error">
                            <?php
                            if (isset($error_Anyo_produccion)) {
                                echo $error_Anyo_produccion;
                            }
                            ?>
                        </span>
                    </font>
                    </font>
                </td>
            </tr>




            <tr>
                <td>Color: </td>
                <td><input type="text" id="color" name="color" placeholder="color" value="" /></td>
                <td>
                    <font color="red">
                        <span id="error_color" class="error">
                            <?php
                            if (isset($error_color)) {
                                echo $error_color;
                            }
                            ?>
                        </span>
                    </font>
                    </font>
                </td>

            </tr>
            <tr>
                <td>Precio: </td>
                <td><input type="text" id="precio" name="precio" placeholder="precio" value="" /></td>
                <td>
                    <font color="red">
                        <span id="error_precio" class="error">
                            <?php
                            if (isset($error_precio)) {
                                echo $error_precio;
                            }
                            ?>
                        </span>
                    </font>
                    </font>
                </td>

            </tr>

            <tr>
                <td><input type="button" onclick="validate_c()" name="create" id="create" /></td>
                <td align="right"><a href="index.php?page=controller_vehicle&op=list">Volver</a></td>
            </tr>
        </table>
    </form>
</div>