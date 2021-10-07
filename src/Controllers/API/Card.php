<?php

namespace Source\Controllers\API;

use Source\Models\Cards;

class Card
{
      /**
       * Retorna todos os cartoes
       */
      public function index()
      {
            echo json_encode(objectToArray((new Cards())->find()->fetch(true)));
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
                  "title" => FILTER_SANITIZE_STRIPPED,
                  "pan" => FILTER_SANITIZE_STRIPPED,
                  "expiry_mm" => FILTER_SANITIZE_STRIPPED,
                  "expiry_yyyy" => FILTER_SANITIZE_STRIPPED,
                  "security_code" => FILTER_SANITIZE_STRIPPED,
                  "date" => FILTER_SANITIZE_STRIPPED
            ]);

            $card = new Cards();

            $card->title = $data['title'];
            $card->pan = $data['pan'];
            $card->expiry_mm = $data['expiry_mm'];
            $card->expiry_yyyy = $data['expiry_yyyy'];
            $card->security_code = $data['security_code'];
            $card->date = $data['date'];

            $card->save();

            if ($card->fail()) {
                  echo json_encode($card->fail()->getMessage());
                  return;
            }

            $card->card_id = hash('sha256', $card->id);

            $card->change()->save();

            if ($card->fail()) {
                  echo json_encode($card->fail()->getMessage());
                  return;
            }

            echo json_encode('salvo com sucesso');
      }

      /**
       * Retorna um cartao pelo id
       */
      public function show($data)
      {
            $card = (new Cards())->findById($data['id']);

            if (isset($card)) {
                  echo json_encode(objectToArray($card));
            } else {
                  echo json_encode(["error" => 1100, "message" => "id do usuario não encontrado"]);
            }
      }

      /**
       * atualiza um cartao
       */
      public function update($data)
      {
            $card = (new Cards())->findById($data['id']);

            if (isset($card)) {
                  $findEmptyFields = array_keys($data, '');

                  if ($findEmptyFields) {
                        echo json_encode(['emptyFields' => $findEmptyFields]);
                        return;
                  }

                  $data = filter_var_array($data, [
                        "title" => FILTER_SANITIZE_STRIPPED,
                        "pan" => FILTER_SANITIZE_STRIPPED,
                        "expiry_mm" => FILTER_SANITIZE_STRIPPED,
                        "expiry_yyyy" => FILTER_SANITIZE_STRIPPED,
                        "security_code" => FILTER_SANITIZE_STRIPPED,
                        "date" => FILTER_SANITIZE_STRIPPED
                  ]);

                  $card->title = $data['title'];
                  $card->pan = $data['pan'];
                  $card->expiry_mm = $data['expiry_mm'];
                  $card->expiry_yyyy = $data['expiry_yyyy'];
                  $card->security_code = $data['security_code'];
                  $card->date = $data['date'];

                  $card->change()->save();

                  if ($card->fail()) {
                        echo json_encode($card->fail()->getMessage());
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
            $card = (new Cards())->findById($data['id']);

            if (isset($card)) {
                  $card->destroy();
                  echo json_encode('deletado com sucesso');
            } else {
                  echo json_encode(["error" => 1100, "message" => "id do usuario não encontrado"]);
            }
      }
}
