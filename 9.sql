-- Seguindo o MER foi criado o seginte esquema logico de banco de dados
-- o banco de dados fisico pode ser encontrado no arquivo db.db
-- uma imagem com as cardinalidades estão pensentes em 9_cardinalidade.png

CREATE TABLE actors (
    id INTEGER  PRIMARY KEY AUTOINCREMENT, 
    name VARCHAR(255) NOT NULL
);

CREATE TABLE movies(
    id INTEGER  PRIMARY KEY AUTOINCREMENT, 
    title VARCHAR(55) NOT NULL,
    year DATE NOT NULL
);


CREATE TABLE movie_director(
    movie_id INTEGER NOT NULL,
    actor_id INTEGER NOT NULL,
    CONSTRAINT FK_MOVIE_ID_DIRECTOR FOREIGN KEY (movie_id)
        REFERENCES movies (id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT FK_ACTOR_ID_DIRECTOR FOREIGN KEY (actor_id)
        REFERENCES actors (id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE movie_actors(
    movie_id INTEGER NOT NULL,
    actor_id INTEGER NOT NULL,
    order_act INTEGER NOT NULL,
    CONSTRAINT FK_MOVIE_ID_ACTOR FOREIGN KEY (movie_id)
        REFERENCES movies (id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    CONSTRAINT FK_ACTOR_ID_ACT FOREIGN KEY (actor_id)
        REFERENCES actors (id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);


SELECT actors.name 
    FROM actors 
    INNER JOIN movie_actors ON movie_actors.actor_id = actors.id
    INNER JOIN movies ON movies.id = movie_actors.movie_id
    WHERE movies.title = "XYZ";

SELECT movies.title 
    FROM movies 
    INNER JOIN movie_actors ON movie_actors.movie_id = movies.id
    INNER JOIN actors ON actors.id = movie_actors.actor_id
    WHERE actors.name = "FULANO";

SELECT movies.title , COUNT(movie_actors.actor_id) as qActors
    FROM movies 
    INNER JOIN movie_actors ON movie_actors.movie_id = movies.id
    WHERE movies.year BETWEEN "20150101" AND "20151231"
    GROUP BY movies.title 
    ORDER BY movies.title ASC,qActors DESC


SELECT actors.name 
    FROM actors 
    INNER JOIN movie_actors ON movie_actors.actor_id = actors.id
    INNER JOIN movie_director ON movie_actors.movie_id = movie_director.movie_id
    INNER JOIN actors as director ON director.id = movie_director.actor_id
    WHERE director.name = "SPIELBERG";