-- SQLite
select count(*) as numero_vendas from tb_vendas WHERE data_venda between '2020-12-01' and '2020-12-31';

-- para retornar clientes ativos ATIVO = 1 ou INATIVO = 0
select count(*) as ativo from tb_clientes where cliente_ativo = 1;

-- para contar os elogio=3 reclamação=1 e sugestão=2
select count(*) as tipo from tb_contatos where tipo_contato = 0;