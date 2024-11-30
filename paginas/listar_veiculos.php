<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/veiculos.php';
    

    
    $cpf = $_GET['cpf'];
    if (!$cpf){
        header('Location: clientes.php');
        exit();
    }
    
    $veiculos = buscarVeiculosPorCpf($cpf);
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
               
            </tr>
            </thead>
            <tbody>
            
            <?php foreach($veiculos as $v) : 
                ?>
            <tr>
                <td><?= $v['placa'] ?></td>
                <td><?= $v['marca'] ?></td>
                <td><?= $v['modelo'] ?></td>
                <td><?= $v['tipo'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    
    <a href="clientes.php" class="btn btn-secondary">Voltar</a>
</div>

<?php require_once 'rodape.php'; ?>
