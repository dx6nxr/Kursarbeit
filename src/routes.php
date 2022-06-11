<?php

return [
    '~^routes/(.*)$~' => [\MyProject\Controllers\TransportController::class, 'view'],
    '~^routes/(.*)/edit$~' => [\MyProject\Controllers\TransportController::class, 'edit'],
    '~^routes/add$~' => [\MyProject\Controllers\TransportController::class, 'add'],
    '~^$~' => [\MyProject\Controllers\MainController::class, 'main']
];
