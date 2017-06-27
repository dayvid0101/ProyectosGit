<?
function Conectarse(){
	$host = "localhost";
	$dbname = "proyectofrank";
	$user = "root";
	$password = "dayvid32843";

		$enlace = mysqli_connect($host, $user, $password);

		if (!$enlace) {
   				echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    			echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    			return 100;
		}
		else{
			$enlace = mysqli_connect($host, $user, $password,$dbname);
			if (!$enlace) {
   				echo "Error: No se pudo conectar a $dbname." . PHP_EOL;
    			echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    			return 200;
			}
		}
		return $enlace;
	}

function Query($SQL){
	$enlace=Conectarse();
	if($enlace==100) return "No se pudo conectar al servidor datos incorrectos.";
	if($enlace==200) return "No se puede conectar a la base de datos, base incorrecta.";
	if (!$resultado = @mysqli_query($enlace,$SQL)){
		
		return $SQL;
	}else{
		
		return $resultado;
	}
}
?>