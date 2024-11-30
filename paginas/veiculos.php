<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';  
    require_once '../funcoes/veiculos.php';

    // Buscando os veículos
    $veiculos = buscarVeiculos();
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Gerenciamento de Veículos</h2>

    <!-- Botão para adicionar novo veículo -->
    <a href="novo_veiculo.php" class="btn btn-success mb-4">
        <i class="bi bi-plus-square"></i> Adicionar Veículo
    </a>

    <!-- Tabela de veículos -->
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>Placa</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Tipo</th>
                        <th>CPF do Dono</th>
                        <th>Estacionado</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($veiculos as $v) : ?>
                    <tr>
                        <td><?= $v['placa'] ?></td>
                        <td><?= $v['marca'] ?></td>
                        <td><?= $v['modelo'] ?></td>
                        <td><?= $v['tipo'] ?></td>
                        <td><?= $v['cpf_cliente'] ?></td>
                        <td><?= $v['estacionado'] ? "<span class='badge bg-success'>Sim</span>" : "<span class='badge bg-danger'>Não</span>" ?></td>
                        
                        <!-- Ações -->
                        <td>
                            <?php if(!$v["estacionado"]): ?>
                                <a href="editar_veiculo.php?placa=<?= $v['placa'] ?>" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Editar Veículo">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="excluir_veiculo.php?placa=<?= $v['placa'] ?>" class="btn btn-danger btn-sm" >
                                    <i class="bi bi-trash"></i> Excluir
                                </a>
                            <?php endif; ?>

                            <?php if($v["estacionado"]): ?>
                                <a href="saida_veiculo.php?placa=<?= $v['placa'] ?>" class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="Realizar Saída">
                                    <i class="bi bi-arrow-bar-right"></i> Realizar Saída
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Rodapé -->
<?php require_once 'rodape.php'; ?>

<!-- Inicializando tooltips do Bootstrap -->
<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>
