# android-example-videoclub-server

Exemple minimum de WebServices pour le cas d'utilisation VideoClub

#initialisation


```shell
git clone https://github.com/afpa-mx2016/phpsilex-videoclub-api
cd phpsilex-videoclub-api
composer install
```

Créer la base de donnée `video` et importer le script de définition `res/video.sql`
Configurer l'url de connection dans le fichier `web/index.php`


#démarrage
`php -S 0.0.0.0:8080 -t web web/index.php`

#test des Web services
 - Hello world:
 `curl http://localhost:8080/`

 - Obtenir la liste des types de film
 `curl http://localhost:8080/typefilm/`

 - Obtenir la liste des films
 `curl http://localhost:8080/films/`

 - Obtenir le detail du film ayant l'identifiant `7854552`
 `curl http://localhost:8080/films/7854552`
