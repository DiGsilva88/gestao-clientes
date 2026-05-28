<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $clients=Client::all();


        //dd ($clientes);
        return view('Client/index',compact('clients'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Client.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{



        //validar os dados do formulario
        $request-> validate([

        'nome'=>'required|max:100',
        'morada'=>'nullable|max:100',
        'localidade'=>'nullable|max:30',
        'email' => 'required|email|unique:clients,email',
        'telefone'=>'nullable|max:15',
        


         ]);


        //gravar na base de dados
        Client::create([
        'nome' => $request->nome,
        'morada' => $request->morada,
        'localidade' => $request->localidade,
        'telefone' => $request->telefone,
        'email' => $request->email,



    ]);
        return redirect('/client')
 ->with('success', 'Cliente inserido com sucesso');
}

    /**
     * Display the specified resource.
     */
    public function show(client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(client $client)
    {
        //
    }
}
