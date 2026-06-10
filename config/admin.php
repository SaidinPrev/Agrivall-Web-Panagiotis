<?php

return [
    'username' => env('ADMIN_USERNAME', 'admin'),
    'password_hash' => env('ADMIN_PASSWORD_HASH', password_hash('admin', PASSWORD_BCRYPT)),
];
