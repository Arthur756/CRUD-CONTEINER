<?php
    $conn = new mysqli("localhost", "root", "", "crud_conteiner");
    if($conn->connect_error){
        die("Connection Failed!".$conn->connect_error);

    }
    
    $result = array('error'=>false);
    $action = '';

    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }

    if($action == 'read'){
        $sql = $conn->query("SELECT * FROM cliente");
        $cliente = array();
        while($row = $sql->fetch_assoc()){
            array_push($cliente, $row);
        }
        $result['cliente'] = $cliente;
    }
    echo json_encode($result)

    if($action == 'create'){
        $name = $_POST[ 'nome'];
        $numcont = $_POST[ 'nconteiner'];
        $tipo = $_POST[ 'tipo'];
        $status = $_POST[ 'status'];
        $categoria = $_POST[ 'categoria'];
        $movs = $_POST[ 'movimentacao'];
        $dta_inicio = $_POST[ 'data_hora_inicio'];
        $dta_fim = $_POST[ 'data_hora_fim'];

        $sql = $conn->query("INSERT INTO cliente (nome, nconteiner, tipo, status, 
        categoria, movimentacao, data_hora_inicio, data_hora_fim) 
        VALUES('$name', '$numcont', '$tipo', 
        '$status', '$categoria', '$movs', '$dta_inicio', '$dta_fim')");
        
        if($sql){
            $result['message'] = "Cliente adicionado!";
        }
        else{
            $result['error'] = true;
            $result['message'] = "Erro ao adicionar cliente!";
        }

    }
    

        if($action == 'update'){
            $id = $_POST[ 'id'];
            $name = $_POST[ 'nome'];
            $numcont = $_POST[ 'nconteiner'];
            $tipo = $_POST[ 'tipo'];
            $status = $_POST[ 'status'];
            $categoria = $_POST[ 'categoria'];
            $movs = $_POST[ 'movimentacao'];
            $dta_inicio = $_POST[ 'data_hora_inicio'];
            $dta_fim = $_POST[ 'data_hora_fim'];
    
            $sql = $conn->query("UPDATE cliente SET nome='$name', nconteiner='$numcont', tipo='$tipo', status='$status', 
            categoria='$categoria', movimentação='$movs', data_hora_inicio='$dta_inicio', data_hora_fim='$dta_fim' WHERE
            id='$id'");
            
            if($sql){
                $result['message'] = "Dados atualizados!";
            }
            else{
                $result['error'] = true;
                $result['message'] = "Erro ao atualizar os dados!";
            }
        }

        if($action == 'delete'){

            $id = $_POST['id'];
    
            $sql = $conn->query("DELETE FROM cliente WHERE id='$id'");
            
            if($sql){
                $result['message'] = "Cliente deletado";
            }
            else{
                $result['error'] = true;
                $result['message'] = "Erro ao deletar cliente";
            }
        }
        $conn->close();
        echo json_encode($result);
?>