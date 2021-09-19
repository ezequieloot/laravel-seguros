<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Entidades\Sistema\Usuario;
    use App\Entidades\Sistema\Patente;

    require app_path() . '/start/constants.php';

    class ControladorWebNosotros extends Controller
    {
        public function index()
        {
           return view('web.nosotros');
        }
    }

?>