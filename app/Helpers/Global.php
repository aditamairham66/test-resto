<?php

if (!function_exists('generateSignature')) {
  /**
   * Generate a secure SHA-512 signature string.
   *
   * Fungsi ini digunakan untuk menghasilkan tanda tangan digital (signature)
   * berbasis kombinasi dari `token`, `appName`, dan `plainText`. Signature ini 
   * berguna untuk memastikan integritas dan keaslian data yang dikirim antara 
   * sistem, misalnya untuk autentikasi API atau verifikasi request.
   *
   * @param  string  $token      Token rahasia yang dimiliki oleh client atau sistem.
   * @param  string  $appName    Nama aplikasi yang terdaftar.
   * @param  string  $plainText  Data mentah (plain text) yang ingin ditandatangani.
   *
   * @return string  Signature berupa hash SHA-512 hasil gabungan ketiga parameter.
   */
  function generateSignature($token, $appName, $plainText)
  {
    return hash('sha512', $token . ':' . $appName . ':' . $plainText);
  }
}
