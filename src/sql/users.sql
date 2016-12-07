
-- -----------------------------------------------------------------------------------------
-- users and priveleges
-- -----------------------------------------------------------------------------------------

DELIMITER ;

REVOKE ALL PRIVILEGES ON *.* FROM 'admin'@'localhost';
REVOKE ALL PRIVILEGES ON *.* FROM 'user'@'localhost';
REVOKE ALL PRIVILEGES ON *.* FROM 'general'@'localhost';



DROP USER 'admin'@'localhost';
DROP USER 'user'@'localhost';
DROP USER 'general'@'localhost';

CREATE USER 'admin'@'localhost'		IDENTIFIED BY '5up3r D1ff1cul7 4dm1n P455w0rd';
CREATE USER 'user'@'localhost'		IDENTIFIED BY '1 4m ju57 4 C0mm0n U53r P3454n7';
CREATE USER 'general'@'localhost'	IDENTIFIED BY 'N07 r34Lly 4 h4Rd P4$$w0rd 70 6u355';



GRANT ALL PRIVILEGES ON auctionsDB.* TO 'admin'@'localhost';



GRANT ALL PRIVILEGES ON auctionsDB.auction TO 'user'@'localhost';
GRANT ALL PRIVILEGES ON auctionsDB.bank TO 'user'@'localhost';
GRANT ALL PRIVILEGES ON auctionsDB.bid TO 'user'@'localhost';
GRANT ALL PRIVILEGES ON auctionsDB.comment TO 'user'@'localhost';
GRANT ALL PRIVILEGES ON auctionsDB.personal TO 'user'@'localhost';
GRANT ALL PRIVILEGES ON auctionsDB.user TO 'user'@'localhost';

GRANT ALL PRIVILEGES ON auctionsDB.public_open_auctions TO 'user'@'localhost';
GRANT ALL PRIVILEGES ON auctionsDB.queued_auctions TO 'user'@'localhost';
GRANT ALL PRIVILEGES ON auctionsDB.closed_auctions TO 'user'@'localhost';
GRANT ALL PRIVILEGES ON auctionsDB.open_auctions TO 'user'@'localhost';



GRANT SELECT ON auctionsDB.user TO 'general'@'localhost';
GRANT SELECT ON auctionsDB.auction TO 'general'@'localhost';
GRANT SELECT ON auctionsDB.public_open_auctions TO 'general'@'localhost';



FLUSH PRIVILEGES;




-- -----------------------------------------------------------------------------------------------

-- -- ignore -- --
-- -- just a query to find right permissions for user user
-- SELECT CONCAT("GRANT ALL PRIVILEGES ON auctionsDB.", table_name, " TO 'user'@'localhost';")
-- FROM information_schema.TABLES
-- WHERE table_schema = "auctionsDB" AND table_name <> "login";

-- GRANT ALL PRIVILEGES ON auctionsDB.* TO 'user'@'localhost';
-- FLUSH PRIVILEGES; -- ugly hack to avoid hundreds of lines
-- REVOKE ALL PRIVILEGES ON auctionsDB.login FROM 'user'@'localhost';

