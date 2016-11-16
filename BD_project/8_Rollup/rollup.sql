

-- exercise 8 --

select a.town, extract(year from t.day) as year, extract(month from t.day) as month, sum(b.bid) as sum
from bids b, time t, address a
where b.time_id = t.time_id and b.address_id = a.address_id
group by a.town, extract(year from t.day), extract(month from t.day) with rollup
having year = 2012 | year = 2013
;


