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
Certifique de possuir [PHP 8.1](https://www.php.net/downloads.php) E [Composer](https://getcomposer.org/download/)
1. Clonar o repositório
2. Acessar o diretório da aplicação e executar o comando `composer i`
3. Inicialize a aplicação com o comando `php artisan serve`
4. Para instanciar as tabelas do banco de dados `php artisan migrate`
5. Execute o Command para realizar a leitura da planilha base e inserir os registros `php artisan app:register-fungi-occurrences`
