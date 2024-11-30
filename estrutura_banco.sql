CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    nivel ENUM('adm', 'colab') NOT NULL
);


CREATE TABLE clientes (
    cpf char(11) PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    liberado bool not null,
    utilizando bool not null,
    pcd bool not null
);

CREATE TABLE veiculos (
    placa CHAR(7) NOT NULL PRIMARY KEY,
	marca VARCHAR(15),
    modelo VARCHAR(50) NOT NULL,
    tipo varchar(5) NOT NULL,
    cpf_cliente CHAR(11),
    estacionado bool not null,
    FOREIGN KEY (cpf_cliente) REFERENCES clientes(cpf) ON DELETE CASCADE
);





CREATE TABLE vagas (
    id_vaga INT AUTO_INCREMENT PRIMARY KEY,
    esta_ocupada BOOLEAN NOT NULL, 
    cpf_cliente char(11),
    placa_veiculo char(7),
    tipo_vaga INT,
    andar INT,
	ocupada bool not null,
    FOREIGN KEY (placa_veiculo) REFERENCES veiculos(placa)
    ON DELETE SET NULL
);

alter table vagas
drop cpf_cliente;





CREATE TABLE produto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10, 2) NOT NULL,
    estoque_minimo INT NOT NULL,
    categoria_id INT,
    FOREIGN KEY (categoria_id) REFERENCES categoria(id)
);

alter table vagas
change ocupada esta_ocupada bool not null;




