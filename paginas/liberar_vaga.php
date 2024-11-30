<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/veiculos.php';
    require_once '../funcoes/clientes.php';
    require_once '../funcoes/vagas.php';

    

    $erro = '';

    $id_vaga = intval($_GET['id_vaga']);
    $vaga = retornarVagaPorId($id_vaga);

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        try {

            $vaga = retornarVagaPorId($id_vaga);
            $tipo_vaga = $vaga['tipo_vaga'];
            $placa = $vaga['placa_veiculo'];
            $veiculo = buscarVeiculoPorPlaca($placa);
            $cliente = retornaClientePorCpf($veiculo['cpf_cliente']);


           
                
            if ( liberar($id_vaga) && liberarCliente($veiculo['cpf_cliente'], false) && liberarVeiculo($placa)){
                header('Location: vagas.php');
                exit();
            } else {
                echo "erro";
            }
                
            
        } catch (Exception $e){
            $erro = "Erro: ".$e->getMessage();
            echo $e;
        }
        
    }
?>

<div class="container mt-5">
    <h2>Liberar Vaga? </h2>

    <ul>
        <li><strong>ID: <?= $vaga['id_vaga'] ?></strong> </li>
        <li><strong>Ocupada: Sim</strong> </li>
        <li><strong>Tipo: <?= $vaga['tipo_vaga'] == 1 ? "Comum" : "Deficiente"?></strong> </li>
        <li><strong>Andar: <?= $vaga['andar'] ?>º</strong> </li>
    </ul>

    <form method="post">
        <input type="hidden" name="id_vaga" value="<?=$vaga['id_vaga']?>" />
        <button type="submit" name="confirmar" class="btn btn-success">Liberar</button>
        <a href="vagas.php" class="btn btn-secondary">Cancelar</a>
    </form>
    


   
    
</div>

<?php require_once 'rodape.php'; ?>
