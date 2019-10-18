<html>
<head>
	<title>Teste - Signo Web</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="scripts.js"></script>
	<script type="text/javascript">
		function confirmDelete(id) {
            console.log(id);

	       if (confirm("Tem certeza que deseja excluir esse cadastro?")) {
	          location.href="crud.php?delete="+id;
	       }
	    }
	</script>
</head>
<?php include("conexao.class.php"); ?>
<body>
	<div class="container">
		<div class="row">
			<div class="col" style="width: 100%;">
				<div class="box form-inline box-content-between">
					<div>
						<h1>Listagem</h1>
					</div>
					<div><a href="formulario.php" class="btn btn-success">
						Novo</a>
					</div>					
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col" style="width: 100%;">				
				<table class="table table-striped">
					<thead>
						<th>Nome</th>
						<th>Email</th>
						<th>Telefone</th>
						<th>Data de Nascimento</th>
						<th>Endereço</th>
						<th colspan="2">Funções</th>
					</thead>
					<tbody>
						<?php 
						$conn = Database::init();

						$sql = 'SELECT * FROM cadastro ORDER BY Nome';

						$dados = $conn->query($sql);

						if( !empty($dados) ){
						
						foreach ($dados as $row) { ?>
						<tr>
							<td><?php echo ( isset($row['Nome']) || !empty($row['Nome']) ) ? $row['Nome'] : ""; ?></td>
							<td><?php echo ( isset($row['Email']) || !empty($row['Email']) ) ? $row['Email'] : ""; ?></td>
							<td><?php echo ( isset($row['Telefone']) || !empty($row['Telefone']) ) ? $row['Telefone'] : ""; ?></td>
							<td><?php echo ( isset($row['Data_de_Nascimento']) || !empty($row['Data_de_Nascimento']) ) ? $row['Data_de_Nascimento'] : ""; ?></td>
							<td><?php echo ( isset($row['Endereco']) || !empty($row['Endereco']) ) ? $row['Endereco'] : ""; ?></td>
							<td><a href="editar.php?id=<?php echo ( isset($row['Id']) || !empty($row['Id']) ) ? $row['Id'] : ""; ?>">Editar</a></td>
							<td><a href="#" onclick="confirmDelete(<?php echo $row['Id'] ?>)">Deletar</a></td>
						</tr>
						<?php }} ?>
					</tbody>
				</table>				
			</div>
		</div>		
	</div>
</body>
</html>
