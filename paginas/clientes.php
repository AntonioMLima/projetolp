<?php 
    require_once 'cabecalho.php'; 
    require_once 'navbar.php'; 
    require_once '../funcoes/clientes.php';
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Gerenciamento de Clientes</h2>

    <!-- Botão para adicionar novo cliente -->
    <a href="novo_cliente.php" class="btn btn-success mb-4">
        <i class="bi bi-person-plus"></i> Novo Cliente
    </a>

    <!-- Tabela de clientes -->
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>CPF</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Permitir Entrada</th>
                        <th>PCD</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $clientes = todosClientes();
                        foreach ($clientes as $c):
                    ?>
                    <tr>     
                        <td><?= $c['cpf'] ?></td>
                        <td><?= $c['nome'] ?></td>
                        <td><?= $c['email'] ?></td>
                        <td><?= $c['liberado'] ? "<span class='badge bg-success'>Sim</span>" : "<span class='badge bg-danger'>Não</span>" ?></td>
                        <td><?= $c['pcd'] ? "<span class='badge bg-success'>Sim</span>" : "<span class='badge bg-danger'>Não</span>" ?></td>

                        <td>
                            <!-- Ações: Editar, Excluir, Listar Veículos, Localizar -->
                            <?php if(!$c["utilizando"]): ?>
                                <a href="editar_cliente.php?cpf=<?= $c['cpf'] ?>" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Editar Cliente">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <a href="excluir_cliente.php?cpf=<?= $c['cpf'] ?>" class="btn btn-danger btn-sm" >
                                    <i class="bi bi-trash"></i> Excluir
                                </a>
                                <a href="listar_veiculos.php?cpf=<?= $c['cpf'] ?>" class="btn btn-secondary btn-sm" data-bs-toggle="tooltip" title="Listar Veículos">
                                    <i class="bi bi-car"></i> Listar Veículos
                                </a>
                            <?php endif; ?>

                            <?php if($c["utilizando"]): ?>
                                <a href="cliente_localizar.php?cpf=<?= $c['cpf'] ?>" class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="Localizar Veículo">
                                    <i class="bi bi-geo-alt"></i> Localizar Veículo
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
