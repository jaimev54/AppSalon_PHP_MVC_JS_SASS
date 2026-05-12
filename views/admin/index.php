<h1 class="nombre-pagina">Pandel de administración</h1>

<?php 
    include_once __DIR__ . '/../templates/barra.php';
?>
<h2>buscar citas</h2>
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input
                id="fecha"
                type="date"
                name="fecha"
                value="<?php echo $fecha; ?>"
            />
        </div>

    </form>
</div>

<?php 
    if(count($citas) === 0) {
        echo "<h2>No hay citas en esta fecha</h2>";
    }
?>

<div id="citas-admin">
    <ul class="citas">
        <?php
        $idCita = '';  // ✅ string vacío, no 0
        
        foreach($citas as $key => $cita) {
            if($idCita !== $cita->id) {
                $total = 0;
        ?>
            <li class="cita">
                <p> ID: <span><?php echo $cita->id; ?></span></p>
                <p> Hora: <span><?php echo $cita->hora; ?></span></p>
                <p> Cliente: <span><?php echo $cita->cliente; ?></span></p>
                <p> Email: <span><?php echo $cita->email; ?></span></p>
                <p> Teléfono: <span><?php echo $cita->telefono; ?></span></p>
                <h3>Servicios</h3>
            <?php
                $idCita = $cita->id;
            } // fin del if
            $total += $cita->precio ?? 0; // ✅ evitar NULL
            ?>
                <p class="servicio"> Servicio: <span><?php echo ($cita->servicio ?? 'Sin servicio') . ' - $' . ($cita->precio ?? 0); ?></span></p>
            
            <?php
            $actual = (string)$cita->id;               // ✅ forzar string
            $proximo = (string)($citas[$key + 1]->id ?? ''); // ✅ forzar string
            if(esUltimo($actual, $proximo)) {
            ?>
                <p class="total"> Total: <span>$<?php echo $total; ?></span></p>
                <form action="/api/eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                    <input type="submit" class="boton-eliminar" value="Eliminar">
                </form>
            <?php
            }
            ?>
        <?php
        } // fin del foreach
        ?>
    </ul>
</div>

<?php
    $script = "<script src='build/js/buscador.js'></script>";
?>