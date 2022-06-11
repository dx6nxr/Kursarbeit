<?php

namespace MyProject\Controllers;

use MyProject\Models\Transport\Transport;
use MyProject\View\View;

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
        $this->view->renderHtml('main/main.php', ['transports' => $transports]);
    }
}
