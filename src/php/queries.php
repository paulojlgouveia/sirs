
<?php

// single place for queries
// to avoid having to change several files upon DB update

	require_once($_SERVER['DOCUMENT_ROOT'].'/src/php/config.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/src/php/exceptions.php');

	
// -------------------------------------------------------------------------------------------------
// 	public info
// -------------------------------------------------------------------------------------------------

	function get_login_info($username) {
		
		$pdo = get_new_pdo();
		
		$sql = "SELECT user_id, username, password, level
				FROM user
				WHERE username=?";
				
		$stmt = $pdo->prepare($sql);
		
		if (!($stmt->execute([$username]))) {
			throw new QueryException($sql);
		}	
		
		$pdo = null;
		
		return $stmt->fetch();
	}
	
	
	
	function public_get_new_auctions() {
		
		$pdo = get_new_pdo();
		
		$sql = "SELECT 	user.username,
						open.name, open.image, open.description
				FROM public_open_auctions AS open
				INNER JOIN user ON open.owner_id = user.user_id
				ORDER BY open.start DESC";
				
			
		$stmt = $pdo->prepare($sql);
		if (!($stmt->execute())) {
			throw new QueryException($sql);
		}
		
		$pdo = null;
		
		return $stmt->fetchAll();
	}
	
	
// -------------------------------------------------------------------------------------------------
// 	public info
// -------------------------------------------------------------------------------------------------
	
	function get_new_auctions() {
		
		$pdo = get_new_pdo();
		
		$sql = "SELECT 	user.username,
						open.name, open.image, open.value, open.description
				FROM open_auctions AS open
				INNER JOIN user ON open.owner_id = user.user_id
				ORDER BY open.start DESC";
				
			
		$stmt = $pdo->prepare($sql);
		if (!($stmt->execute())) {
			throw new QueryException($sql);
		}
		
		$pdo = null;
		
		return $stmt->fetchAll();
	}	
	
	
	
	function get_hot_auctions() {
		
		$pdo = get_new_pdo();
				
		$sql = "SELECT 	user.username,
						open.name, open.image, open.value, open.description
				FROM open_auctions AS open
				INNER JOIN user ON open.owner_id = user.user_id
				ORDER BY open.n_bids DESC";
				
				
		$stmt = $pdo->prepare($sql);
		if (!($stmt->execute())) {
			throw new QueryException($sql);
		}
		
		$pdo = null;
		
		return $stmt->fetchAll();
	}
	
// -------------------------------------------------------------------------------------------------
// 	user specific
// -------------------------------------------------------------------------------------------------

	function get_user_queued_auctions($user_id) {
		
		$pdo = get_new_pdo();
		
		$sql = "SELECT 	*
				FROM queued_auctions
				WHERE owner_id = ?
				ORDER BY auction_id DESC";
				
		$stmt = $pdo->prepare($sql);
		if (!($stmt->execute([$user_id]))) {
			throw new QueryException($sql);
		}
		
		$pdo = null;
		
		return $stmt->fetchAll();
	}
	
	
	function get_user_opened_auctions($user_id) {
		
		$pdo = get_new_pdo();
		
		$sql = "SELECT 	*
				FROM open_auctions
				WHERE owner_id = ?
				ORDER BY auction_id DESC";
				
		$stmt = $pdo->prepare($sql);
		if (!($stmt->execute([$user_id]	))) {
			throw new QueryException($sql);
		}
		
		$pdo = null;
		
		return $stmt->fetchAll();
	}
	
	
	function get_user_closed_auctions($user_id) {
		
		$pdo = get_new_pdo();
		
		$sql = "SELECT 	*
				FROM closed_auctions
				WHERE owner_id = ?
				ORDER BY auction_id DESC";
				
		$stmt = $pdo->prepare($sql);
		if (!($stmt->execute([$user_id]	))) {
			throw new QueryException($sql);
		}
		
		$pdo = null;
		
		return $stmt->fetchAll();
	}
	
	
	function get_user_participating_auctions($user_id) {
		
		$pdo = get_new_pdo();
		
		$sql = "SELECT 	*
				FROM queued_auctions
				WHERE owner_id = ?
				ORDER BY auction_id DESC";
				
		$stmt = $pdo->prepare($sql);
		if (!($stmt->execute([$user_id]))) {
			throw new QueryException($sql);
		}
		
		$pdo = null;
		
		return $stmt->fetchAll();
	}
	
	
	
// -------------------------------------------------------------------------------------------------
// 	auction specific
// -------------------------------------------------------------------------------------------------
	
	function get_comments($auction_id) {
		
		$pdo = get_new_pdo();
		
		$sql = "SELECT 	user.username,
						comment.posted, comment.text
				FROM comment
				INNER JOIN user ON comment.author_id = user.user_id
				WHERE auction_id=?
				ORDER BY posted";
				
		$stmt = $pdo->prepare($sql);
		if (!($stmt->execute($auction_id))) {
			throw new QueryException($sql);
		}
		
		$pdo = null;
		
		return $stmt->fetchAll();
	}
	
	
// -------------------------------------------------------------------------------------------------
// 	deprecated, here just for reference
// -------------------------------------------------------------------------------------------------
	
	function get_user_items($user_id) {
		
		$pdo = get_new_pdo();
		
		$sql = "SELECT 	user.username,
						item.name, item.image,
						auction.value, auction.n_bids
				FROM auction
				INNER JOIN item ON auction.auction_id = item.item_id
				INNER JOIN user ON auction.auctioneer = user.user_id
				WHERE auction.start != NULL
				ORDER BY auction.start";
				
		$stmt = $pdo->prepare($sql);
		if (!($stmt->execute())) {
			throw new QueryException($sql);
		}
		
		$pdo = null;
		
		return $stmt->fetchAll();
	}
	
	
	function get_recently_opened_auctions() {
		
		$pdo = get_new_pdo();
		
		$sql = "SELECT 	user.username,
						item.name, item.description, item.image,
						auction.value, auction.n_bids
				FROM auction
				INNER JOIN item ON auction.auction_id = item.item_id
				INNER JOIN user ON auction.auctioneer = user.user_id
				WHERE 
				ORDER BY auction.n_bids";
				
		$stmt = $pdo->prepare($sql);
		if (!($stmt->execute())) {
			throw new QueryException($sql);
		}
		
		$pdo = null;
		
		return $stmt->fetchAll();
	}
	
	
	function get_auctions_quickview() {
		
		$pdo = get_new_pdo();
		
		$sql = "SELECT 	owner.username,
						auction.start,
						item.name, item.image,
						MAX(bid.amount) AS amount, bid.time,
						bidder.username AS high_bidder
						
				FROM auction
				INNER JOIN item ON auction.auction_id = item.item_id
				INNER JOIN user owner ON auction.auctioneer = owner.user_id
				INNER JOIN bid ON bid.auction_id = auction.auction_id
				INNER JOIN user bidder ON bid.user_id = bidder.user_id
				ORDER BY auction.start";
				
		$stmt = $pdo->prepare($sql);
		if (!($stmt->execute())) {
			throw new QueryException($sql);
		}
		
		$pdo = null;
		
		return $stmt->fetchAll();
	}
	
	
?>



