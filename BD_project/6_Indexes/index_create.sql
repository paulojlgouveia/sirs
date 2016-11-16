

-- for 3.3.

create index valorbase_idx on leilao(valorbase);

create index leilao_idx on lance(leilao);
create index valor_idx on lance(valor);

/*
embora ‘leilao’ e ‘valor’ façam parte da primary key (pessoa, leilão, valor) que é por default indexada,
na query 3.3. nao é usado esse índice pois nenhuma das condições envolve o elemento mais a esquerda
ou uma combinação dos três
*/

-- for 3.4.

create index capitalsocial_idx on pessoac(capitalsocial);


