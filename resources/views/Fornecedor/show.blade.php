<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Fornecedor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

      {{-- Incluir a navbar --}}
    @include('partials.navbar')

    <div class="container my-5">
        {{-- resto do conteúdo --}}
    </div>



<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <!-- Cartão com borda superior azul -->
            <div class="card border-0 border-top border-primary border-3 shadow-sm p-4">

                <!-- Cabeçalho -->
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                    <h4 class="fw-bold m-0 text-dark">Informações do Fornecedor</h4>
                </div>

                <!-- Dados do fornecedor -->
                <div class="row g-3 mb-4">

                    <div class="col-12">
                        <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">Id</span>
                        <div class="fs-5 text-dark mt-1">{{ $fornecedor->id }}</div>
                    </div>

                    <div class="col-12">
                        <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">Nome</span>
                        <div class="fs-5 text-dark mt-1">{{ $fornecedor->nome }}</div>
                    </div>

                    <div class="col-12">
                        <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">Email</span>
                        <div class="fs-6 text-dark mt-1">{{ $fornecedor->email }}</div>
                    </div>

                    <div class="col-12">
                        <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">Morada</span>
                        <div class="fs-6 text-dark mt-1">{{ $fornecedor->morada ?? '—' }}</div>
                    </div>

                    <div class="col-12">
                        <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">Localidade</span>
                        <div class="fs-6 text-dark mt-1">{{ $fornecedor->localidade ?? '—' }}</div>
                    </div>

                    <div class="col-12">
                        <span class="text-muted text-uppercase fw-semibold" style="font-size: 0.75rem;">Telefone</span>
                        <div class="fs-6 text-dark mt-1">{{ $fornecedor->telefone ?? '—' }}</div>
                    </div>

                </div>

                <!-- Botões de ação -->
                <div class="pt-2 border-top d-flex flex-wrap gap-3">

                    <!-- Voltar para a listagem -->
                    <a href="{{ route('fornecedor.index') }}"
                       class="btn btn-link text-decoration-none text-muted p-0">
                        &larr; Voltar para a listagem
                    </a>

                    <!-- Editar fornecedor -->
                    <a href="{{ route('fornecedor.edit', $fornecedor->id) }}"
                       class="btn btn-link text-decoration-none text-warning p-0">
                        &#9998; Editar fornecedor
                    </a>


                    <!-- Eliminar fornecedor -->
                    <form action="{{ route('fornecedor.destroy', $fornecedor->id) }}" method="POST"
                        {{-- // O método POST é necessário para enviar o formulário, mesmo que a ação seja eliminar (DELETE). Laravel interpreta o @method('DELETE') para saber que a intenção é eliminar. --}}
                        onsubmit="return confirm('Tem a certeza que quer eliminar este fornecedor?')">
                        @csrf
                        @method('DELETE')
                        {{-- // O @method('DELETE') é necessário para indicar que a ação pretendida é eliminar, já que os formulários HTML só suportam GET e POST nativamente. Laravel usa isso para processar a requisição corretamente. --}}
                        <button type="submit"
                                class="btn btn-link text-decoration-none text-danger p-0"
                                onclick="return confirm('Tem a certeza que quer eliminar este fornecedor?')">


                                &times; Eliminar fornecedor
                                {{-- // &times; é o símbolo de multiplicação, mas aqui é usado como um "X" para indicar a ação de eliminar. --}}
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>




</body>
</html>
