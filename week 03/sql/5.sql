SELECT bands.name AS "Band Name" FROM bands LEFT JOIN albums ON bands.id=albums.band_id where albums.name is null;
