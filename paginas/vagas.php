<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php';  
    require_once '../funcoes/vagas.php';

    // Buscando as vagas
    $vagas = buscarVagas();
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Gerenciamento de Vagas</h2>

    <!-- Botão para adicionar nova vaga -->
    <a href="nova_vaga.php" class="btn btn-success mb-4">
        <i class="bi bi-plus-square"></i> Adicionar Vaga
    </a>

    <!-- Tabela de vagas -->
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Andar</th>
                        <th>Tipo</th>
                        <th>Ocupada</th>
                        <th>Placa do Veículo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($vagas as $v) : ?>
                    <tr>
                        <td><?= $v['id_vaga'] ?></td>
                        <td><?= $v['andar']?>º</td>
                        <td><?= $v['tipo_vaga'] == 1 ? "Comum" : "Deficiente"?></td>
                        <td><?= $v['esta_ocupada'] ? "<span class='badge bg-success'>Sim</span>" : "<span class='badge bg-danger'>Não</span>" ?></td>
                        
                        <!-- Mostra a placa do veículo apenas se a vaga estiver ocupada -->
                        <?php if($v["esta_ocupada"]): ?>
                            <td><?= $v['placa_veiculo']?></td>
                        <?php else: ?>
                            <td><strong>-------</strong></td>
                        <?php endif; ?>

                        <!-- Ações -->
                        <td>
                            <?php if(!$v["esta_ocupada"]): ?>
                                <a href="editar_vaga.php?id_vaga=<?= $v['id_vaga'] ?>" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Editar Vaga">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="excluir_vaga.php?id_vaga=<?= $v['id_vaga'] ?>" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Excluir
                                </a>
                                <a href="atribuir_vaga.php?id_vaga=<?= $v['id_vaga'] ?>" class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="Atribuir Vaga">
                                    <i class="bi bi-check-square"></i> Atribuir
                                </a>
                            <?php endif; ?>

                            <?php if($v["esta_ocupada"]): ?>
                                <a href="liberar_vaga.php?id_vaga=<?= $v['id_vaga'] ?>" class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="Liberar Vaga">
                                    <i class="bi bi-x-square"></i> Liberar
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
