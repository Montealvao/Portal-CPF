# Configuração do Projeto

Siga os passos abaixo para configurar e executar o projeto localmente.

## 1. Instalar as dependências

Atualize e instale as dependências do projeto:

```bash
composer update
```

## 2. Configurar o arquivo `.env`

Copie o arquivo de exemplo, caso ainda não exista:

```bash
cp .env.example .env
```

### Banco de dados

Antes de prosseguir, crie um banco de dados com o seguinte nome:

```text
portal-cpf
```

Em seguida, configure as variáveis de ambiente no arquivo `.env`:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=portal-cpf
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

## 3. Gerar a chave da aplicação

Execute o comando abaixo para gerar a chave da aplicação:

```bash
php artisan key:generate
```

## 4. Executar as migrations

Crie as tabelas do banco de dados:

```bash
php artisan migrate
```

## 5. Popular o banco de dados

Execute os seeders para inserir os dados iniciais:

```bash
php artisan db:seed
```

> Caso prefira, é possível executar as migrations e os seeders em um único comando:

```bash
php artisan migrate --seed
```