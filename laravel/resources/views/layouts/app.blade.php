<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Confeitaria')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f0ff;
            color: #3e206d;
        }

        .navbar {
            background-color: #c8a2c8 !important;
        }

        .navbar .navbar-brand, 
        .navbar .nav-link,
        .navbar .dropdown-item {
            color: white !important;
        }

        .navbar .dropdown-menu {
            background-color: #e3c7ff;
            border: none;
        }

        .navbar .dropdown-item:hover {
            background-color: #d1aaff;
            color: #fff;
        }

        .btn-primary {
            background-color: #b57edc;
            border-color: #b57edc;
        }

        .btn-primary:hover {
            background-color: #a06cd5;
            border-color: #a06cd5;
        }

        .btn-outline-primary {
            color: #a06cd5;
            border-color: #a06cd5;
        }

        .btn-outline-primary:hover {
            background-color: #a06cd5;
            color: #fff;
        }

        .card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 8px rgba(160, 108, 213, 0.15);
        }

        .card-header {
            background-color: #e9d5ff;
            color: #3e206d;
            font-weight: 600;
        }

        .table thead {
            background-color: #e3c7ff;
            color: #3e206d;
        }

        .table-hover tbody tr:hover {
            background-color: #f1e4ff;
        }

        .modal-header {
            background-color: #d1aaff;
            color: #fff;
        }

        .form-control:focus, .form-select:focus {
            border-color: #a06cd5;
            box-shadow: 0 0 0 0.2rem rgba(160, 108, 213, 0.25);
        }

        .alert-success {
            background-color: #d8bfff;
            color: #3e206d;
            border: none;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
        }

        footer {
            text-align: center;
            margin-top: 2rem;
            padding: 1rem 0;
            background-color: #c8a2c8;
            color: #fff;
            border-radius: 8px 8px 0 0;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('sobremesas.index') }}">
                🧁 Confeitaria
            </a>
            <div class="navbar-nav ms-auto">
                @auth('usuarios')
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="fas fa-user"></i> {{ auth('usuarios')->user()->nome }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('sobremesas.index') }}"><i class="fas fa-cookie-bite"></i> Sobremesas</a></li>
                            <li><a class="dropdown-item" href="{{ route('movimentacoes.index') }}"><i class="fas fa-boxes-stacked"></i> Movimentações</a></li>
                            <li><a class="dropdown-item" href="{{ route('historico.index') }}"><i class="fas fa-clock-rotate-left"></i> Histórico</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit"><i class="fas fa-sign-out-alt"></i> Sair</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container my-4">
        @yield('content')
    </div>

    <footer>
        <p>🍰 Sistema Confeitaria — Desenvolvido em Laravel</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
