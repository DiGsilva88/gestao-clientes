<?php

namespace App\Http\Controllers;

use App\Models\Artigo;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ArtigoController extends Controller
{
    public function index()
    {
        $artigos = Artigo::with('categoria')->get();
        return view('artigos.index', compact('artigos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        // recupera todas as categorias do banco de dados para exibir na view de criação de artigos.
        return view('artigos.create', compact('categorias'));
        //passa as categorias para a view de criação de artigos, permitindo que o usuário selecione uma categoria ao criar um novo artigo.
    }

    public function store(Request $request)
    {
        $request->validate([
            // Validação dos dados recebidos do formulário de criação de artigo

            'titulo'       => 'required|string|max:255',
            'caracteristicas'     => 'nullable|string',
            'preco'     => 'nullable|numeric|min:0', // validação para preço: deve ser um número positivo
            'foto'     => 'nullable|image|max:2048', // validação para foto: deve ser uma imagem e não pode exceder 2MB
            'conteudo'     => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

  // Guarda a foto na pasta storage/app/public/fotos
    $fotoPath = null;
    if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('fotos', 'public');
    }

          Artigo::create([
        'descricao'       => $request->descricao,
        'caracteristicas' => $request->caracteristicas,
        'preco'           => $request->preco,
        'categoria_id'    => $request->categoria_id,
        'foto'            => $fotoPath,
    ]);

        return redirect()->route('artigos.index');
    }

    public function show(Artigo $artigo)
    // O Laravel usa route model binding para injetar automaticamente o modelo Artigo correspondente ao ID fornecido na rota.
    {
        return view('artigos.show', compact('artigo'));
    }

    public function edit(Artigo $artigo)
    {
        $categorias = Categoria::all();
        return view('artigos.edit', compact('artigo', 'categorias'));
    }

    public function update(Request $request, Artigo $artigo)
    {
        $request->validate([
            'titulo'       => 'required|string|max:255',
            'conteudo'     => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $artigo->update($request->only('titulo', 'conteudo', 'categoria_id'));
        // Atualiza apenas os campos especificados

        return redirect()->route('artigos.index');
    }

    public function destroy(Artigo $artigo)
    {
        $artigo->delete();
        return redirect()->route('artigos.index');
    }
}
