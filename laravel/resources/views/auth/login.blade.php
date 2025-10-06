<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Confeitaria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #c8a2c8 0%, #f8f0ff 100%);
            color: #3e206d;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(160, 108, 213, 0.2);
            padding: 2.5rem;
            width: 380px;
            text-align: center;
        }

        .btn-login {
            background-color: #b57edc;
            border: none;
        }

        .btn-login:hover {
            background-color: #a06cd5;
        }

        h3 {
            color: #4a148c;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h3>🧁 Confeitaria</h3>
        <p class="text-muted mb-4">Entre para gerenciar as sobremesas</p>

        @if($errors->any())
            <div class="alert alert-danger small">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <input type="text" name="nome" class="form-control" placeholder="Usuário" required autofocus>
            </div>
            <div class="mb-3">
                <input type="password" name="senha" class="form-control" placeholder="Senha" required>
            </div>
            <button class="btn btn-login w-100 text-white">Entrar</button>
        </form>

        <div class="mt-4 small text-muted">
            <p>Admin / admin123</p>
            <p>Gerente / gerente123</p>
            <p>Atendente / atendente123</p>
        </div>
    </div>
</body>
</html>
