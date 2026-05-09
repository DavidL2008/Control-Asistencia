<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Rats\Zkteco\Lib\ZKTeco;

class ZktecoController extends Controller
{
    private $zk;

    public function __construct()
    {
        $this->zk = new ZKTeco('192.168.1.201');
    }

    public function index()
    {
        // Puedes pasar un mensaje a la vista utilizando with()
        $message = "¡Bienvenido a ZktecoController!";
        return View::make('zkteco.index')->with('message', $message);
    }

    public function connect()
    {
        if ($this->zk->connect()) {
            $message = "¡Conexión exitosa con Zkteco!";
        } else {
            $message = "¡Falló la conexión con Zkteco!";
        }

        return View::make('zkteco.index')->with('message', $message);
    }

    public function disconnect()
    {
        if ($this->zk->disconnect()) {
            return response()->json(['message' => 'Disconnected successfully']);
        } else {
            return response()->json(['message' => 'Disconnection failed'], 500);
        }
    }
}
