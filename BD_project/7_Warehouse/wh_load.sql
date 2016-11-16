
-- inserts by loading from other tables --

delimiter ;

set foreign_key_checks = 0 ;

truncate table time;
truncate table address;
truncate table bids;

set foreign_key_checks = 1 ;



-- time inserts
lock tables time write, leilaor read;

insert into time(time_id, day)
	select lid, dia
	from leilaor
;

unlock tables;



-- address inserts
lock tables address write, leilaor as lr read, leiloeira as la read;

insert into address(address_id, town, region)
	select lr.lid, la.concelho, la.regiao
	from leilaor lr, leiloeira la
	where lr.nif = la.nif
;

unlock tables;



-- bids inserts
lock tables bids write, leilaor as lr read, lance as lc read, time read, address read;

insert into bids(time_id, address_id, lid, bid)
	select lr.lid, lr.lid, lr.lid, max(lc.valor)
	from leilaor lr left join lance lc on lr.lid = lc.leilao
	group by lr.lid
;

unlock tables;






































