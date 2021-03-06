<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Product;
use App\Http\Requests\Painel\ProductFormRequest;

class ProdutoController extends Controller
{
    private $product;
    private $totalPage = 3;

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

        $products = $this->product->paginate($this->totalPage);
        
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

        return view('painel.products.create-edit', compact('title','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request)
    {
        //Pega todos os dados que vem do formulário
        $dataForm = $request->all();

        $dataForm['active'] = ( !isset($dataForm['active']) ) ? 0 : 1;

        //Valida os dados
        //$this->validate($request, $this->product->rules);
        //$messages = [
            //'name.required' => 'O campo nome é de preenchimento obrigatório',
            //'number.numeric' => 'Precisa ser apenas números',
            //'number.required' =>  'O campo número é de preenchimento obrigatório',
        //];

        //$validate = validator($dataForm, $this->product->rules, $messages);



        //if( $validate->fails() ) {
            //return redirect()
                //->route('produtos.create')
                //->withErrors($validate)
                //->withinput();
       // }
        
        //Faz o cadastro
        $insert = $this->product->create($dataForm);

        if( $insert )
            return redirect()->route('produtos.index');
        else
            return redirect()->route('produtos.create-edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $product = $this->product->find($id);

         $title = "Produto: ($product->name)";

         return view('painel.products.show', compact('product', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       //Recupera o produto pelo seu id
        $product = $this->product->find($id);

        $title = "Editar produto: $product->name";

        $categories = ['eletronicos', 'moveis', 'limpeza', 'banho'];

         return view('painel.products.create-edit', compact('title','categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductFormRequest $request, $id)
    {
        $dataForm = $request->all();

        $product = $this->product->find($id);

        $dataForm['active'] = ( !isset($dataForm['active']) ) ? 0 : 1;

        $update = $this->product->update($dataForm);

        if( $update)
            return redirect()->route('produtos.index');
        else
            return redirect()->route('produtos.edit', $id)->with(['errors'=>'Falha ao editar']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->product->find($id);

        $delete = $product->delete();

        if ($delete)
            return redirect()->route('produtos.index');
        else 
            return redirect()->route('produtos.show', $id)->with(['errors' => 'Falha ao deletar']);
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
