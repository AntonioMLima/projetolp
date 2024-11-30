<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';
    require_once '../funcoes/veiculos.php';
    require_once '../funcoes/clientes.php';
    require_once '../funcoes/vagas.php';

    

    $erro = '';

    $veiculos = buscarVeiculosNaoEstacionado();
    $id_vaga = intval($_GET['id_vaga']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        try {

            $vaga = retornarVagaPorId($id_vaga);
            $tipo_vaga = $vaga['tipo_vaga'];
            $placa = $_POST['placa'];
            $veiculo = buscarVeiculoPorPlaca($placa);
            $cliente = retornaClientePorCpf($veiculo['cpf_cliente']);


           
            if ($tipo_vaga == 2 && !$cliente['pcd']){
                $erro = "Vaga para PCD apenas";
            } else if (!$cliente['liberado']) {
                $erro = "Cliente não autorizado";
            }
            
            else {
                
                if ( atribuir($id_vaga, $placa) && atribuirCliente($veiculo['cpf_cliente'], true) && atribuirVeiculo($placa)){
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
    <h2>Atribuir Vaga</h2>

    <?php if(!empty($erro)):
        
        ?>
        <p class="text-danger"><?= $erro ?></p>

    <?php endif; ?>
    

    <form method="post">
    <div class="mb-3">
            <label for="placa" class="form-label">Escolha o Veículo: </label>
            <select name="placa" id="placa" class="form-select" required>
    <?php 
    foreach($veiculos as $v): 
        $c = retornaClientePorCpf($v["cpf_cliente"]);
        $tooltip = "Dono: {$c['nome']} | CPF: {$c['cpf']} | PCD: " . ($c['pcd'] ? 'Sim' : 'Não');
    ?>
        <option value="<?= $v['placa'] ?>" title="<?= $tooltip ?>">
            <?= "🛑 Placa: {$v['placa']} | 📋 Modelo: {$v['modelo']} | 🧍 Dono: {$c['nome']} | 📄 CPF: {$c['cpf']} | ♿ PCD: " . ($c['pcd'] ? 'Sim' : 'Não') ?>
        </option>
    <?php endforeach; ?>
</select>

        </div>
   
        <button type="submit" class="btn btn-primary">Atribuir</button>
    </form>
</div>

<?php require_once 'rodape.php'; ?>
