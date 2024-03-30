<style>
	.header {
		position: relative;
		color: #FFF;
		background: rgb(82, 78, 78);
		height: 35px;
		font-family: 'Calibri';
		display: flex;
		align-items: center;
	}
	
	.header h1 {
		position: absolute;
		left: 0;
		right: 0;
		top: 0;
		bottom: 0;
		margin: auto;
		text-align: center;
		font-size: 26px;
		font-weight: bold;
		letter-spacing: 1px;
	}
	.header .optionsBar {
		position: absolute;
		right: 0;
		top: 0;
		bottom: 0;
		padding: 10px;
		display: flex;
		align-items: center;
	}
</style>
<header>
	<div class="header">
		<h1 style="text-align:center;">Veterinaria Avendano | num: 2245-2121 </h1>
		<div class="optionsBar">
			<span>|</span>
			<span class="user"></span>
			<img class="photouser" src="img/huella.png" alt="Usuario">
			<a href="salir.php"><img class="close" src="img/salir.png" alt="Salir del sistema" title="Salir"></a>
		</div>
	</div>
	<?php include "nav.php"; ?>
</header>