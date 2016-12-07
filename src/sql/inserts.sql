
\W

DELIMITER ;

SET foreign_key_checks = 0 ;


TRUNCATE TABLE user;
TRUNCATE TABLE auction;
TRUNCATE TABLE bid;
TRUNCATE TABLE comment;


SET foreign_key_checks = 1 ;


INSERT INTO user (username, password, level, email) VALUES
("admin",'$2y$10$qmQwDsI6bkl.kY9U3FkPzO8FlXSulVvo/4HvWc5nOkWOai4WVFiSq',2,"admin@webserver.com"),
("cartman",'$2y$10$zz5CbYytt66ID2dsbOfRaOwjy0/0taR8ijmUeeYqOE3aEqW0.lr7C',1,"cartman@membersirsproject"),
("kyle",'$2y$10$jzurznC0EfA9ENSh9oaO0utqNYzkwk2Rco5kY/0WFzMoyhIpLiQkC',1,"kyle@membersirsproject"),
("randy",'$2y$10$OFotfId.z3lch/9Rlqqdyep5Ido5WEqcMEyWoFJ1vi8AgA3YdNsi6',1,"kyle@membersirsproject");


INSERT INTO auction (owner_id, name, image,  base_value, increment, start, description) VALUES
(3, 'Stick of Truth', 'stick.jpg', 9000.01, 9000.01, NULL, 
"A twig that possesses limitless power."),

(2, 'Clyde Frog', 'clyde_frog.jpg', NULL, NULL, NULL,
"It was known as the favorite toy."),

(2, 'Faith +1', 'faith_+1.jpg', 12.34, 1.00, CURRENT_TIMESTAMP, 
"Faith + 1 is the self-titled debut album by the Christian rock band of the same name." ),

(4, 'Memberberries', 'memberberries.jpg', 0.00, 0.42, CURRENT_TIMESTAMP, 
"Member when the project was almost finished? Yea, I member!<br> Member when the power went out and we lost the entire project? Yea... I member.");




INSERT INTO bid (auction_id, user_id, amount) VALUES
(4, 2, 3.50),
(4, 1, 42.00);


INSERT INTO comment (auction_id, author_id, text) VALUES
(4, 1, "I learnt my lesson. Always backup because god doesn't like you.");



