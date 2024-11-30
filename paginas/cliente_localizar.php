<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/veiculos.php';
    require_once '../funcoes/vagas.php';
    

    
    $cpf = $_GET['cpf'];
    if (!$cpf){
        header('Location: clientes.php');
        exit();
    }
    
    $veiculos = buscarVeiculosEstacionadosPorCpf($cpf);
?>




<div class="container mt-5">
        <strong>Carros: </strong>
            <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>Placa</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Tipo</th>
                <th>ID da Vaga</th>
                <th>Tipo de Vaga</th>
                <th>Andar</th>
            </tr>
            </thead>
            <tbody>
            
            <?php foreach($veiculos as $v) : 
              $vaga = retornarVagaPorPlaca($v['placa'])  
                ?>
            <tr>
                <td><?= $v['placa'] ?></td>
                <td><?= $v['marca'] ?></td>
                <td><?= $v['modelo'] ?></td>
                <td><?= $v['tipo'] ?></td>
                <td><?= $vaga['id_vaga'] ?></td>
                <td><?= $vaga['tipo_vaga'] == 1 ? "Comum" : "Deficiente"?></td>
                <td><?= $vaga['andar']?>º</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    
    <a href="clientes.php" class="btn btn-secondary">Voltar</a>
</div>

<?php require_once 'rodape.php'; ?>
