<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes tâches</title>
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
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        .header {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        .header h1 {
            color: #333;
            font-size: 32px;
        }
        .user-info {
            text-align: right;
            color: #666;
        }
        .user-info p {
            margin: 5px 0;
        }
        .logout-btn {
            background: #e74c3c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }
        .logout-btn:hover {
            background: #c0392b;
        }
        .btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: transform 0.2s;
        }
        .btn:hover {
            transform: translateY(-2px);
        }
        .btn-small {
            padding: 8px 16px;
            font-size: 14px;
        }
        .btn-danger {
            background: #e74c3c;
        }
        .btn-danger:hover {
            background: #c0392b;
        }
        .btn-success {
            background: #27ae60;
        }
        .btn-success:hover {
            background: #229954;
        }
        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .tasks-grid {
            display: grid;
            gap: 20px;
        }
        .task-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: start;
            gap: 20px;
        }
        .task-card.completed {
            opacity: 0.7;
        }
        .task-card.completed .task-title {
            text-decoration: line-through;
            color: #999;
        }
        .task-content {
            flex: 1;
        }
        .task-title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
        }
        .task-description {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
            line-height: 1.5;
        }
        .task-date {
            color: #999;
            font-size: 12px;
        }
        .task-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }
        .empty-state {
            background: white;
            padding: 60px 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        .empty-state h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .empty-state p {
            color: #666;
            margin-bottom: 20px;
        }
        .checkbox {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: #667eea;
        }
        .form-inline {
            display: inline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Mes tâches</h1>
            <div>
                <div class="user-info">
                    <p><strong>{{ auth()->user()->name }}</strong></p>
                    <p>{{ auth()->user()->email }}</p>
                </div>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Déconnexion</button>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div style="margin-bottom: 30px;">
            <a href="{{ route('tasks.create') }}" class="btn">Nouvelle tâche</a>
        </div>

        @if ($tasks->count() > 0)
            <div class="tasks-grid">
                @foreach ($tasks as $task)
                    <div class="task-card {{ $task->is_completed ? 'completed' : '' }}">
                        <div style="display: flex; gap: 15px; flex: 1;">
                            <form action="{{ route('tasks.toggle', $task) }}" method="POST" class="form-inline">
                                @csrf
                                @method('PATCH')
                                <input type="checkbox" class="checkbox"
                                       {{ $task->is_completed ? 'checked' : '' }}
                                       onchange="this.form.submit()">
                            </form>
                            <div class="task-content">
                                <div class="task-title">{{ $task->title }}</div>
                                @if ($task->description)
                                    <div class="task-description">{{ $task->description }}</div>
                                @endif
                                <div class="task-date">
                                    Créée le {{ $task->created_at->format('d/m/Y à H:i') }}
                                </div>
                            </div>
                        </div>
                        <div class="task-actions">
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-small">Modifier</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                  style="display: inline;"
                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-small btn-danger">Supprimer</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <h2>Aucune tâche pour le moment</h2>
                <p>Créez votre première tâche pour commencer à organiser votre travail</p>
                <a href="{{ route('tasks.create') }}" class="btn">Créer une tâche</a>
            </div>
        @endif
    </div>
</body>
</html>
