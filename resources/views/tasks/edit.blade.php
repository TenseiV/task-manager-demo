@extends('layouts.app')

@section('title', 'Modifier la tâche')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Modifier la tâche</h1>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')
            @include('tasks._form')
            <div class="mt-6 flex items-center gap-3">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    Enregistrer
                </button>
                <a href="{{ route('tasks.show', $task) }}" class="text-sm text-gray-600 hover:text-gray-800">Annuler</a>
            </div>
        </form>
    </div>
@endsection
