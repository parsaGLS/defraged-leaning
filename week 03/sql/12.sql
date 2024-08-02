SELECT bands.name AS 'Band', COUNT(songs.id) AS 'Number of Songs' FROM bands join albums on albums.band_id=bands.id join songs on songs.album_id=albums.id GROUP BY bands.id
