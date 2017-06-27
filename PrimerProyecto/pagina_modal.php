<?
if($_POST["funcion"]=="Eliminar"){
include("conexion.php");
	$result = Query("DELETE FROM usuarios WHERE id=".$_POST["idregistro"]);
	$row=mysql_fetch_array($result);
	echo "DELETE FROM usuarios WHERE id=".$_POST["idregistro"];
exit();
}
if($_POST["funcion"]=="Edita"){
include("conexion.php");
	$result = Query("UPDATE usuarios SET usuario='".$_POST["nombre"]."', password='".$_POST["pass"]."' WHERE id=".$_POST["idregistro"]);
	$row=mysql_fetch_array($result);
exit();
}
if($_POST["funcion"]=="Cargar_Modal"){
include("conexion.php");
?>
    <table cellpadding="0" cellspacing="0" border="1" width="100%">
        <tr>
            <td align="center">Usuario</td>
            <td align="center">Pass</td>
            <td align="center">Editar</td>
        </tr>
        <?
        $result = Query("SELECT * FROM usuarios WHERE Id=".$_POST["idregistro"]);
        while($row=mysqli_fetch_array($result))
		{
        ?>
        <tr class="registros" >
            <td align="center"><input type="text" id="nombre_modal" value="<?=$row[1]?>"></td>
            <td align="center"><input type="text" id="pass_modal" value="<?=$row[2]?>"></td>
            <td align="center"><img src="edit.png" id="editar_modal" style="cursor:pointer" idregistro="<?=$row[0]?>"></td>
        </tr>
        <?
        }
        ?>
    </table>
<?
exit();
}
if($_POST["funcion"]=="Cargar_Registros"){
	include("conexion.php");
	?>
		<table cellpadding="0" cellspacing="0" border="1" width="100%">
			<tr>
				<td align="center">Usuario</td>
				<td align="center">Pass</td>
				<td align="center">Editar</td>
				<td align="center">Eliminar</td>
			</tr>
			<?
			$result = Query("SELECT * FROM usuarios ");
			while($row=mysqli_fetch_array($result)){
			?>
			<tr class="registros" >
				<td align="center"><?=$row[1]?></td>
				<td align="center"><?=$row[2]?></td>
				<td align="center"><img src="edit.png" class="editar" style="cursor:pointer" idregistro="<?=$row[0]?>"></td>
				<td align="center"><img src="del.png" class="eliminar" style="cursor:pointer " idregistro="<?=$row[0]?>"></td>
			</tr>
			<?
			}
			?>
		</table>
	<?
	exit();
}

include("conexion.php");
?>

<style>
body{ margin:0px; padding:0px;}
#general{ width:99%; height:99%; }

#modal{ display:none;position: absolute;     top: 0;     left: 0;     width: 100%;     height: 100%;     background: #000;     z-index:1001;     opacity:.75;     -moz-opacity: 0.75;     filter: alpha(opacity=75);}
#modales { display: none;     position: absolute;     top: 15%;     left: 15%;     width: 70%;     height: 60%;     padding: 16px;     background: #fff;     color: #333;     z-index:1002;     overflow: auto;}
#cerrar{ position:relative; float:right; cursor:pointer; }
</style>
<div id="general">
    <div id="carga_registros">
    </div>
</div>
<div id="modal">
   <div id="modales">
     <img src="Close32.png" id="cerrar" />
     <div>
     <div id="contenido_modal">
     
     </div>
</div>  
<script src="jquery/jquery.min.js" charset="UTF-8"></script>
<script>
$(document).ready(function(e) 
	{
		Cargar_Registros();
		$(document).on("click",".eliminar",function(){
			var idregistro = $(this).attr("idregistro");
			var r = confirm("Esta Seguro de Eliminar el Usuario?");
			if (r == true) {
				$.ajax({
					type: "POST",
					url: "<?=$_SERVER['PHP_SELF']?>",
					data: ({
						funcion : "Eliminar",
						idregistro : idregistro
					}),
					dataType: "html",
					async:false,
					success: function(msg){
						alert("Datos Actualizados correctamente");
						Cargar_Registros();
					}
				});
			} 			
		});
		function Cargar_Registros(){
			$.ajax({
				type: "POST",
				url: "<?=$_SERVER['PHP_SELF']?>",
				data: ({
					funcion : "Cargar_Registros"
				}),
				dataType: "html",
				async:false,
				success: function(msg){
					$("#carga_registros").html(msg);
				}
			});
		}
		$(document).on("click","#editar_modal",function(){
			var idregistro = $(this).attr("idregistro");
			$.ajax({
				type: "POST",
				url: "<?=$_SERVER['PHP_SELF']?>",
				data: ({
					funcion : "Edita",
					nombre : $("#nombre_modal").val(),
					idregistro : idregistro,
					pass : $("#pass_modal").val()
				}),
				dataType: "html",
				async:false,
				success: function(msg){
					alert("Datos Actualizados correctamente");
					$("#modal").css({"display": "none"});
					$("#modal").hide(200);
					$("#modales").css({"display": "none"});
					$("#modales").hide(200);
					Cargar_Registros();
				}
			});
		});
		$(document).on("click",".editar",function(){
			var idregistro = $(this).attr("idregistro");
			//CARGAR MODAL PARA EDITAR REGISTRO
			$.ajax({
				type: "POST",
				url: "<?=$_SERVER['PHP_SELF']?>",
				data: ({
					funcion : "Cargar_Modal",
					idregistro : idregistro
				}),
				dataType: "html",
				async:false,
				success: function(msg){
					$("#contenido_modal").html(msg);
				}
			});
			$("#modal").css({"display": "block"});
			$("#modal").show(200);
			$("#modales").css({"display": "block"});
			$("#modales").show(200);
		});
		$(document).on("click","#cerrar",function(event){
			$("#modal").css({"display": "none"});
			$("#modal").hide(200);
			$("#modales").css({"display": "none"});
			$("#modales").hide(200);
			return false;
		});
	}
);

</script>