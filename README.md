<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

#  Laravel Task Manager – API Backend

Ce projet est une application backend développée avec **Laravel**. Elle permet la gestion de tâches avec deux rôles utilisateurs : `user` et `admin`.

L'API est sécurisée avec **Laravel Sanctum**, testée avec **Postman**, et utilise **MySQL** comme base de données.

---

##  Fonctionnalités

###  Authentification :
- ✅ Inscription (`/register`)
- ✅ Connexion (`/login`) avec token (Sanctum)

###  Gestion des tâches :
- En tant que **utilisateur (`user`)** :
  - Créer une tâche
  - Voir ses propres tâches
  - Modifier/supprimer ses propres tâches

- En tant que **administrateur (`admin`)** :
  - Voir toutes les tâches de tous les utilisateurs
  - Créer une tâche pour n’importe quel utilisateur
  - Modifier/supprimer toutes les tâches

---

## 🛠 Technologies utilisées

- Laravel 10
- PHP 8.4.8
- Laravel Sanctum
- MySQL
- Postman
- Composer

---
## 📄 Documentation complète

La documentation (PDF + captures) est disponible sur Google Drive :

👉 [Accéder à la documentation](https://drive.google.com/file/d/1q5poQhfzsoPzw-c2qlTqr2rIntIqubAf/view?usp=drive_link)

