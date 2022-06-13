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

        $this->view->renderHtml('routes/view.php', [
            'transport' => $transport
        ]);
    }

    public function edit(string $transportNum): void
    {
        $name = $_GET['name'];
        $trip = $_GET['trip'];
        $pass = $_GET['MasterPass'];
        /** @var Transport $edit */
        $edit = Transport::getById($transportNum);

        if ($edit === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            //var_dump($edit);
            return;
        }

            $jsonTrips = explode(", ", $trip);
            foreach ($jsonTrips as $key => $jsonTrip) {
                $arr[$key] = $jsonTrip;
            }

            $arr = json_encode($arr, true);

            if ($name != '' and $trip != '') {
                if($pass == self::getMasterPass()) {
                    $edit->setName($name);
                    $edit->setText($arr);

                    $edit->save('update');
                }
                else {
                    $this->view->renderHtml('sub/edit.php', [
                        'info' => $edit,
                        'error' => "Incorrect MasterPass"
                    ], 200);
                    return;
                }
            } else {
                $this->view->renderHtml('sub/edit.php', [
                    'info' => $edit
                ], 400);
                return;
            }

        header('Location: /www/index.php');
    }
    public function add(): void
    {
        $name = $_GET['name'];
        $trip = $_GET['trip'];
        $num = $_GET['id'];
        $pass = $_GET['MasterPass'];

        $trip = strtolower($trip);
        $name = strtolower($name);

        //http://fahrplan2/www/add?id=12&name=bus&trip=trip

        if($num === null){
            $this->view->renderHtml('sub/create.php', [], 200);
            //var_dump($edit);
            return;
        }
        if($pass == self::getMasterPass()) {
            $new = new Transport();
            $new->setId($num);
            $new->setName($name);

            $jsonTrips = explode(", ", $trip);
            foreach ($jsonTrips as $key => $jsonTrip) {
                $arr[$key] = $jsonTrip;
            }
            $arr = json_encode($arr, true);

            $new->setText($arr);

            $new->save('add');

            header('Location: index.php');
        }
        else{
            $this->view->renderHtml('sub/create.php', [
                'error' => "Incorrect MasterPass",
                'name' => $name,
                'trip' => $trip,
                'num' => $num
            ], 200);
            //var_dump($edit);
            return;
        }
        //var_dump($new);
    }

    public function delete(string $transportNum): void
    {
        $pass = $_GET['MasterPass'];
        /** @var Transport $edit */
        $edit = Transport::getById($transportNum);

        if ($edit === null) {
            $this->view->renderHtml('sub/delete.php', [], 200);
            //var_dump($edit);
            return;
        }
        else{

            if ($pass == self::getMasterPass()){
                $edit->delete();
            }
            else{
                $this->view->renderHtml('sub/delete.php', [
                    'error' => 'Incorrect MasterPass'
                ], 200);
                //var_dump($edit);
                return;
            }
        }


        header('Location: /www/index.php');
    }

    private static function getMasterPass(): string
    {
        return 'hardpass123';
    }
}

