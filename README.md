

## Netshow.me - Api vídeos 

Desenvolvimento de uma API RESTful utilizando PHP com framework Laravel para gerenciar os dados dos vídeos. A API oferece os endpoints necessários para obter e atualizar informações dos vídeos.

## Tecnologias utilizadas

- PHP 8+ e o Laravel 11+.
- Composer e Node.js
- Banco de dados Mysql
- API do laravel, routes/api.php.


## Instalação do projeto

Após instalar as ferramentas de tecnologia do projeto, siga alguns passos para instalar e testar a aplicação.

Crie um banco de dados com o nome "netshowme"

Rode o comando de migrate para criar as tabelas: videos, categories e sites.

````
php artisan migrate
````

Rode o seeder para popular as tabelas. Essa rotina irá copiar os dados do arquivo db.json salvo na pasta database/data/ para as tabelas no banco de dados.  

````
php artisan db:seed --class=JsonSeeder
````

Crie o arquivo .env a partir da .env.example. Nele já está configurado os dados de banco e api_url.

 ````
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=netshowme
DB_USERNAME=root
DB_PASSWORD= 
````

Para rodar a aplicação, execute os comandos: 


````
npm run dev
````

e

````
php artisan serve
````

Para verificar se está funcionando acesse as URL´s:

1 - http://127.0.0.1:8000/api/videos

2 - http://127.0.0.1:8000/api/video/22281

A url 1. irá retornar a lista de videos em json cadastrados no banco

A url 2. irá retornar um registro pelo id = 22281


## Testes automatizados

Para rodar os testes automatizados execute o comando
````
php artisan test
````

- Os testes de Controllers estão em tests/Feature/Controller/VideosControllerTest.php

- Os testes de Services estão em tests/Unit/Services/VideoServiceTest.php


## Informações adicionais

Esta aplicação tem como objetivo desenvolver uma API REST FULL, utilizando os reqursos do laravel como: Eloquent, Injeção de Dependência com Services, Repositories, Resources, Requests, além Seeder, Factory e Testes unitários.



###### ---


Desenvolvido por Andreia Mazucato.

#### Obrigada! :-)

 