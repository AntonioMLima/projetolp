<?php

declare(strict_types = 1);

require_once('../config/bancodedados.php');



function novoCliente(string $nome, string $cpf, string $email, bool $liberado, bool $utilizando, bool $pcd):bool{
    global $pdo;
    $stament = $pdo->prepare("INSERT INTO clientes (nome, cpf, email, liberado, utilizando, pcd) VALUES (?, ?, ?, ?, ?, ?)");
    return $stament->execute([$nome, $cpf, $email, $liberado, $utilizando, $pcd]);
}

function todosClientes(): array{
    global $pdo;
    $stament = $pdo->query(" SELECT * FROM clientes");
    return $stament->fetchAll(PDO::FETCH_ASSOC);
}

function retornaClientePorCpf(string $cpf): ?array{
    global $pdo;
    $stament = $pdo->prepare("SELECT * FROM clientes WHERE cpf = ?");
    $stament->execute([$cpf]);
    $cliente = $stament->fetch(PDO::FETCH_ASSOC);
    return $cliente ? $cliente : null;
}

function alterarCliente(string $nome, string $cpf, string $email, bool $liberado, bool $pcd): bool {
global $pdo;
$stmt = $pdo->prepare("UPDATE clientes SET nome = ?, email = ?, liberado = ?, pcd = ?
WHERE cpf = ?");
return $stmt->execute([$nome, $email, $liberado, $pcd ,$cpf]);
}

function excluirCliente(string $cpf):bool{
    global $pdo;
    $stament = $pdo->prepare("DELETE FROM clientes WHERE cpf = ?");
    return $stament->execute([$cpf]);
}

function todosCarros(int $cpf): array {
    global $pdo;
    $stmt  = $pdo->prepare("SELECT clientes.*, veiculos.*  
            FROM clientes 
        INNER JOIN
            veiculos 
        ON
            clientes.cpf = veiculos.cpf_cliente
        WHERE
            cpf = ?
    ");
    $stmt->execute([$cpf]);
    $carros = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $carros;
}


function validaCPF(string $cpf):bool {
 
    // Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
     
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}

function atribuirCliente(string $cpf, bool $utilizando) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE clientes SET utilizando = ?
    WHERE cpf = ?");
    return $stmt->execute([$utilizando, $cpf]);
}

function liberarCliente(string $cpf, bool $utilizando) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE clientes SET utilizando = ?
    WHERE cpf = ?");
    return $stmt->execute([$utilizando, $cpf]);
}





