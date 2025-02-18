# Documentação do Projeto

## Configuração do Ambiente

Siga os passos abaixo para configurar e executar o projeto corretamente:

### 1. Clonar o Repositório

### 2. Instalar Dependências

Execute os seguintes comandos para instalar as dependências do projeto:

```sh
composer install
npm install
```

### 3. Configurar o Banco de Dados

Execute as migrações para criar as tabelas no banco de dados:
```sh
php artisan migrate
```

Popule o banco de dados com dados iniciais:
```sh
php artisan db:seed --class=UserSeeder
```

### 4. Iniciar o Servidor

Para iniciar o servidor, utilize o seguinte comando:
```sh
php artisan serve
```
O projeto estará rodando no endereço `http://127.0.0.1:8000`.

---

## Testes de API

### 1. Importar a Coleção no Postman

Abra o Postman e importe a coleção de requisições que foi anexada ao e-mail.

### 2. Autenticação

A rota de login é a única que pode ser acessada sem autenticação. Para realizar o login, utilize a seguinte requisição:

**URL:** `http://127.0.0.1:8000/api/login`

**Método:** `POST`

**Body (JSON):**
```json
{
    "email": "admin@example.com",
    "password": "password"
}
```

Se a autenticação for bem-sucedida, você receberá um token de acesso Bearer.

### 3. Acessar Outras Rotas

Após obter o token, configure a autenticação Bearer no Postman para acessar as demais rotas.

### 4. Testar Rotas de `POST` e `PUT`

As rotas de `POST` e `PUT` já possuem os dados de entrada esperados configurados no **body raw** da requisição. Basta executá-las para testar.

### 5. Testar as Rotas dos CRUDs e das Atividades

As demais rotas dos CRUDs e das atividades já estão configuradas para teste. Basta utilizar o Postman para fazer requisições e validar os endpoints.

Se houver dúvidas, entre em contato via e-mail.

