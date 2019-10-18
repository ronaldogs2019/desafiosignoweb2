<html>
<head>
	<title>Teste - Signo Web</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
 	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="scripts.js"></script>
</head>
<?php include("conexao.class.php"); ?>
<?php 

$id = $_GET['id'];

if(!empty($id)){

	$conn = Database::init();

	$stmt = $conn->prepare("SELECT * FROM cadastro WHERE Id = :Id");
	$stmt->execute(['Id' => $id]); 
	$dados = $stmt->fetch();

}else{
	 header('Location: Fail3.php'); 
}

if( !empty($dados) ){
?>
<body>
	<div class="container">
		<div class="row align-content-center">
			<div class="col">
				<div class="box form-inline">
					<div>
						<h1>Formulário de Cadastro</h1>
					</div>
				</div>
			</div>
		</div>
		<div class="row align-content-center">
			<div class="col">
				<form method="POST" action="crud.php">
				  	<div class="form-row">
					    <div class="form-group" style="margin:15px;">
						    <label>Nome</label>
						    <input type="text" class="form-control" name="Nome" value="<?php echo ( isset($dados['Nome']) || !empty($dados['Nome']) ) ? $dados['Nome'] : ""; ?>" placeholder="Nome" required>
					    </div>
					    <div class="form-group" style="margin:15px;">
						    <label>Email</label>
						    <input type="text" class="form-control" name="Email" value="<?php echo ( isset($dados['Email']) || !empty($dados['Email']) ) ? $dados['Email'] : ""; ?>" disabled>
					    </div>
				  	</div>
				  	<div class="form-row">
					    <div class="form-group" style="margin:15px;">
						    <label>Telefone</label>
						    <input type="text" class="form-control" name="Telefone" value="<?php echo ( isset($dados['Telefone']) || !empty($dados['Telefone']) ) ? $dados['Telefone'] : ""; ?>" placeholder="Telefone" id="Telefone" required>
					    </div>
					    <div class="form-group" style="margin:15px;">
						    <label>Data de Nascimento</label>
						    <input type="text" class="form-control" name="Data_de_Nascimento" value="<?php echo ( isset($dados['Data_de_Nascimento']) || !empty($dados['Data_de_Nascimento']) ) ? $dados['Data_de_Nascimento'] : ""; ?>" id="Data_de_Nascimento" placeholder="Data de Nascimento" required>
					    </div>
				  	</div>
					<div class="form-row">
					    <div class="form-group" style="margin:15px;">
						    <label>Endereço</label>
						    <input type="text" class="form-control" name="Endereco" value="<?php echo ( isset($dados['Nome']) || !empty($dados['Nome']) ) ? $dados['Nome'] : ""; ?>" placeholder="Endereço" required>
					    </div>
					</div>
				  	<div class="form-row">			
					  	<div class="form-group" style="margin:15px;">	  	
					  		<button type="submit" class="btn btn-success">Salvar</button>
					  	</div>
				  	</div>
				  	<input type="text" value="<?php echo ( isset($dados['Id']) || !empty($dados['Id']) ) ? $dados['Id'] : ""; ?>" name="Id" hidden>
				  	<input type="text" name="edit" hidden>
				</form>
			</div>
		</div>
	</div>
</body>
<?php } ?>
</html>