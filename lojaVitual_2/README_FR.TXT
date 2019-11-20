/* outdated */

Installation - test version
----------------------------

C'EST la cinquième release de phpwebthings, pour le moment 
l'installation se fait par une manipulation manuel. J'espere 
que dans la prochaine version quelques etapes de l'installation
soit accessible par le navigateur.

Un grand nombre de changements ont été éffectué depuis la version
0.4, et les mise a jours ne seront pas evidentes mais pas impossibles ;)
Je vais devoir mettre a jour phpdbform.com phpdbform.com.br et un
grand nombre d'autres que j'administre.

Cette nouvelle version a de nombreuses caractèristiques:
-----------------------------------------------
-Nouvelles: Maintenant elles sont en catégories, et il est facile 
de lié directement sur la liste des catégories.
-Utilisateurs: Un nouveaux formulaire d'inscription avec de nombreux
nouveau champs. Un esprit "looking good card" lorsque vous clicker sur
le lien de l'utilisateur. Un carnet d'adresse plus complet, et pour le
future plus de statistiques.
-Modulation: Chaques partie du site sont des modules, choisier en different
ou crée en de nouveaux , c'est plus simple que jamais !
-Téléchargements:courte description, longue description, petite photo, 
copie d'écran ..
-Salons de discussions: Michel Weimerskirch developpe un attrayant salon de discussion.
-PostgreSQL: phpwebthings fonctionnera sur cette database.
-photo du jour:choisisez une image a afficher pour la journée. Un album photo
y est inclus  avec commentaires pour chaques images;
-FAQ: est de retour;
-Bannieres: de même;

Le salon de discutions n'est pas encore prêt. Mais il serat bientôt de retour.
Après cette release je libererai une version stable eavec les bugs fixes et 
un salon de discution complet.

INSTALLATION:
-------------

Comencez par décomprésser (unzip ou untar) le fichier vers le répertoire de 
votre choix, créer une base de données sur votre serveur sql et executez 
le scripts webthings_mysql.php 
sur le serveur. Editez wt_config.php pour convenir a vos besoins.

Choisisez le language au debut du fichier, laissez seulement un chemin de language
non commenté.(Anglais par default).

Titre c'est le titre de votre site, ce qui vas apparaître dans le titre de la fenêtre du
navigateur et dans les email envoyer par le site. URL du site est très important
il serat utilisé par le email envoyer au nouvaux utilisateurs pour qu'ils puissent activer leurs
comptes.Name_admin et email_admin sont utilisés par l'email envoyé a l'utilisateur.

La configuration de la base de données doivent coordonées de la base de données 
que vous avez créé, et votre utilisateur/mot de passe doit avoir le droit d'inserer,
effacer et mettre a jour les tables de votre base de données phpwebthings.

Vous pouvez choisir un thème, simple ou black ou vous pouvez en créer vos thèmes! Jeter un oeil 
dans le repertoire themes pour savoir comment les themes sont créés.

Le thème templ01 est utilisé par phpdbform, vous pouvez le modifier si vous désirez changer
l'apparence de la partie d'administration.

La partie menu du fichier de configuration liste tout les liens qui apparaîtrons sur la boîte 
principale de gauche.

Maintenant vous pouvez démarer votre site . Il y a dejà un utilisateur d'inséré dans phpwebthings, 
c'est "admin" avec le mots de passe "123", s'il vous plait changez le dès que vous pourrez. 
C'est simple, logez et allez sur Mon compte et changer le mot de passe vous pouvez également y changez
le nom de l'admin.

Les classes d'utilisateurs sont les suivantes:

0 - Normal UserUtilisateur classique
1 - post_news : L'utilisateur peut déposer des nouvelles sans modérateur
2 - post_faq : L'utilisateur peut déposer des FAQ sans modérateur
4 - banner : L'utilisateur peut inserer de nouvelles banières
8 - superuser : L'utilisateur a tout les droit sur le site.

Vous pouvez addittionner les valeurs pour ajouter des droits a un utilisateur 
( le superutilisateur a tout les droits).
Par example un utilisateru peut déposer des nouvelles il serat de classe 3.

Lorsque vous avez le droit de faire quelque chose une boîte administrative s'ajoute sur votre gauche.

Tout les textes sont stocké dans le repertoire lang, vous pouvez les éditer pour changer le texte a
ce que vous désirez, faîte attention a l'utilisation de %s et %d utilisédans ces fichiers.

Cette application peu contenir des erreures ou des bugs, soyer libre de me les envoyer!

J'espere que vous appréciez utiliser phpwebthings comme j'apprecie de le créer!

Si vous desirez nous aider, rejoignez notre équipe! Il est indispensable de maitriser CVS.



Paulo Assis
paulo@phpdbform.com
http://www.phpdbform.com

Traduit par

Titou
titou@lutinwood.org
http://www.lutinwood.org
