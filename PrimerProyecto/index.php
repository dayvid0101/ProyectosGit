<?php
if($_POST["funcion"]=="Valida_Usuario"){
include("conexion.php");
	$sql = "SELECT * FROM usuarios WHERE Usuario LIKE '".$_POST["Usuario"]."' AND Password LIKE '".$_POST["Password"]."'";
    //echo "$sql \n";
	$result =Query($sql);
	$row=mysqli_fetch_array($result);
	if($row[0]!=""){
		echo 'Correcto';
	}else{
		echo 'Incorrecto';	
	}
exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
body{ 
 margin:0px;
 padding:0px;}
#general{ 
    position:relative; 
    float:left; 
    width:99%; 
    height:99%;
    text-align:center;}
#general #entrada{ 
	position:relative; 
	float:left; width:300px; 
	height:200px; 
	border:solid 1px;
	text-align:center; 
    margin-left:40%;
    margin-top:10%;
    color:#FFF; 
    background-color:#900;}
.entrada{ width:200px; height:30px; background-color:#C33; color:#FFF; }
</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<div id="general">
	<div id="entrada">
    	<b>Usuario:</b><br />
    	<input type="text" id="Usuario" class="entrada" /><br />
    	<b>Constrase&ntilde;a:</b><br />
    	<input type="password" id="Password" class="entrada" /><br /><br /><br />
        <input type="button" id="ingresar" value="Ingresar" class="entrada"  />
        </div>
    </div>
</div>
</body>
<script src="jquery/jquery.min.js" charset="UTF-8"></script>
<script>
$(document).ready(function(e) {
    $(document).on("click","#ingresar",function(){
		if($("#Usuario").val()==""){
			alert("Ingrese un Usuario Valido");	
			$("#Usuario").val("");
			$("#Password").val("");
		}else{
			$.ajax({
				type: "POST",
				url: "index.php",
				data: ({
					funcion : "Valida_Usuario",
					Usuario : $ ("#Usuario").val(),
					Password : $ ("#Password").val()
				}),
				dataType: "html",
				async:false,

				success: function(msg){
					if(msg=="Correcto"){
						alert("Usuario Correcto");
						window.location="pagina_modal.php";
					}else{
						document.write("Usuario Incorrecto");
						$("#Usuario").val("");
						$("#Password").val("");
					}
				}
			});	
		}
	});
});
</script>