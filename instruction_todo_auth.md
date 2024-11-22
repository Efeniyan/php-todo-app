### INSTRUCTIONS - AUTHENTIFICATION
---

### **Étape 1 : Adapter ou créer la base de données**
1. **Vérifiez votre base de données existante** et assurez-vous qu'une table `users` est présente pour gérer les informations d'authentification. Si elle n'existe pas, créez une table avec des colonnes pour l’identifiant, le nom d'utilisateur, l'email, le mot de passe (haché) et la date de création. L'email et le nom d'utilisateur doivent être unique(pas de doublon).
   
2. **Ajoutez une relation entre l'utilisateur et les to-dos** en modifiant la table `todos` (ou une table similaire). Ajoutez une colonne `user_id` pour associer chaque tâche à un utilisateur via une clé étrangère. 

**C'est quoi une clé étrangère** 
Une clé étrangère c'est un lien entre deux tables dans une base de données. Elle sert à relier une ligne d'une table à une autre ligne d'une autre table.

Imagine deux tableaux :
- Le premier tableau **"Utilisateurs"** contient des informations sur chaque utilisateur (comme leur nom et leur ID).
- Le deuxième tableau **"Tâches"** contient des tâches à accomplir (comme "Faire les courses", "Terminer le projet").

Une clé étrangère est un identifiant (généralement l'ID) dans la table "Tâches" qui fait référence à l'ID de l'utilisateur dans la table "Utilisateurs". Cela permet de savoir quelle tâche appartient à quel utilisateur.

En résumé :
- Une **clé primaire** identifie une ligne dans une table (comme l'ID de l'utilisateur).
- Une **clé étrangère** pointe vers cette clé primaire dans une autre table pour établir une relation.

Par exemple :
- Table **Utilisateurs** : `ID = 1`, `Nom = Alice`
- Table **Tâches** : `ID = 101`, `Tâche = "Faire les courses"`, **User_ID (clé étrangère) = 1** (qui correspond à Alice)

Ainsi, la tâche "Faire les courses" est liée à Alice via la clé étrangère.

---

### **Étape 2 : Créer les pages d'inscription et de connexion**
1. **Créez une page `register.php`** avec un formulaire HTML qui permet aux utilisateurs de saisir un nom d'utilisateur, une adresse email et un mot de passe.
   
2. **Créez une page `login.php`** avec un formulaire qui permet aux utilisateurs de se connecter en saisissant leur adresse e-mail et leur mot de passe.

---

### **Étape 3 : Implémenter les fonctionnalités d'inscription et de connexion**
1. **Inscription des utilisateurs**  
   Lorsque le formulaire d'inscription est soumis, récupérez les données, validez-les, hachez le mot de passe, et enregistrez l'utilisateur dans la table `users` de votre base de données. Lorsqu'un utilisateur s'inscrit avec un mail ou un nom d'utilisateur existant, envoyez un message convenable.
   
2. **Connexion des utilisateurs** 
    L'utilisateur pourra se connecter avec son email ou son nom d'utilisateur.
   À la soumission du formulaire de connexion, vérifiez si l'e-mail ou le nom d'utilisateur existe dans la base de données, puis comparer le mot de passe saisi avec le mot de passe haché. Si la connexion est valide, **démarrez une session PHP**  pour l'utilisateur.

---

### **Étape 4 : Protéger les pages sensibles avec la session**
1. **Ajoutez une vérification de session** sur les pages importantes (comme la page de to-do list). Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion.
   
2.  **Affichez les to-dos de l'utilisateur connecté** uniquement. Lors de la récupération des tâches, filtrez par l'ID de l'utilisateur connecté pour afficher les tâches qui lui sont associées.

---

### **Étape 5 : Implémenter la déconnexion**
1. **Ajoutez un bouton de déconnexion** qui détruit la session active lorsque l'utilisateur clique dessus, puis redirigez-le vers la page de connexion.

---

### **Étape 6 : Renforcer la sécurité de l’application**
1. **Validez les entrées utilisateur** sur chaque formulaire pour éviter les injections SQL et les attaques XSS.
   
2. **Gérez les sessions de manière sécurisée** en régénérant l'ID de session après la connexion (`session_regenerate_id()`) pour éviter le vol de session.

         -- En bonus --
3. **Ajoutez une protection CSRF** (Cross-Site Request Forgery) sur les formulaires sensibles en utilisant des tokens CSRF pour éviter les soumissions de formulaires malveillantes.

---
