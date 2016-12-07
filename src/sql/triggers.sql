
-- -----------------------------------------------------------------------------------------
-- triggers
-- -----------------------------------------------------------------------------------------


DELIMITER //


CREATE TRIGGER trig_count_bids
AFTER INSERT ON bid
FOR EACH ROW
BEGIN

	UPDATE auction
	SET n_bids = n_bids + 1
	WHERE auction_id = NEW.auction_id;

END;


CREATE TRIGGER trig_max_bids
AFTER INSERT ON bid
FOR EACH ROW
BEGIN

	UPDATE auction
	SET value = NEW.amount
	WHERE auction_id = NEW.auction_id;
	
END;
//





DELIMITER ;




