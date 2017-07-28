<?php
define('HOST','mysql.hostinger.es');
define('USER','u633757780_umg');
define('DB','u633757780_umg');
define('PASS','>n3V^o^6@5fM');


function conexionMysql()
{
    $conexion = new mysqli(HOST,USER,PASS,DB);
    if($conexion->connect_error)
    {
        $error = "
        <script>notif({
				type: \"error\",
				msg: \"No se pudo conectar\",
				position: \"center\",
				fade: false,
				autohide: true
				});
                </script>";

        printf($error,$conexion->connect_errno,$conexion->connect_error);

        die($error);
    }
    else
    {


    }

    return $conexion;

}



function limpiar_sql($dato){
    $dato = str_replace("'",'',$dato);
    $dato = str_replace('"','',$dato);
    $dato = str_replace("&",'',$dato);
    $dato = str_replace("<",'',$dato);
    $dato = str_replace(">",'',$dato);
    $dato = str_replace("script",'',$dato);
    $dato = str_replace("SCRIPT",'',$dato);
    $dato = str_replace(";truncate database;--",'',$dato);
    $dato = str_replace(";",'',$dato);
    $dato = str_replace(":",'',$dato);
    $dato = str_replace("truncate",'',$dato);
    $dato = str_replace("delete",'',$dato);
    $dato = str_replace("insert",'',$dato);
    $dato = str_replace("update",'',$dato);
    $dato = str_replace("set",'',$dato);
}
?>