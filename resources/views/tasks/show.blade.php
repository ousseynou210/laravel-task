<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $task->title }}</title>
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
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .status-completed {
            background: #d4edda;
            color: #155724;
        }
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        h1 {
            color: #333;
            font-size: 28px;
            margin-bottom: 15px;
            word-break: break-word;
        }
        .task-info {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .info-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .info-item:last-child {
            border-bottom: none;
        }
        .info-label {
            color: #666;
            font-weight: 500;
        }
        .info-value {
            color: #333;
            text-align: right;
        }
        .description {
            margin: 30px 0;
        }
        .description-title {
            color: #666;
            font-weight: 500;
            margin-bottom: 10px;
        }
        .description-content {
            color: #333;
            line-height: 1.6;
            background: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }
        .btn {
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
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
        }
        .btn-secondary {
            background: #e8e8e8;
            color: #333;
        }
        .btn-secondary:hover {
            background: #d8d8d8;
        }
        .btn-danger {
            background: #e74c3c;
            color: white;
        }
        .btn-danger:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>
        <div class="container">
        <div class="status-badge {{ $task->is_completed ? 'status-completed' : 'status-pending' }}">
            {{ $task->is_completed ? 'Terminée' : 'En cours' }}
        </div>

        <h1>{{ $task->title }}</h1>

        <div class="task-info">
            <div class="info-item">
                <span class="info-label">Créée le :</span>
                <span class="info-value">{{ $task->created_at->format('d/m/Y à H:i') }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Dernière modification :</span>
                <span class="info-value">{{ $task->updated_at->format('d/m/Y à H:i') }}</span>
            </div>
        </div>

        @if ($task->description)
            <div class="description">
                <div class="description-title">Description :</div>
                <div class="description-content">{{ $task->description }}</div>
            </div>
        @endif

        <div class="button-group">
            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary">Modifier</a>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Retour</a>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="flex: 1;"
                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" style="width: 100%;">Supprimer</button>
            </form>
        </div>
    </div>
</body>
</html>







