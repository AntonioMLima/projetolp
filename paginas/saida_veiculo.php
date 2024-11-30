<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/veiculos.php';
    require_once '../funcoes/clientes.php';
    require_once '../funcoes/vagas.php';

    

    $erro = '';

    $placa = ($_GET['placa']);
    $veiculo = buscarVeiculoPorPlaca($placa);
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        try {
            $vaga = retornarVagaPorPlaca($placa);
            $cliente = retornaClientePorCpf($veiculo['cpf_cliente']);


           
                
            if ( liberar($vaga['id_vaga'], $placa) && liberarCliente($cliente['cpf'], false) && liberarVeiculo($placa)){
                header('Location: veiculos.php');
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
    <h2>Liberar Carro? </h2>

    <ul>
        <li><strong>Placa: <?= $veiculo['placa'] ?></strong> </li>
        <li><strong>Marca: <?= $veiculo['marca'] ?></strong></strong> </li>
        <li><strong>Modelo: <?= $veiculo['modelo'] ?></strong></strong> </li>
        <li><strong> Tipo:<?= $veiculo['tipo'] ?></strong></strong> </li>
        <li><strong>CPF do Dono: <?= $veiculo['cpf_cliente'] ?></strong></strong> </li>
        <li><strong>Estacionado: <?= $veiculo['estacionado'] ? "Sim" : "Não"?></strong></strong> </li>
    </ul>

    <form method="post">
        <input type="hidden" name="id_vaga" value="<?=$vaga['id_vaga']?>" />
        <button type="submit" name="confirmar" class="btn btn-success">Liberar</button>
        <a href="veiculos.php" class="btn btn-secondary">Cancelar</a>
    </form>
    


   
    
</div>

<?php require_once 'rodape.php'; ?>
