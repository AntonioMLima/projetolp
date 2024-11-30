<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/vagas.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        try {
            $id_vaga = intval($_POST['id_vaga']);
            if (excluirVaga($id_vaga)){
                header('Location: vagas.php');
                exit();
            } else {
                $erro = "Erro ao excluir a vaga!";
            }
        } catch (Exception $e){
            echo "hello";
            $erro = "Erro: ".$e->getMessage();
        }
    } else {
        if (isset($_GET['id_vaga'])){
            $id_vaga = intval($_GET['id_vaga']);
            $vaga = retornarVagaPorId($id_vaga);
            if ($vaga == null){
                header('Location: vagas.php');
                exit();
            }
        } else {
            header('Location: vagas.php');
            exit();
        }
    }
    
?>

<div class="container mt-5">
    <h2>Excluir Vaga</h2>

    <p>Tem certeza de que deseja excluir a Vaga abaixo?</p>

    <ul>
        <li><strong>ID: <?= $vaga['id_vaga'] ?></strong> </li>
        <li><strong>Ocupada: Não</strong> </li>
        <li><strong>Tipo: <?= $vaga['tipo_vaga'] == 1 ? "Comum" : "Deficiente"?></strong> </li>
        <li><strong>Andar: <?= $vaga['andar'] ?>º</strong> </li>
    </ul>

    <form method="post">
        <input type="hidden" name="id_vaga" value="<?=$vaga['id_vaga']?>" />
        <button type="submit" name="confirmar" class="btn btn-danger">Excluir</button>
        <a href="vagas.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
