<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Fornecedores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #f4f6f9;
        }
        .card {
            border-radius: 15px;
        }
        .table td, .table th {
            vertical-align: middle;
        }
        .search-bar {
            max-width: 400px; /* ← limita a largura da pesquisa */
        }
    </style>
</head>
<body>

    @include('partials.navbar')

    <div class="container mt-5">

        <!-- Cabeçalho + botão inserir -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="fw-bold display-6 text-dark">
                <i class="bi bi-truck me-2"></i>Fornecedores
            </h1>
            <a href="{{ route('fornecedor.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Novo Fornecedor
            </a>
        </div>

        <!-- Barra de pesquisa compacta -->
        <form action="{{ route('fornecedor.index') }}" method="GET" class="mb-4">
            <div class="input-group search-bar shadow-sm">
                <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-search text-muted"></i>

                </span>
                <input type="text"
                       name="search"
                       class="form-control border-start-0"
                       placeholder="Pesquisar por nome ou email..."
                       value="{{ request('search') }}">
                @if(request('search'))
                    <a href="{{ route('fornecedor.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-lg"></i>
                    </a>

                @endif
                <button type="submit" class="btn btn-dark">
                    Pesquisar
                </button>
            </div>
        </form>


        {{-- Mensagem de sucesso --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        
        <!-- Tabela -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4" style="width: 60px">ID</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th class="text-end pe-4">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fornecedores as $fornecedor)
                            <tr>
                                <td class="ps-4 text-muted">{{ $fornecedor->id }}</td>
                                <td class="fw-semibold">{{ $fornecedor->nome }}</td>
                                <td class="text-muted">{{ $fornecedor->email }}</td>
                                <td class="text-end pe-4">
                                    <div class="d-flex gap-2 justify-content-end">

                                        <a href="{{ route('fornecedor.show', $fornecedor->id) }}"
                                           class="btn btn-outline-primary btn-sm px-3">
                                            <i class="bi bi-eye me-1"></i>Ver
                                        </a>

                                        <a href="{{ route('fornecedor.edit', $fornecedor->id) }}"
                                           class="btn btn-outline-warning btn-sm px-3">
                                            <i class="bi bi-pencil me-1"></i>Editar
                                        </a>

                                        <form action="{{ route('fornecedor.destroy', $fornecedor->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Tem a certeza que quer eliminar este fornecedor?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm px-3">
                                                <i class="bi bi-trash me-1"></i>Excluir
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>
