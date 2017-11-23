<?php 
	session_start();
	$_SESSION['length_id'] = 0;
	if (isset($_SESSION)) {
		if (isset($_SESSION['conta']) AND isset($_SESSION['senha']) AND $_SESSION['id'] != NULL) {
			$login = 1;
		}
		else {
			$login = 2;
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Chat</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/funcoes.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			var mensagens = $('.panel-body');
			mensagens.html('');
			$('.bgn').mouseenter(function(){
				//console.log($(this).val());
				$(".desc").css({'display' : 'block'});
			});
			$('.bgn').mouseleave(function(){
				$(".desc").css({'display' : 'none'});
			});
			setInterval(function(){
				console.log(<?php echo $_SESSION['length_id']; ?>);
				a = $('.user');
				$.post("php/bd.php", {mensage: 'ok'}, function(data){
					if (data.length === 2) {
						//console.log('vazia');
					}
					else{
						data = JSON.parse(data);
						for(i = 0; i < data.length; i++){
							//console.log(data[i]);
							var chat = $('.panel-body');

							<?php
								if ($login == 1) {
									$a = 'if('.$_SESSION['id'][0]->id.'== data[i].id){';
									echo $a;
							?>
									chat.append('<h6 class=\"myMensage user\">'+data[i].conta+'</h6><h4 class="myMensage mensage">'+data[i].text+'</h4>');
							<?php
									echo '}else{';
							?>
									chat.append('<h6 class=\"outerMensage user\">'+data[i].conta+'</h6><h4 class="outerMensage mensage">'+data[i].text+'</h4>');
							<?php
									echo "}";
								}
								else {
							?>
								chat.append('<h6 class=\"outerMensage user\">'+data[i].conta+'</h6><h4 class="outerMensage mensage">'+data[i].text+'</h4>');
							<?php
								}
							?>
						} 
					}
				}, "html");    
				//a.append('i');
			}, 1500);
			//a.append('<h4 class=/"outerMensage">batata</h4>');
		});

		/*
		setInterval(function(){
		    a = $('.btn');
		    a.append('i');
		}, 1000);
		*/
	</script>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container" >
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">Chat</a>
			</div>
			<ul class="nav navbar-nav navbar-right" id="myBarOption" style="display: none;">
		        <li><a href="#">Opcoes</a></li>
		    </ul>
			<div class="collapse navbar-collapse" id="myNavbar">
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="index.php">Inicio</a></li>
		        <?php
		        	if ($login == 2) {	
		        ?>
				        <li><a href="login.html">Login</a></li>
				        <li><a href="#">Cadatrar</a></li>
		        <?php
		        	}
		        	else {	
		        ?>
		        		<li><a href="php/sair.php">Sair</a></li>
		        <?php 
		        	}
		        ?>
		      </ul>
		    </div>
		</div>
	</nav>

	<br>

	<div class="panel panel-default margins-1">
		<div class="panel-heading">
			<h3 style="color: #777;">
				Chat
			</h3>
		</div>
		<div class="panel-body">
		</div>
	</div>
	<?php
		if ($login == 1) {	
	?>
		<div class="input-group margins-1">
		  	<input type="text" class="form-control" placeholder="Text" aria-label="Text" aria-describedby="basic-addon2" id="Text">
		  	<span class="input-group-addon" id="basic-addon2"> 
		  		<button type="button" class="btn btn-outline-success button">Enviar</button>
		  	</span>
		</div>
	<?php
		}
	?>
	<br>
	<br>
</body>
</html>