<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Product;

class ProdutoController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title = 'Listagem dos Produtos';

        $products = $this->product->all();
        
        return view('painel.products.index', compact('products', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Cadastrar Novo Produto";

        $categories = ['eletronicos', 'moveis', 'limpeza', 'banho'];

        return view('painel.products.create', compact('title','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Pega todos os dados que vem do formulário
        $dataForm = $request->all();

        $dataForm['active'] = ( !isset($dataForm['active']) ) ? 0 : 1;
        
        //Faz o cadastro
        $insert = $this->product->create($dataForm);

        if( $insert )
            return redirect()->route('produtos.index');
        else
            return redirect()->route('produtos.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function tests() 
    {
        //$prod = $this->product;
        //$prod->name = 'Nome do produto';
        //$prod->number = '131231';
        //$prod->active = true;
        //$prod->category = "eletronicos";
        //$prod->description = "Description do produto aqui";
        //$insert = $prod->save();

        //if( $insert)
           // return 'Inserido com sucesso';
        //else
           // return 'Falha ao inserir';

        //$insert = $this->product->create([
            //'name' => 'Nome do produto 2',
            //'number' => '434435',
            //'active' => false,
            //'category' => 'eletronicos',
            //'description' => 'Descrição vem aqui'
        //]);

        //if( $insert)
           //return "Inserido com sucesso ID: {$insert->id}";
        //else
           //return 'Falha ao inserir';

        //$prod = $this->product->find(5);
        //$prod->name = 'Update';
        //$prod->number = '79789';
        //$prod->active = true;
        //$prod->category = 'eletronicos';
        //$prod->description = 'Desc Update';
        //$update = $prod->save();

         //if( $update)
           //return "Alterado com sucesso!";
        //else
           //return 'Falha ao alterar';

        //$prod = $this->product->find(6);
        //$update = $prod->update([
            //'name' => 'Update Test',
            //'number' => '6765756',
            //'active' => true
            //'category' => 'eletronicos',
            //'description' => 'Descrição vem aqui'
        //]);

         //if( $update)
           //return "Alterado com sucesso!";
        //else
          // return 'Falha ao alterar';
   // }
        /*
        $prod = $this->product->where('number', 6765756);
        $update = $prod->update([
            'name' => 'Update Test 2',
            'number' => '67657560',
            'active' => false
            //'category' => 'eletronicos',
            //'description' => 'Descrição vem aqui'
        ]);

         if( $update)
           return "Alterado com sucesso 2!";
        else
           return 'Falha ao alterar';
        */
        $delete = $this->product->where('number', 67657560)->delete();
        
        if( $delete)
            return 'Deletado com sucesso 2!';
        else
            return 'Falha ao deletar';
    }
}
