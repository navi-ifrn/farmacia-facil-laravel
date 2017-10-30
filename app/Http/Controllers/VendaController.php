<?php

namespace App\Http\Controllers;

use App\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $lista = Venda::orderBy('created_at', 'desc')->paginate();
        return view('venda.index', compact('lista'));
    }
}
