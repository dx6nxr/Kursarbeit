<?php

namespace Fahrplan\Controllers;

use Fahrplan\Models\Transport\Transport;
use Fahrplan\Models\Users\UsersAuthService;
use Fahrplan\View\View;

class MainController
{
    /** @var View */
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function main()
    {
        $transports = Transport::findAll();
        $this->view->renderHtml('main/main.php', [
            'transports' => $transports,
            'user' => UsersAuthService::getUserByToken()
        ]);
    }
}
