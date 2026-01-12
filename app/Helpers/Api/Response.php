<?php

namespace App\Helpers\Api;

use Illuminate\Http\JsonResponse;

class Response
{
  protected const CODE_SUCCESS = 200;
  protected const CODE_ERROR = 400;
  protected const TYPE_SUCCESS = 'success';
  protected const TYPE_ERROR = 'error';

  /**
   * Response sukses (tanpa data)
   *
   * @param  string  $message
   * @param  int     $code
   * @param  string  $type
   * @return \Illuminate\Http\JsonResponse
   */
  public static function success(
    string $message,
    int $code = self::CODE_SUCCESS,
    string $type = self::TYPE_SUCCESS
  ): JsonResponse {
    return response()->json([
      'status'  => true,
      'type'    => $type,
      'code'    => $code,
      'message' => $message,
    ], $code);
  }

  /**
   * Response error (tanpa data)
   *
   * @param  string  $message
   * @param  int     $code
   * @param  string  $type
   * @return \Illuminate\Http\JsonResponse
   */
  public static function error(
    string $message,
    int $code = self::CODE_ERROR,
    string $type = self::TYPE_ERROR
  ): JsonResponse {
    return response()->json([
      'status'  => false,
      'type'    => $type,
      'code'    => $code,
      'message' => $message,
    ], $code);
  }

  /**
   * Response sukses dengan data
   *
   * @param  mixed       $data
   * @param  string|null $message
   * @param  int         $code
   * @param  string      $type
   * @return \Illuminate\Http\JsonResponse
   */
  public static function data(
    mixed $data,
    ?string $message = null,
    int $code = self::CODE_SUCCESS,
    string $type = self::TYPE_SUCCESS
  ): JsonResponse {
    $response = [
      'status' => true,
      'type'   => $type,
      'code'   => $code,
      'data'   => $data,
    ];

    if (!empty($message)) {
      $response['message'] = $message;
    }

    return response()->json($response, $code);
  }
}
