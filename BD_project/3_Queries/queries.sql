
-- 3.1 Quais os participantes inscritos em leilões mas sem lances até à data?
select "3.1." as exercise;

select distinct pessoa.nome
from pessoa
	inner join concorrente on concorrente.pessoa = pessoa.nif
	left join lance on concorrente.pessoa = lance.pessoa
where lance.pessoa is null
;


-- 3.2 Qual o nome das pessoas coletivas com exatamente duas inscrições em leilões?
select "3.2." as exercise;

select pessoa.nome
from pessoa
	natural join pessoac
	inner join concorrente on pessoa.nif = concorrente.pessoa
group by pessoa.nome
having count(concorrente.leilao) = 2
;



-- 3.3 Qual o leilão com o maior rácio (valor do melhor lance)/(valor base)?
select "3.3." as exercise;


select leilao.nome
from leilao natural join leilaor, lance
where leilaor.lid = lance.leilao
group by lance.leilao
having max(lance.valor/leilao.valorbase) >= all(
												select max(lance.valor/leilao.valorbase)
												from leilao natural join leilaor, lance
												where leilaor.lid = lance.leilao
												group by lance.leilao
											)
;



-- 3.4 Quais as pessoas coletivas com o mesmo capital social?
select "3.4." as exercise;

select p.nome, pc.capitalsocial
from pessoa p, pessoac pc 
where p.nif = pc.nif
group by pc.capitalsocial
;






