<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/veiculos.php';
    require_once '../funcoes/clientes.php';

    
    $placa = $_GET['placa'];
    if (!$placa){
        header('Location: veiculos.php');
        exit();
    }
    
    $veiculo = buscarVeiculoPorPlaca($placa);
    if (!$veiculo){
        header('Location: veiculos.php');
        exit();
    }


    $cliente = retornaClientePorCpf($veiculo['cpf_cliente']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        try {
            $placa = $_POST['placa'];
            if (excluirVeiculo($placa)){
                header('Location: veiculos.php');
                exit();
            } else {
                $erro = "Erro ao excluir veículo!";
            }
        } catch (Exception $e){
            $erro = "Erro: ".$e->getMessage();
        }
    } else {
        if (isset($_GET['placa'])){
            $placa = $_GET['placa'];
            $veiculo = buscarVeiculoPorPlaca($placa);
            if ($veiculo == null){
                header('Location: veiculos.php');
                exit();
            }
        } else {
            header('Location: veiculos.php');
            exit();
        }
    }
    
?>

<div class="container mt-5">
    <?php if(!empty($erro)):?>
        <p class="text-danger"><?= $erro ?></p>
    <?php endif; ?>

    <h2>Excluir Veiculo</h2>

    <p>Tem certeza de que deseja excluir o Veiculo abaixo?</p>

    <ul>
        <li><strong>Placa: <?= $veiculo['placa'] ?></strong> </li>
        <li><strong>Marca: <?= $veiculo['marca'] ?></strong> </li>
        <li><strong>Modelo:  <?= $veiculo['modelo']?></strong> 
        <li><strong>Tipo:  <?= $veiculo['tipo']?></strong> 
        <li><strong>CPF do Dono:  <?= $cliente['cpf']?></strong> 
        <li><strong>Nome do Dono:  <?= $cliente['nome']?></strong> 
        </ul>
    <form method="post">
        <input type="hidden" name="placa" value="<?= $veiculo['placa'] ?>" />
        <button type="submit" name="confirmar" class="btn btn-danger">Excluir</button>
        <a href="veiculos.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
