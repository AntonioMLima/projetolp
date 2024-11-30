<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/clientes.php';

    $erro = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        try {
            $nome = $_POST['nome'];
            $email= $_POST['email'];
            $cpf = $_POST['cpf'];
            $pcd = ($_POST['pcd']) == "true";

           
            if (empty($nome) || empty($email) || empty($cpf || empty($pcd))){
                $erro = "Informe os valores obrigatórios!";
            } else if (!validaCPF($cpf)) {
                $erro = "Insira um CPF válido";

            } else {
                if (novoCliente($nome, $cpf, $email, true, false, $pcd)){
                    header('Location: clientes.php');
                    exit();
                } else {
                    echo "erro";
                }
            }
        } catch (Exception $e){
            $erro = "Erro: ".$e->getMessage();
            echo $e;
        }
    }
?>

<div class="container mt-5">
    <h2>Inserir Novo Cliente</h2>

    <?php if(!empty($erro)):?>
        <p class="text-danger"><?= $erro ?></p>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required></input>
        </div>
        <div class="mb-3">
            <label for="preco" class="form-label">CPF</label>
            <input type="text" name="cpf" id="cpf" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="pcd" class="form-label">PCD</label>
            <select name="pcd" id="pcd" class="form-select">
                <option value="true" >Sim</option>
                <option value="false" selected >Não </option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Inserir</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
