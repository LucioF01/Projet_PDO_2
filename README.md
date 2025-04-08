  Pour une meilleur visualisation du code il est conseillé de connecté le code à une base de donnée avec au minimum 2 utilisateurs et 3 taches.
Toute le partie /recherhe et bonus est en option est n'est pas utile à la bonne compréhension du code, ce ne sont que des pistes de recherche pour 
nous permettre d'observer ce que le code pourrait être si un "admin" controlait la page et pouvait gerer au la base de donnée depuis le site lui même.
En tant qu'admin on pourrait donc affecter des taches à des utilisateurs comme un professeur avec ses élèves et même ajouter de nouveau utilisateur, de nouvelle tache.
gestion_tache 
  admin (id,email,mot_de_passe)
  taches (id,utilisateur_id,titre,description,date_limite,statut)
  utilisateurs (nom,prenom,email,mot_de_passe);
seule "<button type="submit" class="btn btn-sm btn-secondary">Mettre à jour</button>" de index.php n'a pas été abouti car on peut à la place modifier le statut dans modifier.php
elle fait partie des pistes de recherche qu'il me reste à développer et ameliorer.

le css/bootstrap ainsi que les annotations on été réalisé à l'aide d'une IA mais n'affecte par la compréhension du code, simple l'amélioration de UX.
