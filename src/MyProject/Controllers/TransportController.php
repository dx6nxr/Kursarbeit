<?php

namespace MyProject\Controllers;

use MyProject\Models\Transport\Transport;
use MyProject\View\View;

class TransportController
{
    /** @var View */
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

    public function view(string $id)
    {
        $transport = Transport::getById($id);

        if ($transport === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $this->view->renderHtml('articles/view.php', [
            'transport' => $transport
        ]);
    }

    public function edit(string $transportNum): void
    {
        /** @var Transport $edit */
        $edit = Transport::getById($transportNum);

        if ($edit === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $edit->setName('new transport');
        $edit->setText('new trip');

        $edit->save();
    }

    public function add(): void
    {

        $new = new Transport();
        $new->setName('new transport');
        $new->setText('new trip');

        $new->save();

        var_dump($new);
    }
}
