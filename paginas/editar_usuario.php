<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/usuarios.php';

    $id = $_GET['id'];
    if (!$id){
        header('Location: usuarios.php');
        exit();
    }

    $usuario = retornaUsuarioPorId($id);
    if (!$usuario){
        header('Location: usuario.php');
        exit();
    }


    $erro = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        try{
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $nivel = $_POST['nivel'];
            $id = intval($_POST['id']);
            $senha = $_POST['senha'];

            
            if (empty($nome) || empty($email) || empty($nivel) || empty($senha)){
                
                $erro = "Preencha os campos obrigatórios!";
            } else {
                if (editarUsuario($id, $nome, $email, $senha, $nivel)){
                            header('Location: usuarios.php');
                            exit();
                        } else {
                            $erro = "Erro ao alterar o produto!";
                        }
            }

        } catch (Exception $e){
            $erro = "Erro: ".$e->getMessage();
            echo $erro;
        }
    }
?>

<div class="container mt-5">
    <h2>Editar Usuário</h2>
    
    <form method="post">
        <input type="hidden" name="id" value="<?= $id ?>" />

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="<?= $usuario['nome'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= $usuario['email'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="nivel" class="form-label">Nível</label>
            <select name="nivel" id="nivel" class="form-control" required>
                <option value="colab" <?= $usuario['nivel'] == "colab" ? 'selected': '' ?>>Colaborador</option>
                <option value="adm" <?= $usuario['nivel'] == "adm" ? 'selected': '' ?>>Administrador</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="senha" class="form-label">Nova Senha</label>
            <input type="password" name="senha" id="senha" class="form-control" value="" >
        </div>
        <button type="submit" class="btn btn-primary">Atualizar dados</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
