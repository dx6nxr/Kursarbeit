<?php

namespace Fahrplan\Controllers;

use Fahrplan\Models\Transport\Transport;
use Fahrplan\View\View;

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
        $name = $_GET['name'];
        $trip = $_GET['trip'];
        //$num = $_GET['id'];
        /** @var Transport $edit */
        $edit = Transport::getById($transportNum);

        if ($edit === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            //var_dump($edit);
            return;
        }

        $jsonTrips = explode (", ", $trip);
        foreach ($jsonTrips as $key => $jsonTrip) {
            $arr[$key] = $jsonTrip;
        }

        $arr = json_encode($arr, true);

        if($name != '' and $trip != ''){
            $edit->setName($name);
            $edit->setText($arr);
        }
        else{
            $this->view->renderHtml('sub/edit.php', [
                'info' => $edit
            ], 200);
            return;
        }
        $edit->save('update');

        header('Location: /www/index.php');
    }
    public function add(): void
    {
        $name = $_GET['name'];
        $trip = $_GET['trip'];
        $num = $_GET['id'];

        $trip = strtolower($trip);
        $name = strtolower($name);

        //http://fahrplan2/www/add?id=12&name=bus&trip=trip

        if($num === null){
            $this->view->renderHtml('sub/create.php', [], 200);
            //var_dump($edit);
            return;
        }

        $new = new Transport();
        $new->setId($num);
        $new->setName($name);

        $jsonTrips = explode (", ", $trip);
        foreach ($jsonTrips as $key => $jsonTrip) {
            $arr[$key] = $jsonTrip;
        }
        $arr = json_encode($arr, true);

        $new->setText($arr);

        $new->save('add');

        header('Location: index.php');

        //var_dump($new);
    }

    public function delete(string $transportNum): void
    {
        //$num = $_GET['id'];
        /** @var Transport $edit */
        $edit = Transport::getById($transportNum);

        if ($edit === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            //var_dump($edit);
            return;
        }

        $edit->delete();

        header('Location: /www/index.php');
    }
}
