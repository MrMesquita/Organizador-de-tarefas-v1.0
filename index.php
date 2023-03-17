<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Gerenciador de tarefas</title>
		<link rel="stylesheet" type="text/css" href="css\styles.css"/>
		<link href="https://fonts.googleapis.com/css2?family=Gloock&family=Oswald:wght@500&display=swap" rel="stylesheet">
	</head>
	<body>
		<section id="sec">
				<div class="logotipo"></div>
			<section class="organizador">
				<div class="titulo">
					<p>Gerenciador de tarefas</p>
				</div><!-----titulo----->
				<form class="add-tarefas" method="get">
					<label>Tarefas:</label>
						<input type="text" name="tarefas" placeholder="Nome da tarefa" required>
						<input type="submit" name="acao" value="Adicionar">
					<?php 
						include('Mysql.php');
						if (isset($_GET['acao'])) {
							$tarefa = $_GET['tarefas'];
							$sql = $pdo->prepare("INSERT INTO `tarefas` VALUES (null,?)");
							$sql->execute(array($tarefa));
							header("Refresh:0; url=index.php");
						}
					?>
				</form><!----add-tarefas----->
				<hr></hr>
				<form class="box-tarefas" method="get">
					<div class="tarefas">
						<ul action="index.php">
						<?php
							$sql = $pdo->prepare("SELECT * FROM `tarefas`");
							$sql->execute();
							$tar = $sql->fetchAll();
							foreach ($tar as $key => $value) {
								echo '<li><p>'.$value['nome_tarefa'].'</p></li>';
							}
						?>
						</ul>
					</div><!-----tarefas---->
					<div class="div-delete">
						<input type="submit" name="delete" value="Limpar todas as tarefas">
						<?php
							if (isset($_GET['delete'])) {
								$sql = $pdo->prepare("DELETE FROM `tarefas`");
								$sql->execute();
								header("Refresh:0; url=index.php");
							}
						?>
					</div><!-----div-delete---->
				</form><!----box-tarefas---->
				<hr></hr>
				<footer>
					<div class="creditos">
						<p>Desenvolvido por <a href="https://www.instagram.com/marcelo.guilherme.m/" target="_blank">@marcelo.guilherme.m</a></p>
					</div><!---creditos---->
				</footer>
			</section><!-----organizador----->
		</section>
	</body>
</html>