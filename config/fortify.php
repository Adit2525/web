<?php

return [
    'guard' => 'web',
    'middleware' => ['web'],
    'username' => 'email',
    'email' => 'email',
    // Keep features minimal to avoid class references during config load.
    'features' => [],
];


