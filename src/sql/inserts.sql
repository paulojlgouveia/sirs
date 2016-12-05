
DELIMITER ;

SET foreign_key_checks = 0 ;


TRUNCATE TABLE user;
TRUNCATE TABLE item;
TRUNCATE TABLE auction;


SET foreign_key_checks = 1 ;


INSERT INTO user (username,password,level,name,email) VALUES
("admin",SHA2("admin",256),2,"administrator","admin@webserver.com"),
("guest",SHA2("guest",256),0,"guest user","guest@webserver.com");


INSERT INTO item (ProductName, owner_id, Price, description, Image) VALUES ('Derpina McDerp', 2, 257.76,'Just your average Derpina.','derpina.jpg');INSERT INTO item (ProductName, owner_id, Price, description, Image) VALUES ('Derp McDerp', 2, 137.76,'Just your average Derp.','avatar_default.jpg');