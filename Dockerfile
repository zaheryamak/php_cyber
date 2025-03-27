# Utilisation d'une image PHP avec Apache
FROM php:8.1-apache

# Installer les extensions nécessaires
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Copier les fichiers du projet dans le conteneur
COPY . /var/www/html/

# Exposer le port 80
EXPOSE 80
