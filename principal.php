<?php
session_start();
ob_start();

if ($_SESSION['sesion_exito']==1)
{
?>
	<frameset rows='73,*' frameborder='0' >
			<frame name="titulo" src='titulo.php'>

			</frame>

		<frameset cols='200,*'>
			<frame name='menu' src='menu.php'>
			</frame>

			<frame name='cuerpo' src='inicio.php'>
			</frame>
		</frameset>
	</frameset>
<?php
}
else
header('location:index.php');
;
?> 