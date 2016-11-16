drop trigger if exists t_update_lance;

delimiter //

create trigger t_update_lance before update on lance
for each row
begin
	select max(valor)
	from lance
	where leilao = new.leilao
	into @min;
	
	if new.valor <= @min then
		set new.valor = @min + 1;
	end if;
end//

delimiter ;
