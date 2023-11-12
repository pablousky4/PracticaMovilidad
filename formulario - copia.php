<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <title>Práctica Carmen | Formulario Vehículos</title>
        <style>
            form, h1, h3, p, .input, div{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            }
            p{
                font-weight:bold;
            }
        </style>
        
    </head>
    <body>
        <div>
        <?php
            echo"
                <div>
                <h1>Formulario Vehículos</h1><br><br>
                <h3>Introduzca los datos</h3>
                <form id=\"formulario\" action=\"". htmlspecialchars($_SERVER["PHP_SELF"])."\" method=\"POST\">
                    <p>Seleccione el tipo de permiso</p>
                    <div>
                        <select name=\"seleccion\">
                            <option value=\"emt\">EMT</option>
                            <option value=\"taxi\">Taxi</option>
                            <option value=\"servicio\">Servicios</option>
                            <option value=\"ryh\">Residentes y Hoteles</option>
                        </select>
                    </div><br>
                    <br>&nbsp;&nbsp;
                    <div>
                        <button class=\"btn btn-success\">Enviar</button>
                    </div>
                </form>
                </div>";


            //////GLOBAL
            $patronMatricula= "/^\d{4}-[^aeiouAEIOU]{3}$/";
            $header="<h1>Formulario Vehículos</h1><br><br><h3>Introduzca los datos</h3><br><br>";
            $inputMatricula="<input class=\"input\" type=\"text\" name=\"matricula\" placeholder=\"0000-BBB\">";
            $botonEnviar="<br><br><button class=\"btn btn-success\">Enviar</button>";


            //////EMT
            $emt="vehiculosEMT.txt";
            
            $inputLinea="<input class=\"input\" type=\"text\" name=\"linea\" placeholder=\"423\">";
            $inputSalida="<input class=\"input\" type=\"text\" name=\"salida\" placeholder=\"Aranjuez\">";
            $inputLlegada="<input class=\"input\" type=\"text\" name=\"llegada\" placeholder=\"Madrid\">";

            ////////////////////////////////////////

            //Si he pulsado el boton de enviar el formulario que me ponga los datos a introducir y sino pues que me muestre el formulario
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($_POST["seleccion"]) {
                    echo"<form id=\"especifico\" action=\"". htmlspecialchars($_SERVER["PHP_SELF"])."\" method=\"POST\">";
                    echo $header;
                    echo"<br> <p>Introduce Matricula: </p>";
                    echo $inputMatricula;
                } 
            }else {
                echo $formulario;
            }


            //Valido la matrícula
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($_POST["seleccion"]) {
                    if (preg_match($patronMatricula, $matricula)) {
                        echo "Matrícula válida: " . $matricula;
                    }// else{
                    //     echo "<p style=\"color:red;\">Matrícula no válida. Por favor, ingrese una matrícula válida.</p>";
                    // }
                }
            }

            /////Creo el formulario de la emt, luego introduzco los datos en el fichero .txt pero no va jajajaja
            ///Hacer validacion solo 1 vez
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($_POST["seleccion"]=="emt") {
                    echo "<div>
                    <select name=\"seleccion\" disabled>
                        <option value=\"emt\">EMT</option>
                        <option value=\"taxi\">Taxi</option>
                        <option value=\"servicio\">Servicios</option>
                        <option value=\"ryh\">Residentes y Hoteles</option>
                    </select>
                </div>";
                    echo"<br> <p>Introduce línea: </p>";
                    echo $inputLinea;
                    echo "<br> <p>Introduce Salida: </p>";
                    echo $inputSalida;
                    echo "<br> <p>Introduce Llegada: </p>";
                    echo $inputLlegada;
                    echo $botonEnviar;
                    echo "</form>";
                    if(!$ficheroEmt = fopen("vehiculosEMT.txt","a+")){
                        die("ERROR FATAL algo no va");
                    }
                    else{
                        $matricula = $_POST["matricula"];
                        $linea = $_POST["linea"];
                        $salida = $_POST["salida"];
                        $llegada = $_POST["llegada"];
                        $concatenado =  "\n". $matricula ." ".$linea.$salida."_".$llegada;
                        echo "Datos introducidos: ".$concatenado;
                        fwrite($ficheroEmt,$concatenado);
                        fclose($ficheroEmt);
                    }
                } 
            }
        ?>
        </div>
    </body>
</html>