<?php

use Fahrplan\Controllers\MainController;
use Fahrplan\Controllers\TransportController;

return [
    '~^routes/edit/(.*)$~' => [TransportController::class, 'edit'],
    '~^routes/delete/(.*)$~' => [TransportController::class, 'delete'],
    '~^routes/(.*)$~' => [TransportController::class, 'view'],
    '~^add$~' => [TransportController::class, 'add'],
    '~^$~' => [MainController::class, 'main'],
];
