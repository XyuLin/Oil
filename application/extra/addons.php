<?php

return array (
  'autoload' => false,
  'hooks' => 
  array (
    'sms_send' => 
    array (
      0 => 'alisms',
    ),
    'sms_notice' => 
    array (
      0 => 'alisms',
    ),
    'sms_check' => 
    array (
      0 => 'alisms',
    ),
  ),
  'route' => 
  array (
    '/qrcode$' => 'qrcode/index/index',
    '/qrcode/build$' => 'qrcode/index/build',
  ),
);