<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
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

            <div class="card border-0 border-top border-warning border-3 shadow-sm p-4">

                <!-- Cabeçalho -->
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                    <h4 class="fw-bold m-0 text-dark">Editar Cliente</h4>
                </div>

                <!-- Mensagens de erro de validação -->
                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('client.update', $client->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nome -->
                    <div class="mb-3">
                        <label for="nome" class="form-label fw-semibold">
                            Nome <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               id="nome"
                               name="nome"
                               class="form-control @error('nome') is-invalid @enderror"
                               value="{{ old('nome', $client->nome) }}">
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">
                            Email <span class="text-danger">*</span>
                        </label>
                        <input type="email"
                               id="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $client->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Morada -->
                    <div class="mb-3">
                        <label for="morada" class="form-label fw-semibold">Morada</label>
                        <input type="text"
                               id="morada"
                               name="morada"
                               class="form-control @error('morada') is-invalid @enderror"
                               value="{{ old('morada', $client->morada) }}">
                        @error('morada')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Localidade -->
                    <div class="mb-3">
                        <label for="localidade" class="form-label fw-semibold">Localidade</label>
                        <input type="text"
                               id="localidade"
                               name="localidade"
                               class="form-control @error('localidade') is-invalid @enderror"
                               value="{{ old('localidade', $client->localidade) }}">
                        @error('localidade')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Telefone -->
                    <div class="mb-3">
                        <label for="telefone" class="form-label fw-semibold">Telefone</label>
                        <input type="text"
                               id="telefone"
                               name="telefone"
                               class="form-control @error('telefone') is-invalid @enderror"
                               value="{{ old('telefone', $client->telefone) }}">
                        @error('telefone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Botões -->
                    <div class="pt-2 border-top d-flex gap-3 mt-4">
                        <button type="submit" class="btn btn-warning fw-semibold">
                            &#9998; Guardar alterações
                        </button>
                        <a href="{{ route('client.index') }}"
                           class="btn btn-link text-decoration-none text-muted p-0 mt-2">
                            &larr; Cancelar
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>



</body>
</html>


