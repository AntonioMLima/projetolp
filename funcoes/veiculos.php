<?php

    declare(strict_types=1);

    require_once '../config/bancodedados.php';

    function buscarVeiculos(): array {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM veiculos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarVeiculoPorPlaca(string $placa): ?array {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM veiculos 
                                WHERE placa = ?");
        $stmt->execute([$placa]);
        $veiculo = $stmt->fetch(PDO::FETCH_ASSOC);
        return $veiculo ? $veiculo : null;
    }

    function buscarVeiculosEstacionadosPorCpf(string $cpf): ?array {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM veiculos WHERE cpf_cliente = ? and estacionado = 1");
        $stmt->execute([$cpf]);
        $veiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $veiculos ? $veiculos : null;
    }

    function buscarVeiculosNaoEstacionado(): array {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM veiculos WHERE estacionado = 0");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarVeiculosPorCpf(string $cpf): ?array {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM veiculos WHERE cpf_cliente = ?");
        $stmt->execute([$cpf]);
        $veiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $veiculos;
    }

    
    function adicionarVeiculo(string $placa, string $marca, string $modelo, string $tipo, string $cpf_cliente): bool {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO veiculos (placa, marca, modelo, tipo, cpf_cliente, estacionado) VALUES (?, ?, ?, ?, ?, false)");
        return $stmt->execute([$placa, $marca, $modelo, $tipo, $cpf_cliente]);
    }

    function alterarVeiculo(string $placa, string $marca, string $modelo, string $tipo, string $cpf_cliente): bool {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE veiculos SET marca = ?, modelo = ?, tipo = ?, cpf_cliente = ? 
                WHERE placa = ?");
        return $stmt->execute([$marca, $modelo, $tipo ,$cpf_cliente, $placa]);
    }

    function excluirVeiculo(string $placa) : bool {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM veiculos WHERE placa = ?");
        return $stmt->execute([$placa]);
    }

    function validarPlaca(string $placa) : bool {
        $regex = '/[A-Z]{3}[0-9][0-9A-Z][0-9]{2}/';
        
        $isValida = preg_match($regex, $placa) === 1;
        return $isValida;
    }


    function atribuirVeiculo(string $placa) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE veiculos SET estacionado = ?
        WHERE placa = ?");
        return $stmt->execute([true, $placa]);
    }
    
    function liberarVeiculo(string $placa) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE veiculos SET estacionado = ?
        WHERE placa = ?");
        return $stmt->execute([false, $placa]);
    }



