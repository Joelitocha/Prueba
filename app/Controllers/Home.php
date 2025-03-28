<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function bienvenida()
    {
        return view('bienvenida'); // Carga la nueva vista principal
    }
}
