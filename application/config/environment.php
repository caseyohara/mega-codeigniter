<?php

define('ENVIRONMENT', 'development');

if (defined('ENVIRONMENT'))
{
  switch (ENVIRONMENT)
  {
    case 'development':
      error_reporting(E_ALL);
    break;
  
    case 'testing':
    case 'production':
      error_reporting(0);
    break;

    default:
      exit('The application environment is not set correctly.');
  }
}

?>