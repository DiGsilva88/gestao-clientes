<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * INDEX - Lista todos os clientes
     *
     * Rota: GET /clients
     * Chamado quando o utilizador acede à página principal de clientes.
     * Vai buscar todos os registos da tabela 'clients' e envia-os para a view.
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

    $clients = Client::when($search, function ($query, $search) {

            $query->where('nome', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');

        })

        ->orderBy('nome', $ordem)

        ->paginate(10)

        ->appends($request->query());

    return view('Client.index', compact('clients'));
}

    /**
     * CREATE - Mostra o formulário para criar um novo cliente
     *
     * Rota: GET /clients/create
     * Apenas carrega a view com o formulário vazio.
     * Não faz nenhuma operação na base de dados.
     */

    public function create()
    {
        // Carrega a view 'resources/views/Client/create.blade.php'
        return view('Client.create');
    }


    /**
     * STORE - Guarda um novo cliente na base de dados
     *
     * Rota: POST /clients
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
            'email'      => 'required|email|unique:clients,email',
                            // obrigatório, formato email válido,
                            // e único na coluna 'email' da tabela 'clients'
            'telefone'   => 'nullable|max:15',    // opcional, máximo 15 caracteres
        ]);

        // INSERÇÃO: cria um novo registo na base de dados com os dados validados.
        // O método create() faz o INSERT INTO automaticamente.
        // Atenção: os campos têm de estar na propriedade $fillable do Model Client.
        Client::create([
            'nome'       => $request->nome,
            'morada'     => $request->morada,
            'localidade' => $request->localidade,
            'telefone'   => $request->telefone,
            'email'      => $request->email,
        ]);

        // Redireciona para a lista de clientes (rota 'clients.index')
        // with('success', '...') envia uma mensagem temporária (flash message)
        // que pode ser mostrada na view com: session('success')
        return redirect()->route('client.index')
                         ->with('success', 'Cliente inserido com sucesso');
    }


    /**
     * SHOW - Mostra os detalhes de um cliente específico
     *
     * Rota: GET /clients/{id}
     * Recebe o $id do cliente através do URL (ex: /clients/3).
     */
    public function show($id) // O nome do parâmetro $id tem de ser igual ao definido na rota (Route::resource define isso automaticamente).
    {
        // findOrFail() procura o cliente pelo ID na base de dados.
        // Se não encontrar, lança automaticamente um erro 404 (página não encontrada).
        // Alternativa: find($id) retornaria null em vez de erro 404.
        $client = Client::findOrFail($id);

        // Envia os dados do cliente para a view de detalhe
        return view('Client.show', compact('client'));
    }


    /**
     * EDIT - Mostra o formulário para editar um cliente existente
     *
     * Rota: GET /clients/{id}/edit
     * Semelhante ao show(), mas carrega uma view com formulário preenchido
     * com os dados atuais do cliente para o utilizador poder alterar.
     */
    public function edit($id)
    {
        // Procura o cliente pelo ID — dá erro 404 se não existir
        $client = Client::findOrFail($id);

        // Carrega a view 'resources/views/Client/edit.blade.php'
        // com os dados do cliente já preenchidos no formulário
        return view('Client.edit', compact('client'));
    }


    /**
     * UPDATE - Guarda as alterações de um cliente existente
     *
     * Rota: PUT /clients/{id}
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
            'email'      => 'required|email|unique:clients,email,' . $id,
                            // O ', $id' no final diz ao Laravel para IGNORAR
                            // este registo na verificação de unicidade.
                            // Sem isto, ao guardar o mesmo email do cliente
                            // daria erro de "email já existe".
            'telefone'   => 'nullable|max:15',
        ]);

        // Procura o cliente a atualizar — dá erro 404 se não existir
        $client = Client::findOrFail($id);

        $client->nome=$request->nome;
        $client->morada=$request->morada;
        $client->localidade=$request->localidade;
        $client->email=$request->email;
        $client->telefone=$request->telefone; // Atribui os novos valores aos campos do cliente




        // update() faz o UPDATE na base de dados com os dados do formulário.
        // $request->all() retorna todos os campos enviados no formulário.
        // Alternativa mais segura: $request->only(['nome','morada',...])
        // para especificar exatamente quais campos podem ser atualizados.
        $client->update($request->all());

        return redirect()->route('client.index') // redireciona para a lista de clientes
                         ->with('success', 'Cliente atualizado com sucesso!');
                        //  redireciona para a lista de clientes com mensagem de sucesso
    }


    /**
     * DESTROY - Elimina um cliente da base de dados
     *
     * Rota: DELETE /clients/{id}
     * Chamado quando o utilizador confirma a eliminação de um cliente.
     * Nota: formulários HTML não suportam DELETE, por isso na view
     * é necessário usar @method('DELETE') dentro do formulário.
     */
    public function destroy($id)
    {
        // Procura o cliente a eliminar — dá erro 404 se não existir
        $client = Client::findOrFail($id);

        // delete() faz o DELETE FROM na base de dados
        $client->delete();

        // Redireciona para a lista após eliminar,
        // com mensagem de confirmação para mostrar ao utilizador
        return redirect()->route('client.index')
                         ->with('success', 'Cliente eliminado com sucesso!');
    }
}
