<?php 
    require_once 'chofer\choferespdo.php';
    $pdo = new choferPDO();
    $c = $pdo->getById($_GET['id_chofer']);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css\bootstrap.css">
        <link rel="stylesheet" href="css\estilos.css">
        <script src="js/validaciones.js"></script>
    </head> 

    <body>
        <div>
            <?php include 'includes\navbar.php'?>
        </div>
        
        <div > <!-- formulario de carga --> 
                        
            <div class="card" width="100%">
            <h5 class="card-header info-color white-text text-center py-4">
                <strong>modificar chofer</strong>
            </h5>
            <!--Card content-->
            <div class="table-responsive">
                <!-- Form -->
                <table class="table table">
                <form class="text-center" style="color: #757575;" action="chofer/modificarchofer.php" method="post">
                    <tr>
                        <td>
                             <!-- nombre -->
                            <div class="md-form mt-3">
                                <input type="text" id="Nombre-Chofer" name="Nombre-Chofer" readonly value="<?php echo $c->nombre;?>" class="form-control">
                                <label for="Nombre-Chofer">Nombre</label>
                            </div>
                        </td>
                        <td>
                            <!-- apellido -->
                            <div class="md-form mt-3">
                                <input type="text" id="Apellido-Chofer" name="Apellido-Chofer" readonly value="<?php echo $c->apellido;?>" class="form-control">
                                <label for="Apellido-Chofer">Apellido</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- telefono -->
                            <div class="md-form mt-3">
                                <input type="number" id="Telefono-Chofer" name="Telefono-Chofer" value="<?php echo $c->telefono;?>" class="form-control">
                                <label for="Telefono-Chofer">Telefono</label>
                            </div>
                        </td>
                        <td>
                            <!-- cuil -->
                            <div class="md-form mt-3">
                                <input type="number" id="Cuil-Chofer" name="Cuil-Chofer" readonly value="<?php echo $c->cuil;?>"  class="form-control">
                                <label for="Cuil-Chofer">Cuil</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- Vto Psicofisico -->
                            <div class="md-form mt-3">
                                <input type="date" id="Psicofisico" name="Vto-Psico-Chofer" class="form-control" onblur="validarFechas(this)">
                                <label for="Vto-Psico-Chofer">Vencimiento Psicofisico</label>
                            </div>
                        </td>
                        <td>
                            <!-- Vto Cargas Peligrosas -->
                            <div class="md-form mt-3">
                                <input type="date" id="Cargas-Peligrosas" name="Vto-Cargas-Peligrosas-Chofer"  class="form-control" onblur="validarFechas(this)">
                                <label for="Vto-Cargas-Peligrosas-Chofer">Vencimiento Cargas Peligrosas</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <!-- Vto CEDA -->
                            <div class="md-form mt-3">
                                <input type="date" id="CEDA" name="Vto-Ceda-Chofer" class="form-control" onblur="validarFechas(this)">
                                <label for="Vto-Ceda-Chofer">Vencimiento CEDA</label>
                            </div>
                        </td>
                        <td>
                            <!-- Vto ART -->
                            <div class="md-form mt-3">
                                <input type="date" id="ART" name="Vto-Art-Chofer" class="form-control" onblur="validarFechas(this)">
                                <label for="Vto-Art-Chofer">Vencimiento ART</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <!-- Boton para crear -->
                            <button class="btn btn-outline-info btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">Modificar</button>
                        </td>
                    </tr>
                </form>
                </table>
                <!-- Form -->
            </div>
            </div>
        </div>

        <div>
            <?php include 'includes\footer.php'?>
        </div>
    </body>
</html>