#Se precisa buildar o container novamente, uma vez buildado acesse o container 
e então rode os seguintes comandos para instalar o composer:

#Instala dependências
apt-get update && apt-get install -y git curl zip unzip
#Instala dependência para sockets
docker-php-ext-install sockets
#Instala o composer
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer