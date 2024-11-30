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

    $clientes = todosClientes();

    $erro = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        try{
            $placa = $_POST['placa'];
            $marca= $_POST['marca'];
            $modelo = $_POST['modelo'];
            $cpf_cliente = $_POST['cpf_cliente'];
            $tipo = $_POST['tipo'];

            if (empty($placa) || empty($marca) || empty($modelo) || empty($cpf_cliente) || empty($tipo)){
                $erro = "Preencha os campos obrigatórios!";
            } else {
                if (alterarVeiculo($placa, $marca, $modelo, $tipo,$cpf_cliente)){
                            header('Location: veiculos.php');
                            exit();
                        } else {
                            $erro = "Erro ao alterar veículo!";
                        }
            }

        } catch (Exception $e){
            $erro = "Erro: ".$e->getMessage();
        }
    }
?>

<div class="container mt-5">
    <h2>Alterar Veiculo</h2>

    <?php if(!empty($erro)):?>
        <p class="text-danger"><?= $erro ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="hidden" name="placa" value="<?= $placa ?>" />

        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" name="marca" id="marca" class="form-control" 
            value="<?= $veiculo['marca'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="preco" class="form-label">Modelo</label>
            <input type="text" name="modelo" id="modelo" class="form-control"
            value="<?= $veiculo['modelo'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de veículo</label>
            <select name="tipo" id="tipo" class="form-select" required>
                    <option value="Carro" <?= $veiculo['tipo'] == "carro" ? 'selected': '' ?>>Carro</option>
                    <option value="Moto" <?= $veiculo['tipo'] == "moto" ? 'selected': '' ?>>Moto</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="cpf_cliente" class="form-label">Cliente</label>
            <select name="cpf_cliente" id="cpf_cliente" class="form-select" required>
                <?php foreach($clientes as $c): ?>
                    <option value="<?= $c['cpf']?>"
                    <?= $c['cpf'] == $veiculo['cpf_cliente'] ? 'selected': '' ?>
                    >Nome: <?= $c['nome'] ?>; CPF: <?= $c['cpf']?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Veiculo</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
