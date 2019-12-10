<?php
namespace App\Helpers;
Use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
class CryptHelper
{
  public static function encrypt($value){
    try {
      return encrypt($value);
    } catch (DecryptException $e) {
      return false;
    }
  }
  public static function decrypt($value){
    try {
      return decrypt($value);
    } catch (DecryptException $e) {
      return false;
    }
  }
}