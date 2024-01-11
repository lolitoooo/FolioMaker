# Bienvenue à FolioMaker
FolioMaker est un site web dédié à la création de portfolios. <br>
Notre plateforme a pour objectif de simplifier et d'enrichir l'expérience de conception de portfolios personnels, professionnels et artistiques. <br>
Que vous soyez un artiste, un designer, un photographe, un développeur ou tout autre professionnel cherchant à présenter votre travail de manière efficace, FolioMaker est là pour vous aider. <br>

## Fonctionnalités Clés
* **Création Intuitive de Portfolios** : Notre interface conviviale vous permet de concevoir votre portfolio en quelques étapes simples. Glissez-déposez des éléments, téléchargez des fichiers, et personnalisez le style pour refléter votre identité.
* **Personnalisation Avancée** : Vous avez un contrôle complet sur l'apparence de votre portfolio. Choisissez parmi une variété de modèles et d'options de personnalisation pour créer un portfolio unique.
* **Hébergement de Portfolios** : FolioMaker propose des options d'hébergement pour garantir que vos portfolios soient accessibles en ligne. Partagez facilement vos réalisations avec le monde entier.
* **Intégration de Médias** : Importez des images, des vidéos, des liens vers des projets GitHub et bien plus encore. Montrez votre travail de la manière qui vous convient le mieux.

## Commencez Dès Maintenant
FolioMaker vous donne les outils nécessaires pour présenter votre créativité et vos compétences de la meilleure façon possible. <br>
Créez votre portfolio dès aujourd'hui et partagez votre histoire avec le monde. <br>
Pour commencer, visitez notre site web **ici** et suivez les instructions pour créer votre compte et votre premier portfolio. <br>

## Contributeurs

| Nom | Prénom | Pseudo |
|:----|:-------|:-------|
| PENA | Loan | lolitoooo |
| SANCTIFIÉ | Bre | Monsieur9bre99 |
| RATIARAY | Lucas | LucasRatiaray |
| ALLAIN | Maheanuu | Menztel |

# Architecture des Branches Git pour le Projet GitHub

## 1. Introduction

Ce document décrit l'architecture des branches Git pour notre projet sur GitHub. L'objectif est de maintenir un flux de travail cohérent et efficace qui facilite la collaboration entre les membres de l'équipe et permet un déploiement en douceur.

## 2. Branches Principales

Il y a trois branches principales dans ce projet :

1. **Main** : Cette branche contient le code qui est actuellement en production. Tout ce qui est dans cette branche est déployé.

2. **Develop** : Cette branche est le lieu de développement actif et contient les dernières fonctionnalités et améliorations qui seront incluses dans le prochain déploiement.


## 3. Branches de Développement

La branche **dev** est utilisée pour le développement quotidien et les expérimentations.

L'architecture des branches ressemble à ceci :

- **main**

- **develop**


## 4. Flux de Travail

Voici le flux de travail typique :

1. Les développeurs travaillent sur la branche **dev**, créant des commits pour chaque modification significative.


## 5. Structure des Commits

Pour maintenir une trace claire et lisible des modifications, nous utilisons une structure spécifique pour nos messages de commit. Chaque commit appartient à l'une des sept catégories suivantes :

- **feat** : Une nouvelle fonctionnalité
- **refactor** : Une modification du code qui n'ajoute pas de fonctionnalité ni n'en corrige
- **fix** : Une correction de bug
- **bug** : Signale un bug que vous n'arrivez pas à corriger
- **clean** : Nettoyage du code
- **doc** : Des modifications liées à la documentation


Le nommage des commits doit suivre ce format : `catégorie: description de la modification`. La description doit être concise et ne pas dépasser 50 caractères. Par exemple, un commit pourrait être nommé `feat: ajout de la fonctionnalité de tri`.

Cela permet à toute personne qui regarde l'historique des commits de comprendre rapidement ce qu'un commit particulier fait sans avoir à regarder le code lui-même. 
