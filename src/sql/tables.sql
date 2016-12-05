
-- mysql -u root -p
-- ju57 50m3 p455w0rD

use auctionsDB;

SET foreign_key_checks = 0 ;


DROP TABLE IF EXISTS user ;
CREATE TABLE user(
	user_id		INT NOT NULL AUTO_INCREMENT,
	username	VARCHAR(255) NOT NULL,
	password	VARCHAR(255) NOT NULL,
	level		INT NOT NULL DEFAULT 1,
	name		VARCHAR(255) NOT NULL,
	email		VARCHAR(255),
	cc			INT,

	PRIMARY KEY (user_id)
);


DROP TABLE IF EXISTS item ;
CREATE TABLE item(
	item_id		INT NOT NULL AUTO_INCREMENT,
	name		VARCHAR(255) NOT NULL,
	owner_id	INT NOT NULL,
	description	VARCHAR(255),
	image		VARCHAR(255),

	PRIMARY KEY (item_id),
	FOREIGN KEY (owner_id) REFERENCES user(user_id)
);


-- DROP TABLE IF EXISTS auction ;
-- CREATE TABLE auction(
-- 	auction_id	INT NOT NULL,
-- 	open		BOOLEAN NOT NULL DEFAULT FALSE,
-- 	auctioneer	INT NOT NULL,
-- 	base_value	FLOAT NOT NULL,
-- 	value		FLOAT NOT NULL,
-- 	increment	FLOAT NOT NULL DEFAULT 0,
-- 	n_bids		INT NOT NULL DEFAULT 0,
-- 	start		TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
-- 	end			TIMESTAMP DEFAULT NULL,
-- 	
-- 	PRIMARY KEY (auction_id),
-- 	FOREIGN KEY (auctioneer) REFERENCES user(user_id),
-- 	FOREIGN KEY (item_id) REFERENCES item(item_id)
-- );

DROP TABLE IF EXISTS auction ;
CREATE TABLE auction(
	auction_id	INT NOT NULL,
	auctioneer	INT NOT NULL,
	base_value	FLOAT NOT NULL,
	value		FLOAT NOT NULL,
	increment	FLOAT NOT NULL DEFAULT 0,
	n_bids		INT NOT NULL DEFAULT 0,
	start		TIMESTAMP,	-- can use this as open flag ?
	end			TIMESTAMP,
	
	PRIMARY KEY (auction_id),
	FOREIGN KEY (auction_id) REFERENCES item(item_id),
	FOREIGN KEY (auctioneer) REFERENCES user(user_id)
);


DROP TABLE IF EXISTS bid ;
CREATE TABLE bid(
	user_id		INT NOT NULL AUTO_INCREMENT,
	auction_id	INT NOT NULL,
	amount		FLOAT NOT NULL,
	time		TIMESTAMP DEFAULT CURRENT_TIMESTAMP,


	PRIMARY KEY (user_id, auction_id, amount),
	FOREIGN KEY (user_id) REFERENCES user(user_id),
	FOREIGN KEY (auction_id) REFERENCES auction(auction_id)	
);



DROP TABLE IF EXISTS comment ;
CREATE TABLE comment(
	auction_id	INT NOT NULL,
	author_id	INT NOT NULL,
	posted		TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	text		VARCHAR(500),

	PRIMARY KEY (auction_id, author_id, posted),
	FOREIGN KEY (auction_id) REFERENCES auction(auction_id),
	FOREIGN KEY (author_id) REFERENCES user(user_id)
);


SET foreign_key_checks = 1 ;



