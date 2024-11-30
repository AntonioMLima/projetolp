<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/vagas.php';

    $erro = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        try {

            $tipo_vaga = intval($_POST['tipo_vaga']);
            $andar = intval($_POST['andar']);

           
            if (empty($tipo_vaga) || empty($andar)){
                $erro = "Informe os valores obrigatórios!";
            } else {
                if ( adicionarVagaInicio($tipo_vaga, $andar)){
                    header('Location: vagas.php');
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
    <h2>Inserir Nova Vaga</h2>

    <form method="post">
        <div class="mb-3">
        <label for="tipo_vaga" class="form-label">Tipo de vaga</label>
            <select name="tipo_vaga" id="tipo_vaga" class="form-select" required>
                <option value=1 selected >Vaga Comum </option>
                <option value=2 Vaga para Deficientes> Vaga para Deficientes</option>
            </select>
        </div>
       
        <div class="mb-3">
        <label for="andar" class="form-label"> Andar</label>
            <select name="andar" id="andar" class="form-select" required>
                <option value="1" selected>1º Andar</option>
                <option value="2"> 2º Andar</option>
                <option value="3"> 3º Andar </option>
            </select>
        </div>


        
        <button type="submit" class="btn btn-primary">Inserir</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
