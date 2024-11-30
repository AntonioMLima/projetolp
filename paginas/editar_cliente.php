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


    $erro = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        try{
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $cpf = $_POST['cpf'];
            $liberado = $_POST['liberado'] == "true";
            $pcd = ( $_POST['pcd']) == "true" ;

            
            if (empty($nome) || empty($email) || empty($cpf)){
                
                $erro = "Preencha os campos obrigatórios!";
            } 
            else {
                if (alterarCliente($nome, $cpf, $email, $liberado, $pcd)){
                            header('Location: clientes.php');
                            exit();
                        } else {
                            $erro = "Erro ao alterar o cliente!";
                        }
            }

        } catch (Exception $e){
            $erro = "Erro: ".$e->getMessage();
            echo $erro;
        }
    }
?>

<div class="container mt-5">
    <h2>Editar Cliente</h2>
    
    <form method="post">
        <input type="hidden" name="cpf" value="<?= $cpf ?>" />

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="<?= $cliente['nome'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= $cliente['email'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="liberado" class="form-label">Liberado</label>
            <select name="liberado" id="liberado" class="form-control" required>
                <option value="true" <?= $cliente['liberado'] ? 'selected': '' ?>>Sim</option>
                <option value="false" <?= !$cliente['liberado'] ? 'selected': '' ?>>Não</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="pcd" class="form-label">PCD</label>
            <select name="pcd" id="pcd" class="form-control" required>
                <option value="true"<?= $cliente['pcd'] ? 'selected': '' ?>>Sim</option>
                <option value="false" <?= !$cliente['pcd'] ? 'selected': '' ?>>Não</option>
            </select>
        </div>

       

        
        <button type="submit" class="btn btn-primary">Atualizar dados</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
