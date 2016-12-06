
DELIMITER ;

SET foreign_key_checks = 0 ;


TRUNCATE TABLE user;
TRUNCATE TABLE item;
TRUNCATE TABLE auction;


SET foreign_key_checks = 1 ;


INSERT INTO user (username, password, level, email) VALUES
("guest",'$2y$10$HAM5JPdIP/OY0I0bTvLeFO8i6WGok4lqoSqrZsUY.l3/G2TKfu/Jy',0,"guest@webserver.com"),
("admin",'$2y$10$qmQwDsI6bkl.kY9U3FkPzO8FlXSulVvo/4HvWc5nOkWOai4WVFiSq',2,"admin@webserver.com"),
("cartman",'$2y$10$zz5CbYytt66ID2dsbOfRaOwjy0/0taR8ijmUeeYqOE3aEqW0.lr7C',1,"cartman@membersirsproject"),
("kyle",'$2y$10$jzurznC0EfA9ENSh9oaO0utqNYzkwk2Rco5kY/0WFzMoyhIpLiQkC',1,"kyle@membersirsproject"),
("randy",'$2y$10$OFotfId.z3lch/9Rlqqdyep5Ido5WEqcMEyWoFJ1vi8AgA3YdNsi6',1,"kyle@membersirsproject");


INSERT INTO item (name, owner_id, description, image) VALUES
('Stick of Truth', 4, "A twig that possesses limitless power.", 'stick.jpg'),
('Clyde Frog', 3, "It was known as the favorite toy.", 'clyde_frog.jpg'),
('Faith +1', 3, "Faith + 1 is the self-titled debut album by the Christian rock band of the same name.", 'faith_+1.jpg'),
('Memberberries', 5, "Member when the project was almost finished? Yea, I member...", 'memberberies.jpg');


INSERT INTO auction (auction_id, auctioneer, base_value, increment, start) VALUES
(4, 5, 0.00, 0.42, CURRENT_TIMESTAMP),
(1, 4, 9000.01, 9000.01, NULL),
(3, 3, 12.34, 1.00, CURRENT_TIMESTAMP);


INSERT INTO bid (auction_id, user_id, amount) VALUES
(4, 3, 3.50),
(4, 2, 42.00);


INSERT INTO comment (auction_id, author_id, text) VALUES
(4, 2, "I learnt my lesson. Always backup because god doesn't like you.");



