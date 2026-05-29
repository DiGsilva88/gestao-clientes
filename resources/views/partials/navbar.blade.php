<nav class="navbar navbar-expand-lg navbar-dark bg-black shadow-sm">
    <div class="container">

        <a class="navbar-brand fw-bold" href="{{ route('client.index') }}">
            🏠 Home
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbar">

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">

            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('client.index') }}">
                        <i class="bi bi-people"></i>
                        Clientes
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('fornecedor.index') }}">
                        <i class="bi bi-truck"></i>
                        Fornecedores
                    </a>
                </li>

            </ul>

            <ul class="navbar-nav ms-auto">

                @auth

                    <li class="nav-item dropdown">

                        <a class="nav-link dropdown-toggle"
                           href="#"
                           data-bs-toggle="dropdown">

                            👤 {{ auth()->user()->name }}

                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">

                            <li>
                                <a class="dropdown-item"
                                   href="{{ route('profile.edit') }}">

                                    ⚙️ Perfil

                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>

                                <form action="{{ route('logout') }}"
                                      method="POST">

                                    @csrf

                                    <button type="submit"
                                            class="dropdown-item text-danger">

                                        🚪 Sair

                                    </button>

                                </form>

                            </li>

                        </ul>

                    </li>

                @endauth

                @guest

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            Login
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            Registar
                        </a>
                    </li>

                @endguest

            </ul>

        </div>
    </div>
</nav>
