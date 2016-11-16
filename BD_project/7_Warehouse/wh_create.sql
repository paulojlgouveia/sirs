 
-- create tables for warehouse --

DELIMITER ;

-- deactivate foreign key checks
set foreign_key_checks = 0 ;



-- time dimension
drop table if exists time;
create table time(
	time_id int not null,
	day		date,
	
	PRIMARY KEY (time_id)
);


-- adress dimension
DROP TABLE IF EXISTS address;
CREATE TABLE address(
	address_id	int not null,
	town 		VARCHAR (80) default null,
	region 		VARCHAR (80) default null,
	
	PRIMARY KEY (address_id)
);


-- facts table
DROP TABLE IF EXISTS bids ;
CREATE TABLE bids(
	time_id 	int not null,
	address_id	int not null,
	lid			int not null,
	
	bid			int not null default '0',

	PRIMARY KEY (time_id, address_id, lid),
	FOREIGN KEY (time_id)  REFERENCES time(time_id),
	FOREIGN KEY (address_id)  REFERENCES address(address_id),
	FOREIGN KEY (lid)  REFERENCES leilaor(lid)
	
);



-- activate foreign key checks
SET foreign_key_checks = 1 ;




