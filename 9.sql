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




/*

-- SQLite
INSERT INTO actors (name)
VALUES ("SPIELBERG"),("FULANO"),("CICLANO"),("BELTRANO"),("MARIA"),("JOAO")
,("PEDRO"),("JOSE"),("MADALENA"),("ANTONIA"),("JOAQUINA"),("MAZE");


INSERT INTO movies (title, year)
VALUES ("ATTACk ON TITAN","20150301"),("CORACAO DO MAR","20150601"),("PERDIDO EM MARTE","20150401"),
("FERIAS FRUSTADAS","20150101"),("HACKER","20150201"),
("LAGOA AZUL","19920501"),("CLICK","20070301"),
("SENHOR DOS ANEIS","20100602"),("NAUFRAGO","19980604"),("JURASSIC PARK","20000102"),
("CIDADE DE DEUS","20110504");


INSERT INTO movie_actors (movie_id,actor_id, order_act)
values (1,7,1),(1,4,2),
(2,6,1),(2,8,2),(2,11,3),
(3,1,1),(3,2,2),(3,3,3),(3,6,4),(3,8,5),
(4,9,1),(4,5,2),
(5,1,1),(5,2,2),(5,6,3),(5,8,4),
(6,1,1),(6,8,2),(6,11,3),
(7,7,1),(7,4,2),
(8,6,1),(8,8,2),(8,11,3),
(9,1,1),(9,2,2),(9,3,3),(9,6,4),(9,8,5),
(10,9,1),(10,5,2),
(11,1,1),(11,2,2),(11,6,3),(11,8,4)


INSERT INTO movie_director (movie_id,actor_id)
values (1,7),
(2,2),
(3,9),(3,4),
(4,6),
(5,12),
(6,5);

*/


delete  from movie_actors


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