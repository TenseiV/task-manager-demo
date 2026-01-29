@extends('layouts.app')

@section('title', $task->title)

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">{{ $task->title }}</h1>
        <div class="flex items-center gap-3">
            <a href="{{ route('tasks.edit', $task) }}"
               class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">
                Modifier
            </a>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-100 text-red-700 text-sm font-medium rounded-lg hover:bg-red-200 transition-colors"
                        onclick="return confirm('Supprimer cette tâche ?')">
                    Supprimer
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="flex items-center gap-3 mb-6">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $task->status->color() }}">
                {{ $task->status->label() }}
            </span>
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $task->priority->color() }}">
                {{ $task->priority->label() }}
            </span>
            @if ($task->due_date)
                <span class="text-sm text-gray-500">
                    Échéance : {{ $task->due_date->format('d/m/Y') }}
                </span>
            @endif
        </div>

        @if ($task->description)
            <div class="prose prose-sm max-w-none text-gray-700">
                {!! nl2br(e($task->description)) !!}
            </div>
        @else
            <p class="text-gray-400 italic">Aucune description.</p>
        @endif

        <div class="mt-6 pt-4 border-t border-gray-200 text-sm text-gray-500">
            Créée le {{ $task->created_at->format('d/m/Y à H:i') }}
            · Modifiée le {{ $task->updated_at->format('d/m/Y à H:i') }}
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('tasks.index') }}" class="text-sm text-gray-600 hover:text-gray-800">← Retour à la liste</a>
    </div>
@endsection
