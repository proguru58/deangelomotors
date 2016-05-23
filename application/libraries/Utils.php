<?php

/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 5/23/16
 * Time: 10:46 AM
 */
class Utils
{
  function generate_random_string($length = 32) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
}