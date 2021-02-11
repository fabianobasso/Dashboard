-- SQLite
-- Criando as tabelas nescessarias
CREATE TABLE tb_vendas(
    id integer not null primary key AUTOINCREMENT,
    data_venda datatime DEFAULT CURRENT_TIMESTAMP,
    total float(10,2) not null
);

CREATE TABLE tb_clientes(
    id integer not null primary key autoincrement,
    cliente_ativo boolean default true
);

CREATE TABLE tb_contatos(
    id integer not null primary key autoincrement,
    tipo_contato integer not null
);

CREATE TABLE tb_despesas(
    id integer not null primary key autoincrement,
    data_despesa datetime default current_timestamp,
    total float(10,2) not null
);

-- Populando tabela vendas
insert into tb_vendas(data_venda, total)values('2020-11-15', 150.20);
insert into tb_vendas(data_venda, total)values('2020-11-16', 255.36);
insert into tb_vendas(data_venda, total)values('2020-11-18', 70.95);
insert into tb_vendas(data_venda, total)values('2020-12-01', 35.00);
insert into tb_vendas(data_venda, total)values('2020-12-11', 2047.12);
insert into tb_vendas(data_venda, total)values('2020-12-19', 122.85);
insert into tb_vendas(data_venda, total)values('2020-12-23', 957.14);
insert into tb_vendas(data_venda, total)values('2021-01-01', 333.55);
insert into tb_vendas(data_venda, total)values('2021-01-02', 100.33);
insert into tb_vendas(data_venda, total)values('2021-01-03', 1853.12);
insert into tb_vendas(data_venda, total)values('2021-01-04', 47.47);

-- Populando tabela despesas
insert into tb_despesas(data_despesa, total)values('2020-11-20', 93.47);
insert into tb_despesas(data_despesa, total)values('2020-12-01', 350.27);
insert into tb_despesas(data_despesa, total)values('2020-12-04', 108.12);
insert into tb_despesas(data_despesa, total)values('2020-12-20', 15.66);
insert into tb_despesas(data_despesa, total)values('2021-01-03', 83.55);


-- true/1 = ativo | false/0 = inativo
insert into tb_clientes(cliente_ativo)values(true);
insert into tb_clientes(cliente_ativo)values(true);
insert into tb_clientes(cliente_ativo)values(true);
insert into tb_clientes(cliente_ativo)values(false);
insert into tb_clientes(cliente_ativo)values(true);
insert into tb_clientes(cliente_ativo)values(true);
insert into tb_clientes(cliente_ativo)values(true);
insert into tb_clientes(cliente_ativo)values(true);
insert into tb_clientes(cliente_ativo)values(true);
insert into tb_clientes(cliente_ativo)values(false);
insert into tb_clientes(cliente_ativo)values(false);
insert into tb_clientes(cliente_ativo)values(true);
insert into tb_clientes(cliente_ativo)values(true);
insert into tb_clientes(cliente_ativo)values(false);
insert into tb_clientes(cliente_ativo)values(true);

-- 1 = crítica | 2 = sugestão | 3 = elogio
insert into tb_contatos(tipo_contato)values(1);
insert into tb_contatos(tipo_contato)values(1);
insert into tb_contatos(tipo_contato)values(2);
insert into tb_contatos(tipo_contato)values(1);
insert into tb_contatos(tipo_contato)values(3);
insert into tb_contatos(tipo_contato)values(2);
insert into tb_contatos(tipo_contato)values(1);
insert into tb_contatos(tipo_contato)values(1);
insert into tb_contatos(tipo_contato)values(3);
insert into tb_contatos(tipo_contato)values(3);
insert into tb_contatos(tipo_contato)values(3);
insert into tb_contatos(tipo_contato)values(1);
insert into tb_contatos(tipo_contato)values(2);
insert into tb_contatos(tipo_contato)values(2);
insert into tb_contatos(tipo_contato)values(1);

COMMIT;
