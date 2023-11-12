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
            .error{
                color:red;
            }
        </style>
        
    </head>
    <body>
        <div>
<?php
   //////GLOBAL
   $patronMatricula= "/^\d{4}-[A-Z]{3}$/";
   $header="<h1>Formulario Vehículos</h1><br><h3>Introduzca los datos</h3>";
   $inputMatricula="<input class=\"input\" type=\"text\" name=\"matricula\" placeholder=\"0000-BBB\">";
   $botonEnviar="<br><br><button name=\"botonSI\" value=\"botonSI\" class=\"btn btn-success\">Enviar</button>";
   $inputArchivo= "<input class=\"input\" type=\"text\" name=\"matricula\" placeholder=\"0000-BBB\">";
   $permitido = array('pdf'); // Tipos de archivos permitidos

   //////EMT
   $servicios="servicios.txt";
   $inputempresa="<input class=\"input\" type=\"text\" name=\"empresa\" placeholder=\"Ambulancia\">";
   $inputFichero="<input class=\"input\" type=\"file\" name=\"fichero\" value=\"fichero\">";
 

   echo"<form id=\"emt\" action=\"". htmlspecialchars($_SERVER["PHP_SELF"])."\" method=\"POST\" enctype=\"multipart/form-data\">";
   echo $header;
   echo"<br> <p>Introduce Matricula: </p>";
   echo $inputMatricula;
   echo "<br> <p>Introduce tipo de vehículo: </p>";
   echo $inputempresa;
   echo "<br> <p>Subir fichero: </p>";
   echo $inputFichero;
   echo $botonEnviar;
   echo "</form>";

    if (isset($_POST['botonSI'])){ //Si hemos pulsado el boton

        $matricula = $_POST["matricula"]; 
        if(preg_match($patronMatricula, $matricula)){ //cpmprueba la matricula

            $empresa = $_POST["empresa"];

            $fichero = $_FILES['fichero']['name']; // Obtenemos el nombre del archivo
            $ext = pathinfo($fichero, PATHINFO_EXTENSION); // Obtenemos la extensión del archivo

            if(!empty($empresa) || !empty($fichero)){
                if (!in_array($ext, $permitido)) {
                    if($ficheroEmt = fopen("logistica.txt","a+")){  //abre el fichero y escribe
                            
                        $concatenado =  "\n". $matricula ." ".$empresa;
                        echo "Datos introducidos correctamente: ".$concatenado;
                        fwrite($ficheroEmt,$concatenado);
                        fclose($ficheroEmt);       
                            
                    }else {
                        die("ERROR FATAL algo no va");
                        
                    }
                }else{
                    echo "<p> Introduce solo archivos pdf </p>";
                }  
            }else {
                echo "<p>Faltan datos a introducir</p>";
            }
        }else{
            echo "<p class=\"error\">Error en la matricula / Matrícula no introducida</p>";
    }
}

echo  "<br><br><a href=\"indice.php\">volver</a>";

?>
</div>
    </body>
</html>