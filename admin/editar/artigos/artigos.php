<?php
session_start();
require_once("../../../conn/conn.php");

if(isset($_POST['editarbtn']))
{
    #$lavagem_id = $_POST['edit_id'];
    $nome = $_POST['nome'];
    #$preco = $_POST['edit_preco'];

    #$query = "UPDATE lavagem_seco SET nome='$nome', preco='$preco' WHERE lavagem_id='$lavagem_id'";
    #$query_run = mysqli_query($conn, $query);

    $query = "UPDATE nome SET nome='$nome' WHERE utilizador_id = $utilizador_id";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Peça atualizada";
        $_SESSION['status_code'] = "success";
        header('Location: editar_artigos.php'); 
    }
    else
    {
        $_SESSION['status'] = "Peça não foi atualizada";
        $_SESSION['status_code'] = "error";
        header('Location: editar_artigos.php'); 
    }
}

?>
