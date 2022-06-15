<?php

namespace Fahrplan\Controllers;

use Fahrplan\Models\Transport\Transport;
use Fahrplan\Models\Users\UsersAuthService;
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
        $user = UsersAuthService::getUserByToken();

        if ($transport === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            return;
        }

        $this->view->renderHtml('routes/view.php', [
            'transport' => $transport,
            'user' => $user
        ]);
    }

    public function edit(string $transportNum): void
    {
        $name = $_GET['name'];
        $trip = $_GET['trip'];
        $user = UsersAuthService::getUserByToken();
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
                if($user->getRole() == "admin") {
                    $edit->setName($name);
                    $edit->setText($arr);

                    $edit->save('update');
                }
                else {
                    $this->view->renderHtml('sub/edit.php', [
                        'info' => $edit,
                        'error' => 'You re not an admin'
                    ], 200);
                    return;
                }
            } else {
                $this->view->renderHtml('sub/edit.php', [
                    'info' => $edit,
                    'user' =>  $user
                ], 200);
                return;
            }

        header('Location: /www/index.php');
    }
    public function add(): void
    {
        $name = $_GET['name'];
        $trip = $_GET['trip'];
        $num = $_GET['id'];

        $trip = strtolower($trip);
        $name = strtolower($name);

        $user = UsersAuthService::getUserByToken();

        if($num === null){
            $this->view->renderHtml('sub/create.php', ['user'=>$user], 200);
            //var_dump($edit);
            return;
        }
        if($user->getRole() == "admin") {
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
                'error' => 'You re not an admin',
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
        $user = UsersAuthService::getUserByToken();
        /** @var Transport $edit */
        $edit = Transport::getById($transportNum);

        if ($edit === null) {
            $this->view->renderHtml('errors/404.php', [], 404);
            //var_dump($edit);
            return;
        }
        else{

            if ($user->getRole() == "admin"){
                $edit->delete();
            }
        }


        header('Location: /www/index.php');
    }
}

