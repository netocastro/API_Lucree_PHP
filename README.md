

# Desafio Backend

Essa API RESTfull foi construida no intuito de mostrar meu conhecimento na construção em programação em PHP.

Para execução dessa API em localhost, é necessario:

- Preferencialmente instalar do XAMPP Version: 7.4.21 ou superior(versões para php 7) 
- MySQL
- Dentro da pasta database está o script SQL pronto pra alimentar o banco de dados.
- Acessar a src/Core , e no arquivo Config PHP configurar as informações do seu banco de dados.



Ao instalar o XAMPP clonar o repositorio dentro da pasta htdocs.



# Usuários (person)

### GET `/account/persons` 
Esse método retorna todos os usuarios registrados.

### GET `/account/person/{id}` 
Esse método retorna todos um usuário específico atraves do id.

### POST `/account/person` 
Esse método deve receber um novo usuário e o insere no banco de dados para ser consumido pela própria API.

### PUT `/account/person/{id}` 
Esse método atualiza um usuário específico baseado no seu ID.

### DELETE `/account/person/{id}` 
Esse método deleta um usuário específico baseado no seu ID.








### GET `/account/friends`
Esse método da API deve retornar o seguinte JSON com os amigos do usuário
```json
[
  {
   "first_name":"João",
   "last_name": "das Neves",
   "birthday": "1991-09-91",
   "username": "joao_das_neves",
   "user_id": "70c881d4a26984ddce795f6f71817c9cf4480e79"
  },
  {
   "first_name":"João",
   "last_name": "das Neves",
   "birthday": "1991-09-91",
   "username": "joao_das_neves",
   "user_id": "70c881d4a26984ddce795f6f71817c9cf4480e79"
  },
  {
   "first_name":"João",
   "last_name": "das Neves",
   "birthday": "1991-09-91",
   "username": "joao_das_neves",
   "user_id": "70c881d4a26984ddce795f6f71817c9cf4480e79"
  }
]
```

| Campo       | Tipo   |
|-------------|--------|
| first_name  | String |
| last_name   | String |
| birthday    | String |
| username    | String |

### POST `/account/card`
Esse método deve receber um cartão novo e inseri-lo em um banco de dados para ser consumido pela própria API.
```json
{
   "card_id": "70c881d4a26984ddce795f6f71817c9cf4480e79"
   "title": "Cartão 1",
   "pan": "5527952393064634",
   "expiry_mm": "03",
   "expiry_yyyy": "2022",
   "security_code": "656",
   "date":"26/11/2015"
}
```
| Campo       | Tipo   |
|-------------|--------|
| title       | String |
| pan         | String |
| expiry_mm   | String |
| expiry_yyy  | String |
| security_code | String |
| date        | String |


### GET `/account/cards`
Esse método da API deve retornar o seguinte JSON com os cartões cadastrados pelo usuário
```json
[
  {
    "title":"Cartão 1",
    "pan": "5527952393064634",
    "expiry_mm": "03",
    "expiry_yyyy": "2022",
    "security_code": "656",
    "date":"26/11/2015"
  },
  {
     "title":"Cartão 2",
     "pan": "5527952393064634",
     "expiry_mm": "03",
     "expiry_yyyy": "2022",
     "security_code": "656",
     "date":"26/11/2015"
  },
  {
     "title":"Cartão 2",
     "pan": "5527952393064634",
     "expiry_mm": "03",
     "expiry_yyyy": "2022",
     "security_code": "656",
     "date":"26/11/2015"
  }
]
```

| Campo       | Tipo   |
|-------------|--------|
| title       | String |
| pan         | String |
| expiry_mm   | String |
| expiry_yyy  | String |
| security_code | String |
| date        | String |



Após o usuário adicionar todos os cartões e localizar seus amigos, ele poderá realizar uma transferência.
Para isso, você precisará fazer o método `transfer` na sua API.

### POST `/account/transfer`
Esse método irá receber os dados da compra, junto com os dados do usuário.
```json
{
   "friend_id": "70c881d4a26984ddce795f6f71817c9cf4480e79",
   "total_to_transfer": 100,
   "billing_card": {
      "card_id": "70c881d4a26984ddce795f6f71817c9cf4480e79"
   }
}

```

+ Transfer

| Campo        | Tipo       |
|--------------|------------|
| friend_id    | String     |
| total_to_pay | int (in cents)|
| billing_card  | CreditCard |

+ BillingCard

| Campo            | Tipo   |
|------------------|--------|
| card_id          | String |


### GET `/account/bank-statement`
Esse método deve retornar todas as transferencias realizadas entre os amigos na API
```json
[
   {
      "user_id":"70c881d4a26984ddce795f6f71817c9cf4480e79",
      "friend_id":"70c881d4a26984ddce795f6f71817c9cf4480e79",
      "value":1234,
      "date":"19/08/2016",
      "from_card":"70c881d4a26984ddce795f6f71817c9cf4480e79"
   },
   {
      "user_id":"70c881d4a26984ddce795f6f71817c9cf4480e79",
      "friend_id":"70c881d4a26984ddce795f6f71817c9cf4480e79",
      "value":1234,
      "date":"19/08/2016",
      "from_card":"70c881d4a26984ddce795f6f71817c9cf4480e79"
   },
   {
      "user_id":"70c881d4a26984ddce795f6f71817c9cf4480e79",
      "friend_id":"70c881d4a26984ddce795f6f71817c9cf4480e79",
      "value":1234,
      "date":"19/08/2016",
      "from_card":"70c881d4a26984ddce795f6f71817c9cf4480e79"
   },
]
```
| Campo            | Tipo   |
|------------------|--------|
| user_id          | String |
| friend_id        | String |
| value            | int (in cents)    |
| date             | String |
| from_card        | String |

### GET `/account/bank-statement/{usertId}`
Esse método deve retornar todos as transferencias realizadas na API por um usuário específico
```json
[
   {
      "user_id":"70c881d4a26984ddce795f6f71817c9cf4480e79",
      "friend_id":"70c881d4a26984ddce795f6f71817c9cf4480e79",
      "value":1234,
      "date":"19/08/2016",
      "from_card":"70c881d4a26984ddce795f6f71817c9cf4480e79"
   },
   {
      "user_id":"70c881d4a26984ddce795f6f71817c9cf4480e79",
      "friend_id":"70c881d4a26984ddce795f6f71817c9cf4480e79",
      "value":1234,
      "date":"19/08/2016",
      "from_card":"70c881d4a26984ddce795f6f71817c9cf4480e79"
   },
]
```




---
#### LICENSE
```
MIT License

Copyright (c) 2020 Lucree Soluções Inteligentes.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```


