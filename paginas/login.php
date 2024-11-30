<?php 
    require_once('../funcoes/usuarios.php');

    session_start();
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        try{
            $email = $_POST['email'] ?? "";
            $senha = $_POST['senha'] ?? "";
            if ($email != "" && $senha != ""){
                $usuario = login($email, $senha);
                if ($usuario){
                    $_SESSION['usuario'] = $usuario['nome'];
                    $_SESSION['nivel'] = $usuario['nivel'];
                    $_SESSION['acesso'] = true;
                    header("Location: dashboard.php");
                } else {
                    $erro = "Credenciais inválidas!";
                }
            }
        } catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
    }
    require_once 'cabecalho.php'; 
?>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
        <div class="card-header text-center bg-primary text-white">
            <h3>Login - Estacionamento</h3>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Digite seu email" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" name="senha" class="form-control" id="senha" placeholder="Digite sua senha" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
            <?php if(isset($erro)) echo "<p class='text-danger text-center mt-3'>$erro</p>"; ?>
        </div>
        <div class="card-footer text-center">
            <small class="text-muted">© 2024 Sistema de Estacionamento</small>
        </div>
    </div>
</div>

<?php require_once 'rodape.php'; ?>
