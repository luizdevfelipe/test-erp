# Use a imagem base do PHP com o Apache
FROM php:8.1-apache

# Copia o conteúdo do diretório atual (incluindo subdiretórios) para o diretório de trabalho no container
COPY ../ /var/www/html/

# Atualiza o sistema e instala as dependências necessárias
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    curl \
    vim \
    libicu-dev \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Garante o functionamento do PDO com MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Ajusta permissões se necessário
RUN chown -R www-data:www-data /var/www/html/ \
    && chmod -R 755 /var/www/html/
    
# Exponha a porta 80 para acessar o servidor web
EXPOSE 80

# Inicia o Apache quando o container for iniciado
CMD ["apache2-foreground"]