<?php

namespace Source\Controllers\API;

use Source\Models\BankStatements;

class BankStatement
{
      /**
       * Retorna todos os cartoes
       */
      public function index()
      {
            echo json_encode(objectToArray((new BankStatements())->find()->fetch(true)));
      }

      /**
       * Insere um cartao
       */
      public function store($data)
      {
            $findEmptyFields = array_keys($data, '');

            if ($findEmptyFields) {
                  echo json_encode(['emptyFields' => $findEmptyFields]);
                  return;
            }

            $data = filter_var_array($data, [
                  "user_id" => FILTER_SANITIZE_STRIPPED,
                  "friend_id" => FILTER_SANITIZE_STRIPPED,
                  "value" => FILTER_SANITIZE_STRIPPED,
                  "date" => FILTER_SANITIZE_STRIPPED,
                  "from_card" => FILTER_SANITIZE_STRIPPED
            ]);  

            $BankStatement = new BankStatements();

            $BankStatement->user_id = $data['user_id'];
            $BankStatement->friend_id = $data['friend_id'];
            $BankStatement->value = $data['value'];
            $BankStatement->date = $data['date'];
            $BankStatement->from_card = $data['from_card'];

            $BankStatement->save();

            if ($BankStatement->fail()) {
                  echo json_encode($BankStatement->fail()->getMessage());
                  return;
            }

            echo json_encode('salvo com sucesso');
      }

      /**
       * Retorna um cartao pelo id
       */
      public function show($data)
      {
            $BankStatement = (new BankStatements())->findById($data['id']);

            if (isset($BankStatement)) {
                  echo json_encode(objectToArray($BankStatement));
            } else {
                  echo json_encode(["error" => 1100, "message" => "id do usuario não encontrado"]);
            }
      }

      /**
       * atualiza um cartao
       */
      public function update($data)
      {
            $bankStatement = (new BankStatements())->findById($data['id']);

            if (isset($bankStatement)) {
                  $findEmptyFields = array_keys($data, '');

                  if ($findEmptyFields) {
                        echo json_encode(['emptyFields' => $findEmptyFields]);
                        return;
                  }

                  $data = filter_var_array($data, [
                        "user_id" => FILTER_SANITIZE_STRIPPED,
                        "friend_id" => FILTER_SANITIZE_STRIPPED,
                        "value" => FILTER_SANITIZE_STRIPPED,
                        "date" => FILTER_SANITIZE_STRIPPED,
                        "from_card" => FILTER_SANITIZE_STRIPPED
                  ]);  
      
                  $bankStatement->user_id = $data['user_id'];
                  $bankStatement->friend_id = $data['friend_id'];
                  $bankStatement->value = $data['value'];
                  $bankStatement->date = $data['date'];
                  $bankStatement->from_card = $data['from_card'];

                  $bankStatement->change()->save();

                  if ($bankStatement->fail()) {
                        echo json_encode($bankStatement->fail()->getMessage());
                        return;
                  }

                  echo json_encode('atualizado com sucesso');
            } else {
                  echo json_encode(["error" => 1100, "message" => "id do usuario não encontrado"]);
            }
      }

      /**
       * Deleta um cartao
       */
      public function delete($data)
      {
            $BankStatement = (new BankStatements())->findById($data['id']);

            if (isset($BankStatement)) {
                  $BankStatement->destroy();
                  echo json_encode('deletado com sucesso');
            } else {
                  echo json_encode(["error" => 1100, "message" => "id do usuario não encontrado"]);
            }
      }
}
