<?php 
include("conexao.class.php");

$Id = isset($_POST["Id"]) ? $_POST["Id"] : "";
$Nome = isset($_POST["Nome"]) ? $_POST["Nome"] : "";
$Email = isset($_POST["Email"]) ? $_POST["Email"] : ""; 
$Telefone = isset($_POST["Telefone"]) ? $_POST["Telefone"] : ""; 
$Data_de_Nascimento = isset($_POST["Data_de_Nascimento"]) ? $_POST["Data_de_Nascimento"] : ""; 
$Endereco = isset($_POST["Endereco"]) ? $_POST["Endereco"] : "";

$cadastro = new formulario();

if( isset($_POST["new"]) ){
    $cadastro->insert($Nome, $Email, $Telefone, $Data_de_Nascimento, $Endereco);
}elseif( isset($_POST["edit"]) ){
    $cadastro->update($Id, $Nome, $Telefone, $Data_de_Nascimento, $Endereco);
}elseif( isset($_GET["delete"]) ){
    $cadastro->delete($_GET["delete"]);
}else{
    header('Location: fail3.php');
}


class formulario{

    function insert($nome, $email, $tel, $data_nasc, $endereco)
    {

        if( !empty(trim($nome)) && !empty(trim($email)) && !empty(trim($tel)) && !empty(trim($endereco)) && !empty(trim($data_nasc)) )
        {        
            $conn = Database::init();

            $stmt = $conn->prepare("SELECT * FROM cadastro WHERE Email = :Email");
            $stmt->execute(['Email' => $email]); 
            $dados = $stmt->fetch();

            if($dados['Email'] == $email){
                header('Location: fail2.php');
                exit ;
            }

            $dados = array(
                'Nome' => $nome,
                'Email' => $email,
                'Telefone' => $tel,
                'Data_de_Nascimento' => $data_nasc,
                'Endereco' => $endereco
            );

            try{
                $conn->prepare("INSERT INTO cadastro (Nome, Email, Telefone, Data_de_Nascimento, Endereco) VALUES (:Nome, :Email, :Telefone, :Data_de_Nascimento, :Endereco)")->execute($dados);
                unset($conn);
                header('Location: sucess.php');            
            }catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }else{
            header('Location: fail.php');   
        }
    }

    function update($id, $nome, $tel, $data_nasc, $endereco)
    {

        if( !empty(trim($id)) && !empty(trim($nome)) && !empty(trim($tel)) && !empty(trim($endereco)) && !empty(trim($data_nasc)) )
        {        
            $conn = Database::init();

           try {          
           
            $stmt = $conn->prepare('UPDATE cadastro SET Nome = :Nome, Telefone = :Telefone, Data_de_Nascimento = :Data_de_Nascimento, Endereco = :Endereco WHERE Id = :Id');

            $stmt->execute(array(
                'Id' => $id,
                'Nome' => $nome,               
                'Telefone' => $tel,
                'Data_de_Nascimento' => $data_nasc,
                'Endereco' => $endereco
          ));             
          header('Location: sucess2.php'); 
        } catch(PDOException $e) {
          echo 'Error: ' . $e->getMessage();
        }
        }else{
            header('Location: fail.php');   
        }
    }

    function delete($id)
    {
        if( !empty(trim($id)) )
        {     
            $conn = Database::init();
            
            try{          
               
            $stmt = $conn->prepare('DELETE FROM cadastro WHERE Id = :Id');
            $stmt->bindParam(':Id', $id); 
            $stmt->execute();
            header('Location: sucess3.php'); 
              echo $stmt->rowCount(); 
            } catch(PDOException $e) {
              echo 'Error: ' . $e->getMessage();
            }
        }else{
            header('Location: fail.php');   
        }
    }
}