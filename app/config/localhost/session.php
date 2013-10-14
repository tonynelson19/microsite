<?php

return array(
    'driver' => 'native',
    'lifetime' => 120,
    'files' => storage_path() . '/sessions',
    'lottery' => array(2, 100),
    'cookie' => 'laravel_session',
    'path' => '/',
    'domain' => null,
);
