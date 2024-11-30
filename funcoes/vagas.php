<?php

declare(strict_types = 1);

require_once('../config/bancodedados.php');



function adicionarVaga(int $tipo_vaga, int $andar, string $placa_veiculo):bool{
    global $pdo;
    $stament = $pdo->prepare("INSERT INTO vagas (tipo_vaga, andar, esta_ocupada, placa_veiculo) VALUES (?, ?, false, placa_veiculo)");
    return $stament->execute([$tipo_vaga, $andar, $placa_veiculo]);
}

function adicionarVagaInicio(int $tipo_vaga, int $andar):bool{
    global $pdo;
    $stament = $pdo->prepare("INSERT INTO vagas (tipo_vaga, andar, esta_ocupada) VALUES (?, ?, false)");
    return $stament->execute([$tipo_vaga, $andar]);
}

function buscarVagas(): array{
    global $pdo;
    $stament = $pdo->query(" SELECT * FROM vagas");
    return $stament->fetchAll(PDO::FETCH_ASSOC);
}


function retornarVagaPorId(int $id): ?array{
    global $pdo;
    $stament = $pdo->prepare("SELECT * FROM vagas WHERE id_vaga = ?");
    $stament->execute([$id]);
    $vaga = $stament->fetch(PDO::FETCH_ASSOC);
    return $vaga ? $vaga : null;
}

function retornarVagaPorPlaca(string $placa): ?array {
    global $pdo;
    $stament = $pdo->prepare("SELECT * FROM vagas WHERE placa_veiculo = ?");
    $stament->execute([$placa]);
    $vaga = $stament->fetch(PDO::FETCH_ASSOC);
    return $vaga ? $vaga : null;
}



function excluirVaga(int $id):bool{
    global $pdo;
    $stament = $pdo->prepare("DELETE FROM vagas WHERE id_vaga = ?");
    return $stament->execute([$id]);
}

function alterarVaga(int $id, int $andar, int $tipo_vaga) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE vagas SET andar = ?, tipo_vaga = ? 
                WHERE id_vaga = ?");
        return $stmt->execute([$andar, $tipo_vaga, $id]);
}

function atribuir(int $id, string $placa) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE vagas SET placa_veiculo = ?, esta_ocupada = ?
                WHERE id_vaga = ?");
    return $stmt->execute([$placa, true ,$id]);
}


function liberar(int $id) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE vagas SET placa_veiculo = ?, esta_ocupada = ?
                WHERE id_vaga = ?");
    return $stmt->execute([null, false ,$id]);
}