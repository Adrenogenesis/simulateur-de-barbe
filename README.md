# simulateur-de-barbe
		Description de l’application “ Simulateur de barbe”



La structure du simulateur de barbe est basé sur la fonctionnalité Webcam de l’ordinateur.

L’installation se fait par l'intermédiaire d’un fichier “install.php”, qui détermine dans un premier temps les identifiants de l’administrateur, et dans une second temps une base de données est créée, comportant les éléments de base de la sélection des barbes.

L’administrateur doit s’identifier, pour pouvoir mettre à jour sa base de donnée, en envoyant de nouveaux éléments sur un formulaire.

L’utilisateur accède librement sur l’interface, avec l’activation de sa webcam par un popup. Une fenêtre fait apparaître le flux vidéo, aide par un repère, celui-ci est incité à prendre une capture, qui se place automatique à droite de la fenêtre.
A l’aide d’un sélecteur, présentant les images de barbe comptabilisées dans la base de donnée, l’utilisateur choisit ainsi une barbe pour la glisser à l’aide de la souris vers la capture ainsi effectuée précédemment.

L’utilisateur positionne le modèle de barbe choisi sur la capture, pour obtenir une simulation en direct. La possibilité de refaire cette manipulation est réalisée par un rafraîchissement de la page à l’aide d’un bouton.

Pour une protection de base efficace, le système de licence intégrant la session administration ne permet pas la configuration et le gestion de l’application par un client ( admin) non identifié, il doit être en possession d’un ou des numéros de série, pour le déblocage de l’installation, qui n’est possible qu’une fois.


![alt text](https://info.exonet3i.com/directweb/simulateur-barbe.png)

Documentation :

[a link](http://expsylon.tk/simulator.html)

BRODAR Frederic



