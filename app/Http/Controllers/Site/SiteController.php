<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('auth')
                   // ->only([
                     //   'contato',
                    //    'categoria'
                    //]);
        //$this->middleware('auth')
                    //->except([
                        //'index',
                        //'contato'
                    //]);

    }

    public function index()
    {
        $teste = 123;
        $teste2 = 321;
        $teste3 = 132;
    	return view('site.home.teste', compact('teste', 'teste2', 'teste3'));
    }

    public function contato()
    {
    	return 'Pg contato';
    }

    public function categoria($id)
    {
    	return "Listagem dos posts da categoria: {$id}";
    }

    public function categoriaOp($id=1)
    {
    	return "Listagem dos posts da categoria: {$id}";
    }
}
