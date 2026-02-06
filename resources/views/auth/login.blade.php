<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 28px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
        }
        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
        }
        .error {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s;
        }
        button:hover {
            transform: translateY(-2px);
        }
        .register-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }
        .register-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: bold;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
        .forgot-password {
            text-align: right;
            margin-top: 15px;
        }
        .forgot-password a {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
        }
        .forgot-password a:hover {
            text-decoration: underline;
        }
        .alerts {
            margin-bottom: 20px;
        }
        .alert {
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .alert-error {
            background-color: #fee;
            color: #c00;
            border: 1px solid #fcc;
        }
        .alert-success {
            background-color: #efe;
            color: #060;
            border: 1px solid #cfc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Se connecter</h1>

        @if (session('status'))
            <div class="alerts">
                <div class="alert alert-success">{{ session('status') }}</div>
            </div>
        @endif

        @if ($errors->any())
            <div class="alerts">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-error">{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="remember">
                    <input type="checkbox" id="remember" name="remember" value="on">
                    Se souvenir de moi
                </label>
            </div>

            <button type="submit">Se connecter</button>

            <div class="forgot-password">
                <a href="{{ route('password.request') }}">Mot de passe oublié?</a>
            </div>
        </form>

        <div class="register-link">
            Vous n'avez pas de compte? <a href="{{ route('register.form') }}">S'inscrire</a>
        </div>
    </div>
</body>
</html>




