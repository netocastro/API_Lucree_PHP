<?php

namespace Source\Controllers\API;

use Source\Models\Transfers;

class Transfer
{
      /**
       * Retorna todas as Transferencias
       */
      public function index()
      {
            echo json_encode(objectToArray((new Transfers())->find()->fetch(true)));
      }

      /**
       * Insere um registro de transferencia
       */
      public function store($data)
      {
            $findEmptyFields = array_keys($data, '');

            if ($findEmptyFields) {
                  echo json_encode(['emptyFields' => $findEmptyFields]);
                  return;
            }

            $data = filter_var_array($data, [
                  "card_id" => FILTER_SANITIZE_STRIPPED,
                  "friend_id" => FILTER_SANITIZE_STRIPPED,
                  "total_to_transfer" => FILTER_SANITIZE_NUMBER_FLOAT
            ]);

            $transfer = new transfers();

            $transfer->card_id = $data['card_id'];
            $transfer->friend_id = $data['friend_id'];
            $transfer->total_to_transfer = $data['total_to_transfer'];

            $transfer->save();

            if ($transfer->fail()) {
                  echo json_encode($transfer->fail()->getMessage());
                  return;
            }

            echo json_encode('salvo com sucesso');
      }

      /**
       * Retorna uma transferencia apartir do id
       */
      public function show($data)
      {
            $transfer = (new Transfers())->findById($data['id']);

            if (isset($transfer)) {
                  echo json_encode(objectToArray($transfer));
            } else {
                  echo json_encode(["error" => 1100, "message" => "id do usuario não encontrado"]);
            }
      }

      /**
       * atualiza uma transferencia
       */
      public function update($data)
      {
            $transfer = (new Transfers())->findById($data['id']);

            if (isset($transfer)) {
                  $findEmptyFields = array_keys($data, '');

                  if ($findEmptyFields) {
                        echo json_encode(['emptyFields' => $findEmptyFields]);
                        return;
                  }

                  $data = filter_var_array($data, [
                        "card_id" => FILTER_SANITIZE_STRIPPED,
                        "friend_id" => FILTER_SANITIZE_STRIPPED,
                        "total_to_transfer" => FILTER_SANITIZE_NUMBER_FLOAT
                  ]);

                  $transfer->card_id = $data['card_id'];
                  $transfer->friend_id = $data['friend_id'];
                  $transfer->total_to_transfer = $data['total_to_transfer'];

                  $transfer->change()->save();

                  if ($transfer->fail()) {
                        echo json_encode($transfer->fail()->getMessage());
                        return;
                  }

                  echo json_encode('atualizado com sucesso');
            } else {
                  echo json_encode(["error" => 1100, "message" => "id do usuario não encontrado"]);
            }
      }

      /**
       * Deleta uma transferencia
       */
      public function delete($data)
      {
            $user = (new Transfers())->findById($data['id']);

            if (isset($user)) {
                  $user->destroy();
                  echo json_encode('deletado com sucesso');
            } else {
                  echo json_encode(["error" => 1100, "message" => "id do usuario não encontrado"]);
            }
      }
}
