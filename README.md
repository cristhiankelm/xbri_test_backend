# Ecommerce para Venda de Pneus

Este projeto é um sistema de ecommerce para a venda de pneus, desenvolvido usando Laravel 11 para o backend e Next.js para o frontend. O sistema inclui funcionalidades para o cadastro de clientes, e dashboard.

Contem dados fake em categorias, produtos, pedidos, itens do pedido e pagamentos.

## Funcionalidades

- Cadastro de clientes
- Cadastro de categorias de produtos
- Cadastro de produtos
- Criação de pedidos
- Adição de itens aos pedidos
- Processamento de pagamentos
- Dashboard para gerenciamento do ecommerce

## Tecnologias Utilizadas

- Laravel 11
- PgSQL

## Requisitos

- PHP >= 8.2
- Composer
- PgSQL

## Passo a Passo para Rodar o Projeto em Ambiente de Desenvolvimento

### 1. Clonar o Repositório

```bash
git clone https://github.com/cristhiankelm/xbri_test_backend.git
cd xbri_test_backend
```

### 2. Instalar as Dependências do Backend

```bash
composer install
```

### 3. Configurar o Arquivo `.env`

Crie uma cópia do arquivo `.env.example` e renomeie para `.env`. Configure as variáveis de ambiente conforme necessário, especialmente as configurações do banco de dados.

```plaintext
DB_CONNECTION=pgsql
DB_HOST=pgsql
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

### 4. Instalar as Dependências do Sail

https://laravel.com/docs/11.x/sail#installing-sail-into-existing-applications

### 5. Iniciar o Servidor de Desenvolvimento

```bash
sail up -d
```

### 6. Gerar a Chave da Aplicação

```bash
sail artisan key:generate
```

### 7. Rodar as Migrations e Seeders

```bash
sail artisan migrate --seed
```

### 8. Acessar o Projeto

Abra o navegador e acesse `http://localhost:8000`.

## Seeds

O projeto já inclui um usuário administrador criado pelo seeder. Você pode usar as credenciais abaixo para acessar o sistema:

- **Email:** admin@xbri.com
- **Senha:** password

## Estrutura do Banco de Dados

As tabelas principais do banco de dados são:

- users (admins do sistema)
- clients
- categories
- products
- orders
- order_items
- payments

## Links úteis
link draw.io -> https://drive.google.com/file/d/1QJpx4sDfYC4f-mmqDLouVbWVHJIJ3tOj/view?usp=sharing

link postman -> https://drive.google.com/file/d/1js2I5XGaGCwfUx30Zovsf8jHU6y8_ca_/view?usp=sharing

Para garantir que o sistema retorne os controles de erro corretamente nas requisições feitas pelo Postman, adicione o seguinte cabeçalho (header) às suas requisições:
```bash
Accept: application/json
```
