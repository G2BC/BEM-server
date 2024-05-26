# BEM-server

Projeto Backend da equipe WebFungi da Universidade do Estado da Bahia (UNEB) visando contribuir para o projeto *Brazilian Edible Mushrooms*.

Time: Pedro Benevides, Rafael Cruz, Uendel Lima, Dêivísson Gomes, Italo Cruz.

# Desenvolvimento

<h2 id="variaveis-ambiente">Variáveis de Ambiente</h2>

| Variável    | Descrição                                     | Valor Padrão |
| ----------- | --------------------------------------------- | ------------ |
| DB_DATABASE | Nome da conexão no banco de dados             | pgsql        |
| DB_HOST     | Endereço do servidor do banco                 |              |
| DB_PORT     | Porta de acesso                               |              |
| DB_DATABASE | Nome da conexão no banco de dados             | bem-server   |
| DB_USERNAME | Usuário de acesso                             |              |
| DB_PASSWORD | Senha de acesso                               |              |

## Models
Documentação para o gerador [Model Generator](https://github.com/reliese/laravel)

# Iniciar Aplicação

## Local
Certifique de possuir [PHP 8.1](https://www.php.net/downloads.php) e [Composer](https://getcomposer.org/download/) e habilitar as dependencias do php 
*   bz2, gd, gettext, exif, pdo_pgsql, grpc, pgsql, zip.

1. Clonar o repositório
2. Acessar o diretório do projeto e executar o comando `composer i`
3. Para instanciar as tabelas do banco de dados `php artisan migrate`
4. Execute o Command para realizar a leitura da planilha base e inserir os registros `php artisan app:register-fungi-occurrences`
5. Inicialize o servidor com o comando `php artisan serve`

## Docker
Certifique de possuir [Docker](https://docs.docker.com/get-docker/) e [Docker Compose](https://docs.docker.com/compose/install/)
1. Clonar o repositório
2. Acessar o diretório do projeto e executar o comando `docker compose up --build`
3. Servidor estará disponivel na URL `http://localhost`
