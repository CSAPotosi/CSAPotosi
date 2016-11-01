<div class="alert alert-success alert-block">
    <h4 class="alert-heading">Registro Exitoso!!!</h4>
    <center><h1
            style="font-size: 50px"><?php echo $empleado->idAsignacion->empleado->empleadoPersona->getNombreCompleto() ?></h1>
    </center>
    <br>
    <center><h1><?php echo $empleado->fecha . " | " . $empleado->hora_asistencia ?></h1></center>
</div>

