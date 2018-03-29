<?php

    require("conexion.php");
    $acentos = mysqli_query($conexion,"SET NAMES 'utf8'");

    $year = date("Y");
    $month = date("m");
    $day = date("d");
    

    $sql = "SELECT `id`, `nacimiento`, edad FROM `clients`";
    $result = mysqli_query($conexion,$sql);

    while($row = mysqli_fetch_array($result)) { 
        $clienteAño = date("Y", strtotime($row[1]));                  
        $clienteEdad = $year - $clienteAño;                        
        $clienteMes = date("m", strtotime($row[1]));          
        $mes = $month - $clienteMes;
            
        if($mes < 0)
            $clienteEdad--;                       
                            
        else if($mes == 0) { 
            $diaCliente = date("d", strtotime($row[1]));                  
            $diaCliente = $day - $diaCliente;
            if($diaCliente <= 0)
            {                
                        $clienteEdad--;
            }
        }

        

        if($row[2] == $clienteEdad) { 
            
        }

        else { 
            echo "Cliente: $row[0] tiene: $row[2] y deberia tener: $clienteEdad    ELSE<br>";
            $sql = "UPDATE clients SET edad = '".$clienteEdad."' WHERE id = ".$row[0]."";
            $result2 = mysqli_query($conexion,$sql);
        }

    }