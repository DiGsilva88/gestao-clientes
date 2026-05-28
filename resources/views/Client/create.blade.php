<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de clientes</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <div class="container min-vh-100 d-flex justify-content-center align-items-center my-5">

        <!-- Cartão para limitar a largura e estruturar o formulário -->
        <div class="card shadow-sm p-4 w-100" style="max-width: 600px;">

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h2 text-center">Inserir novo cliente</h1>
            {{-- <a href="{{route('client.create')}}"class="btn btn-primary">Inserir novo cliente</a> --}}
            {{-- //botão para inserir novo cliente --}}
            {{-- definir a rota =route --}}
            {{-- depois chamamos a rota e usamos as {{}}--}}


        </div>

        @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{route('client.store')}}" method="POST">
    {{-- usar metodo post que vai gravar--}}
{{-- construir o form --}}
@csrf
{{-- evita que os dados sejam roubados,usar sempre o csrf --}}

<div class="mb-3">
<label for="nome">Nome</label><input type="text" name="nome" id="lb_nome">
{{-- lb_nome para fazer distinção --}}
</div>
<div class="mb-3">
<label for="Morada">Morada</label><input type="text" name="morada" id="lb_morada">
{{-- lb_xxx para fazer distinção --}}
</div>

<div class="mb-3">
<label for="Localidade">Localidade</label><input type="text" name="localidade" id="lb_localidade">
{{-- lb_xxx para fazer distinção --}}
</div>


<!-- Linha dupla para Telefone e Email (otimiza o espaço) -->
<div class="row">
<div class="mb-3">
<label for="Telefone">Telefone</label><input type="text" name="telefone" id="lb_telefone">
{{-- lb_xxx para fazer distinção --}}
</div>


<div class="mb-3">
<label for="Email">Email</label><input type="text" name="email" id="lb_email">
{{-- lb_xxx para fazer distinção --}}
</div>
  </div>

<!-- Botões de Ação Alinhados -->
     <div class="d-flex justify-content-end gap-2 mt-4">
    <a href="#" class="btn btn-secondary">Cancelar</a>
    <button type="submit" class="btn btn-success">Gravar Cliente</button>
    </div>

</form>

    </div>


</body>
</html>


