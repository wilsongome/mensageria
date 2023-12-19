#Se precisa buildar o container novamente, uma vez buildado acesse o container 
e então rode os seguintes comandos para instalar o composer:

#Instala dependências
apt-get update && apt-get install -y git curl zip unzip
#Instala dependência para sockets
docker-php-ext-install sockets
#Instala o composer
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer



APÓS OS SERVIÇOS ESTAREM EM EXECUÇÃO:

Executar os arquivos utlizando "php NOME_ARQUIVO.php"

1) Executar o arquivo set_dlq.php
Ele vai criar a fila DLQ para receber as mensagens com erro

2) Executar os arquivos pub_*.php (faturas, pagamentos, etc)
Estes vão começar a publicar as mensagens em suas respectivas filas

3) Executar o arquivo sub.php passando como parâmetro o nome da fila que quer consumir, Ex: php sub.php queue.faturas