

# Desafio Backend

Essa API RESTfull foi construida no intuito de mostrar meu conhecimento na construção em programação em PHP.

Para execução dessa API em localhost, é necessario:

- Preferencialmente instalar do XAMPP Version: 7.4.21 ou superior(versões para php 7) 
- MySQL
- Dentro da pasta database está o script SQL pronto pra alimentar o banco de dados.
- Acessar a src/Core , e no arquivo Config PHP configurar as informações do seu banco de dados.



Ao instalar o XAMPP clonar o repositorio dentro da pasta htdocs.



# Users (person)

### GET `/account/persons` 
Esse método retorna todos os usuários registrados.

### GET `/account/person/{id}` 
Esse método retorna um usuário específico através do id.

### POST `/account/person` 
Esse método deve receber um novo usuário e o insere no banco de dados para ser consumido pela própria API.

### PUT `/account/person/{id}` 
Esse método atualiza um usuário específico baseado no seu ID.

### DELETE `/account/person/{id}` 
Esse método deleta um usuário específico baseado no seu ID.


# Cards

### GET `/account/cards` 
Esse método retorna todos os cartão registrados.

### GET `/account/card/{id}` 
Esse método retorna um cartão específico através do id.

### POST `/account/card` 
Esse método deve receber um novo cartão e o insere no banco de dados para ser consumido pela própria API.

### PUT `/account/card/{id}` 
Esse método atualiza um cartão específico baseado no seu ID.

### DELETE `/account/card/{id}` 
Esse método deleta um cartão específico baseado no seu ID.


# Friends

### GET `/account/friends` 
Esse método retorna todos os usuários que possuem amigos registrados.

### GET `/account/friend/{id}` 
Esse método retorna a lista de amigos de um usuário específico através do id.

### POST `/account/friend` 
Esse método deve receber dois usuários e os cadastra como amigos.

### PUT `/account/friend/{id}` 
Esse método atualiza um arelação de amizade entre dois clientes através do id.

### DELETE `/account/friend/{id}` 
Esse método deleta um vinculode amizade entre usuários através do id.


# Transfers

### GET `/account/transfers` 
Esse método retorna todas as transferências registradas.

### GET `/account/transfer/{id}` 
Esse método retorna uam transferência específica através do id.

### POST `/account/transfer` 
Esse método registra uma transferência no banco e dados.

### PUT `/account/transfer/{id}` 
Esse método atualiza informações sobre uma determinada transferências através do id.

### DELETE `/account/transfer/{id}` 
Esse método deleta uma determinada transferência através do id.


# Bank-statement

### GET `/account/bank-statements` 
Esse método retorna todos os extratos bancários registradas.

### GET `/account/bank-statement/{id}` 
Esse método retorna o extrato bancário de um unico usuário registrado através do id.

### POST `/account/bank-statement` 
Esse método registra um novo extrato bancário.

### PUT `/account/bank-statement/{id}` 
Esse método atualiza informações sobre um determinado extrato bancário através do id.

### DELETE `/account/bank-statement/{id}` 
Esse método deleta um determinado extrato bancário através do id.
