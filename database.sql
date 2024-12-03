create database incidente;

use incidente;

CREATE TABLE incidentes (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    nome_switch ENUM('SW-DF100', 'SW-ESTANCIA', 'SW-JARDINS', 'SW-MARAJO', 'SW-PATIO', 'SW-SOF', 'SW-VALE') NOT NULL,
    descricao TEXT NULL,
    status ENUM('Pendente', 'Concluído') NOT NULL,
    data_incidente DATE NOT NULL,
    hora_incidente TIME NOT NULL,
    data_incidente_fim DATE NULL,
    hora_incidente_fim TIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;