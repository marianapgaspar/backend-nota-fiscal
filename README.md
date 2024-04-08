## Backend - Entrada e Consulta de Notas Fiscais

Este repositório contém uma aplicação backend capaz de armazenar e consultar notas fiscais em um banco de dados fictício.

### Rotas

- `/nota-fiscal`: Insere uma nova nota fiscal.
- `/nota-fiscal/{chave}`: Retorna os detalhes de uma nota fiscal específica com a chave fornecida (número com 44 caracteres, único).

### Detalhes Técnicos

- Validação de dados durante a inserção da nota fiscal, incluindo validação dos campos:
  - chave (numérico, mínimo e máximo de 44 caracteres)
  - data_emissao (campo de data)
  - data_recebimento (campo de data)
  - cnpj (numérico, sem máscaras)
- Condição de recebimento: A aplicação valida se a nota fiscal possui CNPJ da Madeira (10490181000569). Caso contrário, a nota não é inserida no sistema, mas um log é registrado na console.

## Setup
Após clonar o projeto, faça uma cópia do .env.example para .env
Esse projeto utilizou o Laravel Sail, então caso você tenha docker instalado, é possível apenas seguir esses passos:

    ./vendor/bin/sail up -d

E então rodar as migrações

    ./vendor/bin/sail php artisan migrate

## Tecnologias Utilizadas

- PHP
- Laravel Framework
