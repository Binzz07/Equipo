<?php
	require_once 'conexion.php';
	if(ISSET($_POST['res'])){
		$query = "SELECT * FROM usuario";
		$result = mysqli_query($conn, $query);
		$json = array();
		if($result) {
			while($row = mysqli_fetch_assoc($result)) {
            $json[] = array(
                'cedula' => $row['cedula'],
                'nombre' => $row['nombre'],
                'contrasena' => $row['contrasena'],

            );
        	}
        	echo json_encode($json);
			
		} else {
        	echo "No devuelve nada";
        }
		
	}
 
?> 
