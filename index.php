<?php



use Source\Models\BankStatements;
use Stonks\Router\Router;

require_once __DIR__ . "/vendor/autoload.php";

$route = new Router(BASE_PATH);

$route->group(null);

$route->get('/', function () {
    /*  echo "<h1>Home</h1>";
      echo "<pre>";
      print_r($route);
      echo "</pre>";*/
});

$route->get('/teste', function () {
      echo "<h1>Teste</h1>";
      var_dump((new BankStatements())->find()->fetch(true));
});


$route->namespace("Source\Controllers\API");

/**
 * Rotas de usuarios
 */
$route->group("account");

$route->get("/persons", "User:index", "index.persons");
$route->get("/person/{id}", "User:show", "show.person");
$route->post("/person", "User:store", "store.person");
$route->put("/person/{id}", "User:update", "put.person");
$route->delete("/person/{id}", "User:delete", "delete.person");

/**
 * Rotas de Cartoes
 */

$route->get("/cards", "Card:index", "index.cards");
$route->get("/card/{id}", "Card:show", "show.card");
$route->post("/card", "Card:store", "store.card");
$route->put("/card/{id}", "Card:update", "put.card");
$route->delete("/card/{id}", "Card:delete", "delete.card");

/**
 * Rotas de amigos de usuarios
 */

$route->get("/friends", "UserFriend:index", "index.friends");
$route->get("/friends/{id}", "UserFriend:show", "show.friends");
$route->post("/friends", "UserFriend:store", "store.friends");
$route->put("/friends/{id}", "UserFriend:update", "put.friends");
$route->delete("/friends/{id}", "UserFriend:delete", "delete.friends");

/**
 * Rotas de transferencias
 */

$route->get("/transfers", "Transfer:index", "index.transfers");
$route->get("/transfers/{id}", "Transfer:show", "show.transfers");
$route->post("/transfers", "Transfer:store", "store.transfers");
$route->put("/transfers/{id}", "Transfer:update", "put.transfers");
$route->delete("/transfers/{id}", "Transfer:delete", "delete.transfers");

/**
 * Rotas de bankstatements
 */

$route->get("/bank-statement", "Bankstatement:index", "index.bankstatements");
$route->get("/bank-statement/{id}", "Bankstatement:show", "show.bankstatements");
$route->post("/bank-statement", "Bankstatement:store", "store.bankstatements");
$route->put("/bank-statement/{id}", "Bankstatement:update", "put.bankstatements");
$route->delete("/bank-statement/{id}", "Bankstatement:delete", "delete.bankstatements");

$route->dispatch();

if ($route->error()) {
      echo "Error: " . $route->error();
}
