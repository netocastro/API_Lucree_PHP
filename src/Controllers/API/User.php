<?php

namespace Source\Controllers\API;

use Source\Models\Users;

class User
{
      /**
       * Retorna todos os usuarios
       */
      public function index()
      {
            echo json_encode(objectToArray((new Users())->find()->fetch(true)));
      }

      /**
       * Insere usuario no banco de dados
       */
      public function store($data)
      {
            $findEmptyFields = array_keys($data, '');

            if ($findEmptyFields) {
                  echo json_encode(['emptyFields' => $findEmptyFields]);
                  return;
            }

            $data = filter_var_array($data, [
                  "first_name" => FILTER_SANITIZE_STRIPPED,
                  "last_name" => FILTER_SANITIZE_STRIPPED,
                  "birthday" => FILTER_SANITIZE_STRIPPED,
                  "password" => FILTER_SANITIZE_STRIPPED,
                  "repeat_password" => FILTER_SANITIZE_STRIPPED
            ]);

            $validateFields = [];

            if (!validateName($data['first_name'])) {
                  $validateFields['first_name'] = 'Formato do nome invalido';
            }

            if (!validateName($data['last_name'])) {
                  $validateFields['last_name'] = 'Formato do nome invalido';
            }

            if ($data['password'] != $data['repeat_password']) {
                  $validateFields['repeat_password'] = "Senhas nao conferem";
            }

            if ($validateFields) {
                  echo json_encode(['validateFields' => $validateFields]);
                  return;
            }

            $user = new Users();

            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->user_name = implode(
                  '_',
                  [
                        str_replace(" ", "_", $data['first_name']),
                        str_replace(" ", "_", $data['last_name'])
                  ]
            );
            $user->birthday = $data['birthday'];
            $user->password = password_hash($data['password'], PASSWORD_DEFAULT);

            $user->save();

            if ($user->fail()) {
                  echo json_encode($user->fail()->getMessage());
                  return;
            }

            $user->user_id = hash('sha256', $user->id);

            $user->change()->save();

            if ($user->fail()) {
                  echo json_encode($user->fail()->getMessage());
                  return;
            }

            echo json_encode('salvo com sucesso');
      }

      /**
       * Retorna um usuário apartir do id
       */
      public function show($data)
      {
            $user = (new Users())->findById($data['id']);

            if (isset($user)) {
                  echo json_encode(objectToArray($user));
            } else {
                  echo json_encode(["error" => 1100, "message" => "id do usuario não encontrado"]);
            }
      }

      /**
       * atualiza um usuário
       */
      public function update($data)
      {

            $user = (new Users())->findById($data['id']);

            if (isset($user)) {
                  $findEmptyFields = array_keys($data, '');

                  if ($findEmptyFields) {
                        echo json_encode(['emptyFields' => $findEmptyFields]);
                        return;
                  }

                  $data = filter_var_array($data, [
                        "first_name" => FILTER_SANITIZE_STRIPPED,
                        "last_name" => FILTER_SANITIZE_STRIPPED,
                        "birthday" => FILTER_SANITIZE_STRIPPED,
                        "password" => FILTER_SANITIZE_STRIPPED,
                        "repeat_password" => FILTER_SANITIZE_STRIPPED
                  ]);

                  $validateFields = [];

                  if (!validateName($data['first_name'])) {
                        $validateFields['first_name'] = 'Formato do nome invalido';
                  }

                  if (!validateName($data['last_name'])) {
                        $validateFields['last_name'] = 'Formato do nome invalido';
                  }

                  if ($data['password'] != $data['repeat_password']) {
                        $validateFields['repeat_password'] = "Senhas nao conferem";
                  }

                  if ($validateFields) {
                        echo json_encode(['validateFields' => $validateFields]);
                        return;
                  }

                  $user->first_name = $data['first_name'];
                  $user->last_name = $data['last_name'];
                  $user->user_name = implode(
                        '_',
                        [
                              str_replace(" ", "_", $data['first_name']),
                              str_replace(" ", "_", $data['last_name'])
                        ]
                  );
                  $user->birthday = $data['birthday'];
                  $user->password = password_hash($data['password'], PASSWORD_DEFAULT);

                  $user->change()->save();

                  if ($user->fail()) {
                        echo json_encode($user->fail()->getMessage());
                        return;
                  }

                  echo json_encode('atualizado com sucesso');
            } else {
                  echo json_encode(["error" => 1100, "message" => "id do usuario não encontrado"]);
            }
      }

      /**
       * Deleta um usuário
       */
      public function delete($data)
      {
            $user = (new Users())->findById($data['id']);

            if (isset($user)) {
                  $user->destroy();
                  echo json_encode('deletado com sucesso');
            }else{
                  echo json_encode(["error" => 1100, "message" => "id do usuario não encontrado"]);
            }
            
      }
}
