<?php

namespace Source\Controllers\API;

use Source\Models\UserFriends;
/////
class UserFriend
{
      /**
       * Retorna todos os amigos
       */
      public function index()
      {
            echo json_encode(objectToArray((new UserFriends())->find()->fetch(true)));
      }

      /**
       * Insere uma amizade
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
                  "friend_id" => FILTER_SANITIZE_STRIPPED
            ]);

            $userFriend = new UserFriends();

            $userFriend->user_id = $data['user_id'];
            $userFriend->friend_id = $data['friend_id'];

            $userFriend->save();

            if ($userFriend->fail()) {
                  echo json_encode($userFriend->fail()->getMessage());
                  return;
            }

            echo json_encode('salvo com sucesso');
      }

      /**
       * Retorna a lista de amizades de um unico usuario
       */
      public function show($data)
      {
            $friends = [];

            $userFriends = (new UserFriends())->find('user_id = :ui', "ui={$data['id']}")->fetch(true);

            if (isset($userFriends)) {
                  foreach ($userFriends as $friend) {
                        $friends[] = $friend->friend();
                  }

                  echo json_encode(objectToArray($friends));
            } else {
                  echo json_encode(["error" => 1100, "message" => "id do usuario não encontrado"]);
            }
      }

      /**
       * atualiza uma amizade
       */
      public function update($data)
      {
            $userFriend = (new UserFriends())->findById($data['id']);

            if (isset($userFriend)) {
                  $findEmptyFields = array_keys($data, '');

                  if ($findEmptyFields) {
                        echo json_encode(['emptyFields' => $findEmptyFields]);
                        return;
                  }

                  $data = filter_var_array($data, [
                        "user_id" => FILTER_SANITIZE_STRIPPED,
                        "friend_id" => FILTER_SANITIZE_STRIPPED
                  ]);

                  $userFriend->user_id = $data['user_id'];
                  $userFriend->friend_id = $data['friend_id'];

                  $userFriend->change()->save();

                  if ($userFriend->fail()) {
                        echo json_encode($userFriend->fail()->getMessage());
                        return;
                  }

                  echo json_encode('atualizado com sucesso');
            } else {
                  echo json_encode(["error" => 1100, "message" => "id do usuario não encontrado"]);
            }
      }

      /**
       * Deleta uma amizade
       */
      public function delete($data)
      {
            $user = (new UserFriends())->findById($data['id']);

            if (isset($user)) {
                  $user->destroy();
                  echo json_encode('deletado com sucesso');
            } else {
                  echo json_encode(["error" => 1100, "message" => "id do usuario não encontrado"]);
            }
      }
}
