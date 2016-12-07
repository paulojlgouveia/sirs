

DELIMITER ;

SET foreign_key_checks = 0 ;

-- ---------------------------------------------------------------------------------------
-- application tables
-- ---------------------------------------------------------------------------------------

DROP TABLE IF EXISTS user ;
CREATE TABLE user (
	user_id		INT NOT NULL AUTO_INCREMENT,
	username	VARCHAR(255) NOT NULL,
	password	VARCHAR(255) NOT NULL,
	level		INT NOT NULL DEFAULT 1,
	email		VARCHAR(255),

	PRIMARY KEY (user_id)
);


-- different table to keep encripted personal info
-- diferent priveleges on this table
DROP TABLE IF EXISTS personal ;
CREATE TABLE personal (
	user_id		INT NOT NULL,
	name		VARCHAR(255) NOT NULL,
	phone		VARCHAR(255) NOT NULL,
	gender		VARCHAR(255) NOT NULL,
	birthday	DATE NOT NULL,
	cc			VARCHAR(255) NOT NULL,

	PRIMARY KEY (user_id),
	FOREIGN KEY (user_id) REFERENCES user(user_id)
);



DROP TABLE IF EXISTS auction ;
CREATE TABLE auction (
	auction_id	INT NOT NULL AUTO_INCREMENT,
	owner_id	INT NOT NULL,
	name		VARCHAR(255) NOT NULL,
	image		VARCHAR(255),
	base_value	FLOAT DEFAULT 0,
	value		FLOAT DEFAULT 0,
	increment	FLOAT DEFAULT 0.01,
	n_bids		INT NOT NULL DEFAULT 0,
	start		TIMESTAMP NULL,
	end			TIMESTAMP NULL,
	description	VARCHAR(255),
	
	PRIMARY KEY (auction_id),
	FOREIGN KEY (owner_id) REFERENCES user(user_id)
);



DROP TABLE IF EXISTS bid ;
CREATE TABLE bid (
	auction_id	INT NOT NULL,
	user_id		INT NOT NULL,
	amount		FLOAT NOT NULL,
	time		TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

	PRIMARY KEY (user_id, auction_id, amount),
	FOREIGN KEY (user_id) REFERENCES user(user_id),
	FOREIGN KEY (auction_id) REFERENCES auction(auction_id)	
);



DROP TABLE IF EXISTS comment ;
CREATE TABLE comment (
	auction_id	INT NOT NULL,
	author_id	INT NOT NULL,
	posted		TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	text		VARCHAR(500),

	PRIMARY KEY (auction_id, author_id, posted),
	FOREIGN KEY (auction_id) REFERENCES auction(auction_id),
	FOREIGN KEY (author_id) REFERENCES user(user_id)
);



-- ---------------------------------------------------------------------------------------
-- administration tables
-- ---------------------------------------------------------------------------------------

DROP TABLE IF EXISTS login ;
CREATE TABLE login (
	user_id		INT NOT NULL,
	login		TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	logout		TIMESTAMP NULL,
	
	PRIMARY KEY (user_id, login)
);



-- ---------------------------------------------------------------------------------------
-- theoretical tables for testing
-- ---------------------------------------------------------------------------------------

DROP TABLE IF EXISTS bank ;
CREATE TABLE bank (
	cc		VARCHAR(255) NOT NULL,
	balance	FLOAT NOT NULL,

	PRIMARY KEY (cc)
);




SET foreign_key_checks = 1 ;





