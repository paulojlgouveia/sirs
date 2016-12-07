
-- mysql -u root -p
-- ju57 50m3 p455w0rD


\W

use auctionsDB;



-----------------------------------------------------------------------------------------
-- tables
-----------------------------------------------------------------------------------------

SET foreign_key_checks = 0 ;


DROP TABLE IF EXISTS user ;
CREATE TABLE user(
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
CREATE TABLE personal(
	user_id		INT NOT NULL,
	name		VARCHAR(255) NOT NULL,
	cc			VARCHAR(255) NOT NULL,

	PRIMARY KEY (user_id),
	FOREIGN KEY (user_id) REFERENCES user(user_id)
);



DROP TABLE IF EXISTS auction ;
CREATE TABLE auction(
	auction_id	INT NOT NULL AUTO_INCREMENT,
	owner_id	INT NOT NULL,
	name		VARCHAR(255) NOT NULL,
	image		VARCHAR(255),
	base_value	FLOAT,
	increment	FLOAT,
	n_bids		INT NOT NULL DEFAULT 0,
	start		TIMESTAMP NULL,
	end			TIMESTAMP NULL,
	description	VARCHAR(255),
	
	PRIMARY KEY (auction_id),
	FOREIGN KEY (owner_id) REFERENCES user(user_id)
);



DROP TABLE IF EXISTS bid ;
CREATE TABLE bid(
	auction_id	INT NOT NULL,
	user_id		INT NOT NULL,
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



-----------------------------------------------------------------------------------------
-- table views
-----------------------------------------------------------------------------------------

DROP VIEW IF EXISTS queued_auctions;
CREATE VIEW queued_auctions AS (
	SELECT *
	FROM auction
	WHERE auction.start IS NULL
);


DROP VIEW IF EXISTS open_auctions;
CREATE VIEW open_auctions AS (
	SELECT *
	FROM auction
	WHERE auction.start IS NOT NULL AND (auction.end IS NULL OR auction.end > CURRENT_TIMESTAMP)
);


DROP VIEW IF EXISTS closed_auctions;
CREATE VIEW closed_auctions AS (
	SELECT *
	FROM auction
	WHERE auction.start IS NOT NULL AND (auction.end IS NULL OR auction.end < CURRENT_TIMESTAMP)
);



-----------------------------------------------------------------------------------------
-- triggers
-----------------------------------------------------------------------------------------







