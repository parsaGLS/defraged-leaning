SELECT albums.name AS 'Albuml' , albums.release_year AS 'Release Year' , MAX(songs.length) AS 'Duration' FROM albums JOIN songs ON albums.id=songs.album_id GROUP BY albums.id
