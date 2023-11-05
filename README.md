# Projeto Laravel README

    Este é um projeto Laravel criado com a versão PHP 8.2.

# Pré-requisitos

 - [Docker] (para ambiente Docker)

 - [PHP 8.2] (para ambiente local)

 - [Composer]

 - [MySQL]

# Configuração Inicial

 - Clone este repositório para o seu ambiente local: git clone https://github.com/WylderM/jiu-jitsu-master.git


# Configuração local - Windows
    0 - Renomear o arquivo .env.local para .env

    1 - Abra o projeto na raiz e execute: composer install

    2 - Após instalar as dependências execute o comando: php artisan migrate --seed

    3 - E por último execute o comando: php artisan serve

    4 - Abra em: http://localhost:8000

    
# Configuração Docker - Windows

    0 - Renomear o arquivo ..env.docker.local para .env

    1 - Em sua máquina suba o projeto usando o comando(esse comando irá buildar caso seja a primeira instalação): docker-compose up

    2 - execute o comando de configuração: docker run --name some-mysql -e MYSQL_ROOT_HOST=% -e MYSQL_ROOT_PASSWORD=my-secret-pw -d mysql:latest 

    3 - Para iniciar as migrations e seeds execute o comando: 
        docker exec -it jiu-jitsu-master-backend-app-1 php artisan migrate --seed
    
    4 - Abra em: http://localhost:8000

# USUÁRIO PADRÃO: 
    user: root@email.com
    pass: 123456
