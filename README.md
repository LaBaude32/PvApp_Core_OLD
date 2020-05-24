# PvApp_Core

Ce repository est le serveur API de l'application PvApp.
C'est une API construite en PHP avec Slim Framwork https://www.slimframework.com/

# Pour faire fonctionner ce serveur localement :

Telechargez le repo git, vous y trouverez un fichier SQL à importer dans votre base de donnée **pv_app_core_database**

Ensuite, allez dans le fichier **.env** et paramettrez votre mot de passe d'accès à la BDD

Placez-vous enfin dans le votre dossier et lancez la commande : **php -S localhost:8080 -t /public**

Vous pouvez desormais lancer le client web localement. 

*Il est important de lancer ce client web après l'API car le client web se met sur le port 8080 s'il est disponible, sinon sur le 8081. Il faut donc commencer par le serveur pour ne pas créer de conflits.*
