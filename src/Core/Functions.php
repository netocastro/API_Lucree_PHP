<?php

/**
 * Transforma objetos do tipo DataLayer em arrays
 */

function objectToArray($object): array
{
      $newArray = [];
      if ($object == null) {
            return (array)$newArray;
      }

      if (is_array($object)) {

            foreach ($object as $item => $value) {
                  $newArray[] = (array)$value->data();
            }
            return  (array) $newArray;
      } else {
            $newArray = [];
            $newArray[] = (array)$object->data();
            return (array)$newArray;
      }
}

/**
 * função de validação de nomes com expressões regulares
 */

function validateName($name): bool
{
      if (preg_match('/^[a-zA-Z ]+$/', $name)) {
            return true;
      } else {
            return false;
      }
}
