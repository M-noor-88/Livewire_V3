<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Task PDF</title>
    <style>
        body { font-family: sans-serif; }
        h1 { color: #333; }
        .label { font-weight: bold; margin-top: 10px; }
    </style>
</head>
<body>
<h1>Task #{{ $task->id }} - {{ $task->title }}</h1>
<div style="position: absolute; top: 0; right: 0; padding: 10px;">
    <img src="{{ public_path('download.png') }}" width="100" style="display: block;">
</div>
<p><span class="label">Description:</span> {{ $task->description ?? 'N/A' }}</p>
<p><span class="label">Status:</span> {{ ucfirst($task->status) }}</p>
<p><span class="label">Created At:</span> {{ $task->created_at->format('Y-m-d H:i') }}</p>
<p><span class="label">Created by:</span> {{ $user->name ?? 'Unkown'}}</p>

</body>
</html>
