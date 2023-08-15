<!DOCTYPE html>
<html lang="es">

<head>
    <!--Nombre de pestaña-->
    <title>HotelSweetDreams</title>
    <meta charset="Utf-8">
    <link href="css/apariencia.css" rel="stylesheet">

</head>

<body>


    <!--Encabezado-->
    <header>

        <h1> HOTEL SWEET DREAMS </h1>
        <p> <img src="imagenes/logo2.JPG" width="150" height="100" class="logo"></p>
        <p> "Al Dormir en el Hotel Sweet Dreams tendras una experiencia inolvidable" </p>
        <p> NIT. 900315105-6 </p>

    </header>
    <!--Menu-->

    <section>
        <nav class="menu">

            <div class="toggle-btn">
                <span>&#9776;</span>
            </div>
            <ul>

                <li><a href="Index.html">INICIO</a> </li>
                <li><a href="servicio.html">SERVICIOS</a> </li>
                <li><a href="evento.html">EVENTOS</a> </li>
                <li><a href="#"> SEDES </a>
                    <ul>
                        <li><a href="sede cali.html"> Sede Cali</a> </li>
                        <li><a href="sede cartagena.HTML"> Sede Cartagena</a> </li>
                        <li><a href="sede medellin.html"> Sede Medellin</a> </li>
                        <li><a href="sede san andres.html"> Sede San Andres</a> </li>
                        <li><a href="sede tunja.html"> Sede Tunja</a> </li>
                    </ul>
                <li><a href="cotizacion.php">COTIZAR</a></li>
                </li>
            </ul>
        </nav>
    </section>

    <section class="evento">
        <p> <B>
                <center>
                    <font size="4" style="color: darkgoldenrod;"> BIENVENIDOS A COTIZAR CON EL HOTEL SWEET DREAMS
                    </font>
                </center>
            </B> </p>
        <p> El hotel Sweet Dreams tiene el placer de ofrecer el servicio de cotizaciones, recuerde diligenciar
            correctamente todos los espacios para obtener una cotización adecuada.</p>
            <p>Recuerde que para nosotros es un placer servirles, por tal razón si eres cliente antiguo el hotel 
                te ofrecerá descuentos espectaculares, que esperas, ANIMATE… </p>


        <FONT size="3" style="color: darkgoldenrod;"><B>Diligenciar el siguiente formulario por favor, para realizar la cotización:  </B></FONT>

        <form class="form" action="cotizacion.php" method="POST">

            <p><b>Tipo de servicio:</b></p>
            <label><input type="checkbox" name="habitacionsencilla">Habitacion Sencilla</label>
            <label><input type="checkbox" name="habitaciondoble">Habitación Doble</label>
            <label><input type="checkbox" name="habitaciontriple">Habitación Triple</label>
            <label><input type="checkbox" name="suit">Suit</label>
            <label><input type="checkbox" name="eventos">Eventos</label>
            <br>
            <b>Escriba el numero de noches a cotizar:</b>
            <input type="text" name="fecha">
            <br>
            <b>Tipo cliente:</b>
            <label><input type="checkbox" name="clientenuevo">Nuevo</label>
            <label><input type="checkbox" name="clienteantiguo">Antiguo</label>
            <p>Luego de diligenciar todos los campos por favor dar click en ENVIAR</p>
            <p> <center><input type="submit" class="btn btn-green" value="ENVIAR" name="enviar"> </center>

        </form>
    </section>



    <?php

    // Variables Tabla 1. Espacios por día Vs Costo
    $habitacionsencilla = 50000;
    $habitaciondoble = 75000;
    $habitaciontriple = 100000;
    $suit = 300000;
    $eventos = 3000000;

    // Variables Tabla 2. Descuento por tiempo Vs Porcentaje de descuentos
    $diario = 0;
    $semanal = 0.05;
    $mensual = 0.1;
    $bimestral = 0.15;
    $semestral = 0.20;
    $anual = 0.3;

    // Variables de fecha de estadia
    $fecha = 0;

    // Variables tabla 3. Numero de servicios Vs descuentos.
    $unservicio = 0;
    $dosservicios= 0.06;
    $tresservicios = 0.12;
    $cuatroservicios = 0.18;
    $cincomasservicios = 0.20;

    // Variable tipo de cliente
    $clientenuevo = 0;
    $clienteantiguo = 0.17;

    // IVA
    $iva = 0.19;

    //Variables adicionales
    $total = 0;
    $numeroServicios = 0;
    $valorTotal = "";
    
    // Operaciones

    if (isset($_POST['enviar'])) {

        $fecha = $_POST['fecha'];

        //Cuando las noches a cotizar equivale cero y 365 dias
        if ($fecha == 0) {
            exit("<h3><b> <center>Por favor ingrese el numero de noches que desea hospedaje</b>");
        } else if ($fecha > 366) {
            
            exit("<h3><b> <center>El hotel no ofrece servicios superiores a un año, por favor valide numero de noches que desea hospedarse</b>");
        }
        
        //Determinar numero de servicios e incrementar
        if (isset($_POST['habitacionsencilla'])) {
            $total += $habitacionsencilla;
            $numeroServicios += 1;
        }

        if (isset($_POST['habitaciondoble'])) {
            $total += $habitaciondoble;
            $numeroServicios += 1;
        }

        if (isset($_POST['habitaciontriple'])) {
            $total += $habitaciontriple;
            $numeroServicios += 1;
        }

        if (isset($_POST['suit'])) {
            $total += $suit;
            $numeroServicios += 1;
        }

        if (isset($_POST['eventos'])) {
            $total += $eventos;
            $numeroServicios += 1;
        }

        // Aplicar IVA al total de las noches a hospedarse
        $total = $total + ($total * $iva);
        // Multiplicar el total de las habitaciones por los dias a hospedarse
        $total *=  $fecha;

        // Determinar descuentos por tiempo a hospedarse
        //Determinar descuento diario
        if ($fecha == 1) {
            $total = $total - $diario;
        } //Determinar descuentos semanal
        else if ($fecha >= 2 && $fecha <= 7) {
            $total = ($total - ($total * $semanal));
        } //Determinar descuentos mensual
        else if ($fecha >= 8 && $fecha <= 30) {
            $total = ($total - ($total * $mensual));
        } //Determinar descuentos bimestral dos meses
        else if ($fecha >= 31 && $fecha <= 60) {
            $total = ($total - ($total * $bimestral));
        } //Determinar descuentos semestral
        else if ($fecha >= 61 && $fecha <= 183) {
            $total = ($total - ($total * $semestral));
        } //Determinar descuentos anual
        else if ($fecha >= 183 && $fecha <= 365) {
            $total = ($total - ($total * $anual));
        } 

        // Determinar descuentos por numeros de servicios adquiridos
        
        // Descuentors por dos servicios
        if ($numeroServicios == 2) {
            $total = ($total - ($total * $dosservicios));
        } //Descuento por tres servicios
        else if ($numeroServicios == 3) {
            $total = ($total - ($total * $tresservicios));
        } //Descuento por cuatro servicios
        else if ($numeroServicios == 4) {
            $total = ($total - ($total * $cuatroservicios));
        } //Descuento por cinco servicios
        else if ($numeroServicios >= 5) {
            $total = ($total - ($total * $cincomasservicios));
        }

        //Descuento por tipo de cliente
        if (isset($_POST['clienteantiguo'])) {
            $total = ($total - ($total * $clienteantiguo));
        }
        
        // Impresion del valor total 
        echo $valorTotal =  "<h3><b> <center> El valor total es: $ </b>" . number_format($total, 2);
    }
    ?>

</body>

</html>