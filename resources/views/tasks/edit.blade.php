<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la tâche</title>
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
            padding: 20px;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 600px;
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
        input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: border-color 0.3s;
        }
        input:focus, textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
        }
        textarea {
            resize: vertical;
            min-height: 150px;
        }
        .error {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
        }
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 15px;
            background: #f5f5f5;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .checkbox-group input[type="checkbox"] {
            width: 20px;
            height: 20px;
            accent-color: #667eea;
        }
        .checkbox-group label {
            margin: 0;
            font-weight: normal;
        }
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }
        button, .btn-cancel {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.2s;
            text-decoration: none;
            text-align: center;
        }
        button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        button:hover {
            transform: translateY(-2px);
        }
        .btn-cancel {
            background: #e8e8e8;
            color: #333;
        }
        .btn-cancel:hover {
            background: #d8d8d8;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Modifier la tâche</h1>

        @if ($errors->any())
            <div class="alerts">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-error">{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Titre de la tâche</label>
                <input type="text" id="title" name="title" value="{{ old('title', $task->title) }}" required autofocus>
                @error('title')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description">{{ old('description', $task->description) }}</textarea>
                @error('description')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="checkbox-group">
                <input type="checkbox" id="is_completed" name="is_completed" value="1"
                       {{ old('is_completed', $task->is_completed) ? 'checked' : '' }}>
                <label for="is_completed">Marquer cette tâche comme terminée</label>
            </div>

            <div class="button-group">
                <button type="submit">Mettre à jour la tâche</button>
                <a href="{{ route('tasks.index') }}" class="btn-cancel">Annuler</a>
            </div>
        </form>
    </div>
</body>
</html>




