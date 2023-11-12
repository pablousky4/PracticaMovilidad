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
                            <option value=\"logistica\">Logística</option>
                        </select>
                    </div><br>
                    <br>&nbsp;&nbsp;
                    <div>
                        <button class=\"btn btn-success\">Enviar</button>
                    </div>
                </form>
                </div>";

                 if ($_SERVER["REQUEST_METHOD"] == "POST") {
                     $seleccion = $_POST["seleccion"];
                    
                     switch ($seleccion) {
                         case "emt":
                             header("Location: emt.php");
                             break;
                         case "taxi":
                             header("Location: taxi.php");
                             break;
                         case "servicio":
                             header("Location: servicios.php");
                             break;
                         case "ryh":
                             header("Location: ryh.php");
                             break;    
                         case "logistica":
                             header("Location: logistica.php");
                             break;  
                         default:
                             // Redirigir a una página predeterminada en caso de opción inválida
                             header("Location: emt.php");
                             break;
                     }
                 }


            echo  "<br><br><a href=\"indice.php\">volver</a>";
        ?>
        
        </div>
    </body>
</html>