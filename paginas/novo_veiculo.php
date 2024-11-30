<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/veiculos.php';
    require_once '../funcoes/clientes.php';
    
    $clientes = todosClientes();
    $erro = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        try {
            $placa = $_POST['placa'];
            $marca= $_POST['marca'];
            $modelo = $_POST['modelo'];
            $cpf_cliente = $_POST['cliente_cpf'];
            $tipo = $_POST['tipo'];

            
            if (empty($placa) || empty($marca) || empty($modelo) || empty($cpf_cliente) || empty($tipo)){
                $erro = "Informe os valores obrigatórios!";
            } else if (!validarPlaca($placa)) {
                $erro = "Placa inválida";
            } 
            else {
                if (adicionarVeiculo($placa, $marca, $modelo, $tipo ,$cpf_cliente)){
                    header('Location: veiculos.php');
                    exit();
                } else {
                    $erro = "Erro ao inserir o veiculo!";
                }
            }
        } catch (Exception $e){
            $erro = "Erro: ".$e->getMessage();
        }
    }
?>

<div class="container mt-5">
    <h2>Insirir Novo Veículo</h2>

    <?php if(!empty($erro)):?>
        <p class="text-danger"><?= $erro ?></p>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="placa" class="form-label">Placa</label>
            <input type="text" name="placa" id="placa" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" name="marca" id="marca" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="preco" class="form-label">Modelo</label>
            <input type="text" name="modelo" id="modelo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de veículo</label>
            <select name="tipo" id="tipo" class="form-select" required>
                    <option value="Carro">Carro</option>
                    <option value="Moto">Moto</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="cliente_cpf" class="form-label">Cliente</label>
            <select name="cliente_cpf" id="cliente_cpf" class="form-select" required>
                <?php foreach($clientes as $c): ?>
                    <option value="<?= $c['cpf']?>">Nome: <?= $c['nome'] ?>; CPF: <?= $c['cpf']?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Inserir Veiculo</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
