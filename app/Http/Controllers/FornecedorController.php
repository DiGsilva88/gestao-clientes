<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    /**
     * INDEX - Lista todos os fornecedores
     *
     * Rota: GET /fornecedores
     * Chamado quando o utilizador acede à página principal de fornecedores.
     * Vai buscar todos os registos da tabela 'fornecedores' e envia-os para a view.
     */
/**
 * Display a listing of the resource.
 */
public function index(Request $request)// O Request $request é necessário para receber os dados de pesquisa (query string)
{
   // Pesquisa
    $search = $request->search;

    // Ordem alfabética
    $ordem = $request->ordem ?? 'asc';

    $fornecedores = Fornecedor::when($search, function ($query, $search) {

            $query->where('nome', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');

        })

        ->orderBy('nome', $ordem)

        ->paginate(10)

        ->appends($request->query());

    return view('Fornecedor.index', compact('fornecedores'));
}

    /**
     * CREATE - Mostra o formulário para criar um novo fornecedor
     *
     * Rota: GET /fornecedores/create
     * Apenas carrega a view com o formulário vazio.
     * Não faz nenhuma operação na base de dados.
     */

    public function create()
    {
        // Carrega a view 'resources/views/Fornecedor/create.blade.php'
        return view('Fornecedor.create');
    }


    /**
     * STORE - Guarda um novo fornecedor na base de dados
     *
     * Rota: POST /fornecedores
     * Chamado quando o utilizador submete o formulário de criação.
     * Recebe os dados do formulário através do objeto $request.
     */
    public function store(Request $request)
    {
        // VALIDAÇÃO: verifica se os dados enviados respeitam as regras definidas.
        // Se alguma regra falhar, o Laravel redireciona automaticamente de volta
        // ao formulário com as mensagens de erro — sem chegar ao código abaixo.
        $request->validate([
            'nome'       => 'required|max:100',   // obrigatório, máximo 100 caracteres
            'morada'     => 'nullable|max:100',   // opcional, máximo 100 caracteres
            'localidade' => 'nullable|max:30',    // opcional, máximo 30 caracteres
            'email'      => 'required|email|unique:fornecedors,email',
                            // obrigatório, formato email válido,
                            // e único na coluna 'email' da tabela 'fornecedors'
            'telefone'   => 'nullable|max:15',    // opcional, máximo 15 caracteres
        ]);

        // INSERÇÃO: cria um novo registo na base de dados com os dados validados.
        // O método create() faz o INSERT INTO automaticamente.
        // Atenção: os campos têm de estar na propriedade $fillable do Model Fornecedor.
        Fornecedor::create([
            'nome'       => $request->nome,
            'morada'     => $request->morada,
            'localidade' => $request->localidade,
            'telefone'   => $request->telefone,
            'email'      => $request->email,
        ]);

        // Redireciona para a lista de fornecedores (rota 'fornecedores.index')
        // with('success', '...') envia uma mensagem temporária (flash message)
        // que pode ser mostrada na view com: session('success')
        return redirect()->route('fornecedor.index')
                         ->with('success', 'Fornecedor inserido com sucesso');
    }


    /**
     * SHOW - Mostra os detalhes de um fornecedor específico
     *
     * Rota: GET /fornecedores/{id}
     * Recebe o $id do fornecedor através do URL (ex: /fornecedores/3).
     */
    public function show($id) // O nome do parâmetro $id tem de ser igual ao definido na rota (Route::resource define isso automaticamente).
    {
        // findOrFail() procura o fornecedor pelo ID na base de dados.
        // Se não encontrar, lança automaticamente um erro 404 (página não encontrada).
        // Alternativa: find($id) retornaria null em vez de erro 404.
        $fornecedor = Fornecedor::findOrFail($id);

        // Envia os dados do fornecedor para a view de detalhe
        return view('Fornecedor.show', compact('fornecedor'));
    }


    /**
     * EDIT - Mostra o formulário para editar um fornecedor existente
     *
     * Rota: GET /fornecedores/{id}/edit
     * Semelhante ao show(), mas carrega uma view com formulário preenchido
     * com os dados atuais do fornecedor para o utilizador poder alterar.
     */
    public function edit($id)
    {
        // Procura o fornecedor pelo ID — dá erro 404 se não existir
        $fornecedor = Fornecedor::findOrFail($id);

        // Carrega a view 'resources/views/Fornecedor/edit.blade.php'
        // com os dados do fornecedor já preenchidos no formulário
        return view('Fornecedor.edit', compact('fornecedor'));
    }


    /**
     * UPDATE - Guarda as alterações de um fornecedor existente
     *
     * Rota: PUT /fornecedores/{id}
     * Chamado quando o utilizador submete o formulário de edição.
     * Nota: formulários HTML só suportam GET e POST, por isso na view
     * é necessário usar @method('PUT') dentro do formulário.
     */
    public function update(Request $request, $id)
    {
        // VALIDAÇÃO: igual ao store(), mas com uma diferença importante no email:
        $request->validate([
            'nome'       => 'required|max:100',
            'morada'     => 'nullable|max:100',
            'localidade' => 'nullable|max:30',
            'email'      => 'required|email|unique:fornecedors,email,' . $id,
                            // O ', $id' no final diz ao Laravel para IGNORAR
                            // este registo na verificação de unicidade.
                            // Sem isto, ao guardar o mesmo email do fornecedor
                            // daria erro de "email já existe".
            'telefone'   => 'nullable|max:15',
        ]);

        // Procura o fornecedor a atualizar — dá erro 404 se não existir
        $fornecedor = Fornecedor::findOrFail($id);

        $fornecedor->nome=$request->nome;
        $fornecedor->morada=$request->morada;
        $fornecedor->localidade=$request->localidade;
        $fornecedor->email=$request->email;
        $fornecedor->telefone=$request->telefone; // Atribui os novos valores aos campos do fornecedor




        // update() faz o UPDATE na base de dados com os dados do formulário.
        // $request->all() retorna todos os campos enviados no formulário.
        // Alternativa mais segura: $request->only(['nome','morada',...])
        // para especificar exatamente quais campos podem ser atualizados.
        $fornecedor->update($request->all());

        return redirect()->route('fornecedor.index') // redireciona para a lista de fornecedores
                         ->with('success', 'Fornecedor atualizado com sucesso!');
                        //  redireciona para a lista de fornecedores com mensagem de sucesso
    }


    /**
     * DESTROY - Elimina um fornecedor da base de dados
     *
     * Rota: DELETE /fornecedores/{id}
     * Chamado quando o utilizador confirma a eliminação de um fornecedor.
     * Nota: formulários HTML não suportam DELETE, por isso na view
     * é necessário usar @method('DELETE') dentro do formulário.
     */
    public function destroy($id)
    {
        // Procura o fornecedor a eliminar — dá erro 404 se não existir
        $fornecedor = Fornecedor::findOrFail($id);

        // delete() faz o DELETE FROM na base de dados
        $fornecedor->delete();

        // Redireciona para a lista após eliminar,
        // com mensagem de confirmação para mostrar ao utilizador
        return redirect()->route('fornecedor.index')
                         ->with('success', 'Fornecedor eliminado com sucesso!');
    }
}
