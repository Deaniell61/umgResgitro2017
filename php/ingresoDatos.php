<?php
require_once('conf.php');


    switch($_POST['tipo']){
        case '1':{
                    $dato[0] = $emai = $_POST['emai'];
                    $retur=array();
                    $mySQL=conexionMysql();

                        $sql="select * from estudiante where correo='".$dato[0]."'";
                        $ejecuta=$mySQL->query($sql);
                    if($ejecuta){
                        if($ejecuta->num_rows>0){
                            $retur['estatus'] = "0";
                        }
                        else{
                            $retur['estatus'] = "1";
                        }
                    }
                    $mySQL->close();
                    echo json_encode($retur);
                    break;

        }
        case '2':{
                    $dato[0] = $nombre = $_POST['nombre'];
                    $dato[1] = $apellido = $_POST['apellido'];
                    /*$dato[2] = $telefono = $_POST['telefono'];
                    $dato[3] = $correo = $_POST['correo'];
                    $dato[4] = $carrera = $_POST['carrera'];
                    $dato[5] = $colegio = $_POST['colegio'];*/
                    $dato[6] = $facebook = '';
                    $dato[7] = $Estudiante = $_POST['Estudiante'];
                    $dato[8] = $talla = $_POST['talla'];
                    $dato[9] = $clave = $_POST['face'];
                    $retur="";
                    $mySQL=conexionMysql();
                        //telefono,correo,carrera,colegio,
                        //,'".$dato[2]."','".$dato[3]."','".$dato[4]."','".$dato[5]."'
                        $sql="insert into estudiante(nombre,apellido,facebook,estudiante,talla,clave) values('".$dato[0]."','".$dato[1]."','".$dato[6]."','".$dato[7]."','".$dato[8]."','".$dato[9]."')";
                        $ejecuta=$mySQL->query($sql);
                    if($ejecuta){
                        $sql1="update codigos set estado=0 where clave='".$dato[9]."' and estado=1";
                        $mySQL->query($sql1);
                        $retur['estatus'] = "1";
                    }
                    else{
                        $retur['estatus'] = "0";
                    }
                    //$retur['estatus'] = $sql;
                    $mySQL->close();
                    echo json_encode($retur);
                    break;
        }
        case '3':{
                    $dato[0] = $clave = $_POST['clave'];
                    $retur=array();
                    $mySQL=conexionMysql();
                        $sql="select * from codigos where clave='".$dato[0]."' and estado=1";
                        $ejecuta=$mySQL->query($sql);
                    if($ejecuta){
                        if($ejecuta->num_rows>0){
                            
                                $retur['estatus'] = "1";
                            
                        }
                        else{
                            $retur['estatus'] = "0";
                        }
                    }
                    $mySQL->close();
                    echo json_encode($retur);
                    break;

        }
        case '4':{
                    $retur="";
                    $mySQL=conexionMysql();
                        $sql="select nombre,apellido,talla,estudiante from estudiante where clave!='' order by nombre";
                        $ejecuta=$mySQL->query($sql);
                    if($ejecuta){
                        if($ejecuta->num_rows>0){
                            $retur.="<table class=\"striped highlight responsive-table\" >";
                            $retur.= "<tr><th> Nombre </th> <th> Carrera </th> <th> Talla </th> </tr>";
                            while($fila = $ejecuta->fetch_row()){
                                if($fila[3]=='0'){
                                    $fila[3]='Sin Carrera';
                                }
                                $retur.= "<tr> <td> ".$fila[0]." ".$fila[1]." </td> <td> ".$fila[3]." </td> <td> ".$fila[2]." </td> </tr>";
                            }
                            $retur.="</table>";
                        }
                        else{
                            $retur = "0";
                        }
                    }
                    $mySQL->close();
                    echo ($retur);
                    break;

        }
    }

?>