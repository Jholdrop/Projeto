CREATE TABLE pagamentos (
    id SERIAL PRIMARY KEY,
    usuario_id INTEGER NOT NULL,
    plano_id INTEGER NOT NULL,
    valor NUMERIC (10,2) NOT NULL,
    data_pagamento DATE,
    data_vencimento DATE NOT NULL,
    status varchar(20) DEFAULT 'Pendente',
FOREIGN KEY (usuario_id) REFERENCES usuarios (id),
FOREIGN KEY (plano_id) REFERENCES planos (id)
)

CREATE TABLE acessos(
 id SERIAL PRIMARY KEY,
 usuario_id INTEGER NOT NULL,
 data_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 status_acesso Varchar(20) DEFAULT 'liberado',
 FOREIGN KEY (usuario_id) REFERENCES usuarios (id)
)

CREATE TABLE bloqueados(
id SERIAL PRIMARY KEY,
usuario_id INTEGER NOT NULL,
data_bloqueio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
status varchar(20) DEFAULT 'ativo',
motivo varchar(255) NOT NULL,
FOREIGN KEY (usuario_id) REFERENCES usuarios (id)
)