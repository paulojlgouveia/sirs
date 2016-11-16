
-- trigger para que o valor mínimo de um lance num leilão seja o valor base desse leilão.

drop trigger if exists t_insert_lance;

delimiter //

create trigger t_insert_lance before insert on lance
for each row
begin
	select max(valor)
	from lance
	where leilao = new.leilao
	into @min;

	if(@min is NULL) then
		select valorbase
		from leilao natural join leilaor
		where lid = new.leilao
		into @min;
	else
		set @min = @min + 1;
	end if;
	
	if new.valor <= @min then
		set new.valor = @min;
	end if;
end//

delimiter ;
