<?php
$archivos = array("vehiculosEMT.txt", "taxis.txt", "servicios.txt", "logistica.txt");
$infractores = array();

$vehiculostxt = fopen('vehiculos.txt', 'r');
if ($vehiculostxt) {
    while (!feof($vehiculostxt)) {
        $linea = fgets($vehiculostxt);
        $partes = explode(' ', $linea);
        $matricula = $partes[0];
        $tipo = trim($partes[5]);
        $fechaVehiculo = DateTime::createFromFormat('Y/m/d H:i', trim($partes[3]));

        if ($tipo != 'eléctrico') {
            $encontrado = false;
            foreach ($archivos as $archivo) {
                $ficheropermitidos = fopen($archivo, 'r');
                if ($ficheropermitidos) {
                    while (!feof($ficheropermitidos)) {
                        $vehiculo = fgets($ficheropermitidos);
                        if (strpos($vehiculo, $matricula) !== false) {
                            $encontrado = true;
                            break;
                        }
                    }
                    fclose($ficheropermitidos);
                }
                if ($encontrado) break;
            }

            if (!$encontrado) {
                $abrirfichero = fopen('residentesYHoteles.txt', 'r');
                if ($abrirfichero) {
                    while (!feof($abrirfichero)) {
                        $residente = fgets($abrirfichero);
                        $datosResidente = explode(' ', $residente);
                        if (strpos($residente, $matricula) !== false) {
                            $fechaInicio = DateTime::createFromFormat('Y/m/d', trim($datosResidente[2]));
                            $fechaFin = DateTime::createFromFormat('Y/m/d', trim($datosResidente[3]));
                            if ($fechaVehiculo >= $fechaInicio && $fechaVehiculo <= $fechaFin) {
                                $encontrado = true;
                                break;
                            }
                        }
                    }
                    fclose($abrirfichero);
                }
            }

            if (!$encontrado) {
                $infractores[] = $linea;
            }
        }
    }
    fclose($vehiculostxt);
}

echo "Infractores:\n";
foreach ($infractores as $infractor) {
    echo "<br>".$infractor;
}
echo  "<br><br><a href=\"indice.php\">volver</a>";
?>
