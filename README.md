# simulateur-de-barbe
Projet realise pour l'entreprise Direct Webmaster : créateur de site internet. ( Stage en entreprise )


La structure du simulateur de barbe est basé sur la fonctionnalité Webcam, cette application doit être intégré à un site internet, de deux manières :

L’une, en application “standalone” sur un site quelconque, par l’intermédiaire d’un “iframe” , “include” ou modal.

L’autre, en plugin Wordpress en activant éventuellement un système de licence.

L’installation se fait par l'intermédiaire d’un fichier “install.php”, qui détermine dans un premier temps les identifiants de l’administrateur, et dans une second temps une base de données est créée, comportant les éléments de base de la sélection des barbes.

L’administrateur doit s’identifier, pour pouvoir mettre à jour sa base de donnée, en envoyant de nouveaux éléments sur un formulaire.

L’utilisateur accède librement sur l’interface, ou l’activation de sa webcam est activée par un popup. Une fenêtre fait apparaître le flux vidéo, celui-ci est incité à prendre une capture, qui se place automatique à droite de la fenêtre.
A l’aide d’un sélecteur, présentant les images de barbe comptabilisées dans la base de donnée, l’utilisateur choisit ainsi une barbe pour la glisser à l’aide de la souris vers la capture ainsi effectuée précédemment.

L’utilisateur peut mettre en place dimensionnellement le modèle choisi sur la capture, et obtenir une simulation en direct. La possibilité de refaire cette manipulation est réalisée par un rafraichissement de la page à l’aide d’un bouton.

Pour une protection de base efficace, le système de licence intégrant la session administration ne permet pas la configuration et le gestion de l’application par un client ( admin) non identifié, il doit être en possession d’un ou des numeros de serie, pour le déblocage de l’installation.

BRODAR Frederic



