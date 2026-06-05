<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Artigo</title>

    {{-- Bootstrap CSS — framework de estilos para tornar a página responsiva e bonita --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    {{-- Bootstrap JS — necessário para componentes interativos do Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</head>
<body>

{{-- container — centraliza o conteúdo na página com margens laterais --}}
<div class="container mt-4">
    <div class="row">

        {{-- col-md-8 offset-md-2 — ocupa 8 colunas centradas num ecrã médio --}}
        <div class="col-md-8 offset-md-2">
            <div class="card">

                <div class="card-header">
                    <h3>Novo Artigo</h3>
                </div>

                <div class="card-body">

                    {{-- Bloco de erros geral — aparece no topo se houver erros de validação --}}
                    {{-- $errors é automaticamente disponibilizado pelo Laravel --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                {{-- Percorre todos os erros e exibe cada um numa linha --}}
                                @foreach($errors->all() as $erro)
                                    <li>{{ $erro }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Formulário — action define para onde os dados são enviados --}}
                    {{-- method POST — envia os dados de forma segura (não aparece no URL) --}}
                    <form action="{{ route('artigos.store') }}" method="POST">

                        {{-- @csrf — token de segurança obrigatório em todos os formulários POST --}}
                        {{-- protege contra ataques CSRF (pedidos falsos de outros sites) --}}
                        @csrf

                        {{-- Campo Descrição --}}
                        <div class="mb-3">
                            {{-- label for="descricao" liga a label ao input pelo id --}}
                            <label for="descricao" class="form-label">Descrição</label>

                            {{-- @error('descricao') adiciona a classe is-invalid se houver erro neste campo --}}
                            {{-- old('descricao') mantém o valor preenchido após um erro de validação --}}
                            <input type="text" name="descricao" id="descricao"
                                class="form-control @error('descricao') is-invalid @enderror"
                                value="{{ old('descricao') }}">

                            {{-- Mensagem de erro específica do campo descricao --}}
                            @error('descricao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo Características --}}
                        <div class="mb-3">
                            <label for="caracteristicas" class="form-label">Características</label>

                            {{-- textarea para texto longo (várias linhas) --}}
                            {{-- old('caracteristicas') recupera o texto após erro --}}
                            <textarea name="caracteristicas" id="caracteristicas"
                                class="form-control @error('caracteristicas') is-invalid @enderror">{{ old('caracteristicas') }}</textarea>

                            @error('caracteristicas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo Preço --}}
                        <div class="mb-3">
                            <label for="preco" class="form-label">Preço</label>

                            {{-- type="number" — apenas aceita números --}}
                            {{-- step="0.01" — permite casas decimais (ex: 9.99) --}}
                            {{-- min="0" — não permite valores negativos --}}
                            <input type="number" name="preco" id="preco"
                                class="form-control @error('preco') is-invalid @enderror"
                                step="0.01" min="0" value="{{ old('preco') }}" required>

                            @error('preco')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Campo Categoria --}}
                        <div class="mb-3">
                            <label for="categoria_id" class="form-label">Categoria</label>

                            {{-- select — lista suspensa para escolher uma opção --}}
                            <select name="categoria_id" id="categoria_id"
                                class="form-select @error('categoria_id') is-invalid @enderror" required>


                                 <div class="foto">Escolha a categoria do artigo.</div>
                                {{-- Opção vazia por defeito, obriga o utilizador a escolher --}}
                                <option value="{{ old('categoria_id') }}">-- Seleciona categoria --</option>

                                {{-- @foreach percorre as categorias enviadas pelo controller --}}
                                {{-- O controller faz: $categorias = Categoria::all() --}}
                                @foreach($categorias as $categoria)
                                    {{-- selected mantém a categoria escolhida após erro de validação --}}
                                    <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->categoria }} {{-- Exibe o nome da categoria na opção --}}
                                    </option>
                                @endforeach
                            </select>







 {{-- Campo Foto --}}
<div class="mb-3">
    <label for="foto" class="form-label">Foto</label>
    <input type="file" name="foto" id="foto"
        class="form-control @error('foto') is-invalid @enderror"
        accept="image/*">
    @error('foto')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    <form action="{{ route('artigos.store') }}" method="POST" enctype="multipart/form-data">
        {{-- // enctype="multipart/form-data" é necessário para upload de arquivos --}}
</div>

             {{-- Mensagem de erro específica do campo categoria_id --}}

                            @error('categoria_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Criar Artigo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
