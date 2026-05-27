<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\Usuario;

class HomeController extends Controller
{
    public function index(){
        //Data examples
        $usuario = new Usuario();
        $data = $usuario->getUserData();

        $userId1 = $usuario->getUserById(1);
        $totalUsuarios = $usuario->getUsersCount();

        echo 'User with ID 1: ' . $userId1['nome'];
        echo '<br>';
        echo 'Total users ' . $totalUsuarios;

        $this->view('home/index', $data);
    }

    public function contact(){
        $this->view('home/contact');
    }
}