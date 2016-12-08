

DELIMITER ;

-- -----------------------------------------------------------------------------------------
-- public table views
-- -----------------------------------------------------------------------------------------


DROP VIEW IF EXISTS public_open_auctions;
CREATE VIEW public_open_auctions AS (
	SELECT auction.owner_id, auction.name, auction.image, auction.start, auction.description
	FROM auction
	WHERE auction.start IS NOT NULL AND (auction.end IS NULL OR auction.end > CURRENT_TIMESTAMP)
);



-- -----------------------------------------------------------------------------------------
-- user views
-- -----------------------------------------------------------------------------------------

DROP VIEW IF EXISTS queued_auctions;
CREATE VIEW queued_auctions AS (
	SELECT *
	FROM auction
	WHERE auction.start IS NULL
);


DROP VIEW IF EXISTS open_auctions;
CREATE VIEW open_auctions AS (
	SELECT auction.*
	FROM auction
	Left JOIN bid ON auction.auction_id = bid.auction_id
	WHERE auction.start IS NOT NULL AND (auction.end IS NULL OR auction.end > CURRENT_TIMESTAMP)
	GROUP BY auction.auction_id
);


DROP VIEW IF EXISTS closed_auctions;
CREATE VIEW closed_auctions AS (
	SELECT auction.*
	FROM auction
	INNER JOIN bid ON auction.auction_id = bid.auction_id
	WHERE auction.start IS NOT NULL AND (auction.end IS NOT NULL OR auction.end < CURRENT_TIMESTAMP)
	GROUP BY auction.auction_id
);



-- -----------------------------------------------------------------------------------------
-- admin views
-- -----------------------------------------------------------------------------------------

DROP VIEW IF EXISTS logged_in_users;
CREATE VIEW logged_in_users AS (
	SELECT login.user_id, user.username, user.level, login.login
	FROM login
	INNER JOIN user ON login.user_id = user.user_id
	WHERE login.logout IS NULL
);


