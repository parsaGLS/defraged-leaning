UPDATE albums SET release_year = 1986 WHERE id IN (SELECT id from albums WHERE release_year IS NULL);