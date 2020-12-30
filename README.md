# Covoit
Site de covoiturage réalisé en php

***
## Préambule

Lors du module M3104, intitulé Programmation Web coté serveur, j’ai appris le langage php. Plusieurs TP sur des séances de 2 à 4 heures ainsi que quelques heures de travail personnel entre les séances ont permis de réaliser ce projet.

***
## Contexte

Pour ce projet, il fallait réaliser une plateforme de covoiturage et donc créer une nouvelle personne, lister les personnes déjà existantes ou encore modifier ou supprimer une personne. Il faudrait pouvoir aussi ajouter ou lister les parcours ou les villes. Une personne inscrite pourrait se connecter et ainsi pouvoir proposer ou rechercher un trajet. Pour réaliser ce projet, la base de données nous était fournie. Les consignes du projet son disponible [ici](https://gitlab.com/MiCha/covoit)

***
## Travail réalisé

***

#### La première page réalisée est la page d'accueil : 

<img align="center" src="https://zupimages.net/up/20/53/fuy4.png">

Sur cette page, il y a le header, le bouton qui permet d'accéder à la connexion, le menu qui amène aux différentes fonctionnalités du site internet ainsi que le footer. Le menu est réalisé de façon à ce que certaine fonctionnalité ne soit accessible qu'une fois connecté. 

***

#### Déjà, la réalisation des fonctionnalités en rapport avec les villes : 

La page d'ajout d'une ville a été créée. Pour cela deux affichages, le premier qui demande à l'utilisateur de saisir la ville et le deuxième qui confirme si la ville a été ajoutée à la base de données ou non. 

<img align="center" src="https://zupimages.net/up/20/53/u4ai.png">

<img align="center" src="https://zupimages.net/up/20/53/3kek.png">

***

La page permettant d'afficher la liste des villes a été réalisée par la suite. Ici, le numéro de chacune des villes ainsi que leur nom sont affichés, de plus on affiche aussi le nombre total de ville enregistrée. 

<img align="center" src="https://zupimages.net/up/20/53/sp8o.png">

***

#### Ensuite les fonctionnalités en rapport avec les parcours : 

La page d'ajout d'un parcours a été réalisée. Encore une fois deux affichages, l'un pour saisir le parcours et l'autre pour confirmer l'ajout du parcours dans la base de données. Pour l'ajout du parcours, il faut saisir la ville 1 et la ville 2 grâce à une liste défilante qui affiche toutes les villes présentes dans la base de données. L'utilisateur doit ensuite saisir le nombre de kilomètres. 

<img align="center" src="https://zupimages.net/up/20/53/7st9.png">

Une fois le parcours ajouté à la base de données le deuxième affichage apparaît. 

<img align="center" src="https://zupimages.net/up/20/53/mxn9.png">

***

La page permettant d'afficher la liste des parcours a été réalisé par la suite. On trouve Ici, le numéro du parcours, le nom de chacune des villes et le nombre de kilomètre qui les sépare. Le nombre de parcours enregistrés est également affiché. 

<img align="center" src="https://zupimages.net/up/20/53/l1n9.png">

***

#### Puis les fonctionnalités en rapport avec les personnes : 

La page d'ajout d'une personne a été réalisée avec plusieurs affichages dont un pour saisir les informations relatives à une personne. Dans cet affichage l'utilisateur doit choisir entre étudiant et personnel. Le deuxième affichage se fait en fonction de la réponse. 

<img align="center" src="https://zupimages.net/up/20/53/jwrx.png">

Si l'utilisateur choisit « étudiant », c'est cette page qui s'affiche : 

<img align="center" src="https://zupimages.net/up/20/53/nnc5.png">

Par la suite, un message de validation de l'ajout est affiché, comme pour tous les autres ajouts du projet. 

Si l'utilisateur choisit « personnel », c'est cette page qui s'affiche : 

<img align="center" src="https://zupimages.net/up/20/53/918d.png">

Par la suite, un message de validation de l'ajout est affiché, comme pour tous les autres ajouts du projet. 

***

La page permettant d'afficher la liste des personnes a ensuite été réalisée. Ici, le numéro de chaque personne, ainsi que son nom et son prénom s'affichent ainsi que le nombre de personnes enregistrées. 

<img align="center" src="https://zupimages.net/up/20/53/go0n.png">

Enfin, si l'on souhaite connaitre plus d'informations sur une personne, il suffit de cliquer sur son numéro. Par exemple pour un étudiant voilà ce qui s'affiche : 

<img align="center" src="https://zupimages.net/up/20/53/c6vp.png">

Exemple pour un salarié : 

<img align="center" src="https://zupimages.net/up/20/53/o16s.png">

***

La page suivante permet de supprimer une personne. Pour cela la liste des personnes s'affiche, lorsque l'on clique sur supprimer, la personne ainsi que tous ses trajets et ses avis sont supprimés de la base de données et un message de validation s'affiche. 

<img align="center" src="https://zupimages.net/up/20/53/6ai8.png">

<img align="center" src="https://zupimages.net/up/20/53/azbo.png">

Par exemple ici, nous avons supprimé « test2 », si on ré affiche la liste des personnes, on voit qu'il n'apparait plus. 

<img align="center" src="https://zupimages.net/up/20/53/9j63.png">

***

Enfin, la page permettant de modifier les informations relatives à une personne. Pour cela la liste des personnes s'affiche, lorsque l'on clique sur modifier, l'utilisateur à la possibilité de modifier plusieurs champs.  

<img align="center" src="https://zupimages.net/up/20/53/odva.png">

<img align="center" src="https://zupimages.net/up/20/53/zl03.png">

***

#### Enfin, la connexion :

Par la suite, la page de connexion, Sur celle-ci l’utilisateur devra remplir son login et son mot de passe. De plus un Captcha à été réalisé, celui-ci affiche deux nombres au hasard, l’utilisateur doit entrer la somme des deux nombres afficher pour pouvoir se connecter. 

<img align="center" src="https://zupimages.net/up/20/53/f9y3.png">

Une fois connecté, le bouton de connexion change. Il permet de se déconnecter et affiche le login de l’utilisateur connecté.

<img align="center" src="https://zupimages.net/up/20/53/t0oh.png">

De plus, le menu affiche deux fonctionnalités en plus : 

<img align="center" src="https://zupimages.net/up/20/53/se24.png">

***

#### Pour finir, les fonctionnalités en rapport avec les trajet : 

Pour cette partie, deux partie ont été réalisé, la première permettant de proposer un trajet et l'autre permettant de rechercher un trajet. 

Ces fonctionnalités sont accessible seulement si l'utilisateur est connecté, dans le cas ou l'utilisteur essaierait s'acéder à la page par l'URL, sans être connecté,  un message s'affiche sur la page : 

<img align="center" src="https://zupimages.net/up/20/53/mwod.png">

Pour la première, il y a trois affichages, le premier demande à l'utilisateur de saisir la ville de départ.

<img align="center" src="https://zupimages.net/up/20/53/3f9o.png">

Le deuxième demande à l'utilisateur la ville d'arrivé, l'heure de départ, le jours de départ, le nombre de place. Ici l'utilisateur doit choisir la ville d'arrivé en fonction des parcours possible avec la ville de départ. De plus l'heure est vérifié et la date est à saisir sur un calandrié. Le nombre de places ne peut pas être inféieure ou égal à zéro. 

<img align="center" src="https://zupimages.net/up/20/53/odch.png">

Ensuite, un message de validation est affiché. 

<img align="center" src="https://zupimages.net/up/20/53/u8sn.png">

***

La deuxième fonctionnalité permet de rechercher un trajet. pour cela, encore trois affichage ont été réalisé, le premier permet à l'utilisateur de choisir la ville de départ du trajet. 

<img align="center" src="https://zupimages.net/up/20/53/0kpl.png">

Le deuxième affichage permet de choisir la ville d'arrivé, en fonction des parcours possible et des proposition faites. L'utilisateur doit également saisir le jour de départ, il peut choisir une précision, soit le jour même soità 1,2 ou 3 jour d'écart. Il doit également saisir à partir de quel heure il souhaite partir. 

<img align="center" src="https://zupimages.net/up/20/53/jo26.png">

Enfin, le dernier affichage est celui qui affiche les résultats de la recherche : 

<img align="center" src="https://zupimages.net/up/20/53/frtc.png">

De plus, lorsque l'utilisateur passe la sourie sur le nom du covoitureur, la moyenne des avis donné est affiché ainsi que le dernier avis laissé à cette personne. 



