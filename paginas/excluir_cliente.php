<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/clientes.php';

    
    $cpf = $_GET['cpf'];
    if (!$cpf){
        header('Location: clientes.php');
        exit();
    }
    
    $cliente = retornaClientePorCpf($cpf);
    if (!$cliente){
        header('Location: clientes.php');
        exit();
    }

    $veiculos = todosCarros($cpf);

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        try {
            $cpf = $_POST['cpf'];
            if (excluircliente($cpf)){
                header('Location: clientes.php');
                exit();
            } else {
                $erro = "Erro ao excluir o cliente!";
            }
        } catch (Exception $e){
            $erro = "Erro: ".$e->getMessage();
        }
    } else {
        if (isset($_GET['cpf'])){
            $cpf = $_GET['cpf'];
            $cliente = retornaClientePorCpf($cpf);
            if ($cliente == null){
                header('Location: clientes.php');
                exit();
            }
        } else {
            header('Location: clientes.php');
            exit();
        }
    }
    
?>

<div class="container mt-5">
    <?php if(!empty($erro)):?>
        <p class="text-danger"><?= $erro ?></p>
    <?php endif; ?>

    <h2>Excluir Cliente</h2>

    <p>Tem certeza de que deseja excluir o cliente abaixo?</p>

    <ul>
        <li><strong>CPF: <?= $cliente['cpf'] ?></strong></li>
        <li><strong>Nome: <?= $cliente['nome'] ?></strong> </li>
        <li><strong>Email: <?= $cliente['email'] ?></strong> </li>
        <li><strong>Permitir Entrada:  <?= $cliente['liberado'] ? "Sim" : "Não"?> </strong> 
        <li><strong>PCD: <?= $cliente['pcd'] ? "Sim" : "Não"?></strong></li>

    </ul>
        <?php if(count($veiculos) > 0){ ?>
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
            
            <?php foreach($veiculos as $v) : ?>
            <tr>
                <td><?= $v['placa'] ?></td>
                <td><?= $v['marca'] ?></td>
                <td><?= $v['modelo'] ?></td>
                <td><?= $v['tipo'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        </table>


        <?php } ?>
    <form method="post">
        <input type="hidden" name="cpf" value="<?= $cliente['cpf'] ?>" />
        <button type="submit" name="confirmar" class="btn btn-danger">Excluir</button>
        <a href="clientes.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
