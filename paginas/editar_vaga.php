<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php'; 
    require_once '../funcoes/vagas.php';


    $id_vaga = $_GET['id_vaga'];
    if (!$id_vaga){
        header('Location: vagas.php');
        exit();
    }

    $vagas = retornarVagaPorId($id_vaga);
    if (!$vagas){
        header('Location: vagas.php');
        exit();
    }


    $erro = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        try{
            $tipo_vaga = intval($_POST['tipo_vaga']);
            $andar = intval($_POST['andar']);


            if (empty($tipo_vaga) || empty($andar)){
                $erro = "Preencha os campos obrigatórios!";
            } else {
                if (alterarVaga( $id_vaga, $andar, $tipo_vaga)){
                            header('Location: vagas.php');
                            exit();
                        } else {
                            $erro = "Erro ao alterar a vaga!";
                        }
            }

        } catch (Exception $e){
            $erro = "Erro: ".$e->getMessage();
        }
    }
?>

<div class="container mt-5">
    <h2>Editar Vaga</h2>

    <?php if(!empty($erro)):?>
        <p class="text-danger"><?= $erro ?></p>
    <?php endif; ?>

    <form method="post">
    <div class="mb-3">
        <label for="tipo_vaga" class="form-label">Tipo de vaga</label>
            <select name="tipo_vaga" id="tipo_vaga" class="form-select" required>
                <option value="1" <?= $vagas['tipo_vaga'] == 1 ? 'selected': '' ?> >Vaga Comum </option>
                <option value="2" <?= $vagas['tipo_vaga'] == 2 ? 'selected': '' ?>> Vaga para Deficientes</option>
            </select>
        </div>
       
        <div class="mb-3">
        <label for="andar" class="form-label"> Andar</label>
            <select name="andar" id="andar" class="form-select" required>
                <option value="1" <?= $vagas['andar'] == 1 ? 'selected': '' ?>>1º Andar</option>
                <option value="2" <?= $vagas['andar'] == 2 ? 'selected': '' ?>> 2º Andar</option>
                <option value="3" <?= $vagas['andar'] == 3 ? 'selected': '' ?>> 3º Andar </option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar Vaga</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
