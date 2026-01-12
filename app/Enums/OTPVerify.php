<?php

namespace App\Enums;

enum OTPVerify: string
{
  case FORGOT = 'Forgot Password';
  case LOGIN = 'Login';
  case CHANGE_PASSWORD = 'Change Password';
}
