<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mis Tareas
            </h2>
            <a href="{{ route('tasks.create') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Nueva Tarea
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($tasks->isEmpty())
                <div class="bg-white p-8 rounded-lg shadow text-center text-gray-500">
                    No tenés tareas todavía. ¡Creá una!
                </div>
            @else
                <div class="grid gap-4">
                    @foreach($tasks as $task)
                        <div class="bg-white p-6 rounded-lg shadow flex justify-between items-start">
                            <div>
                                <h3 class="font-semibold text-lg">{{ $task->title }}</h3>
                                <p class="text-gray-500 text-sm mt-1">{{ $task->description }}</p>
                                <div class="flex gap-2 mt-2">
                                    <span @class([
                                        'px-2 py-1 rounded text-xs font-medium',
                                        'bg-red-100 text-red-700'    => $task->priority === 'high',
                                        'bg-yellow-100 text-yellow-700' => $task->priority === 'medium',
                                        'bg-green-100 text-green-700'  => $task->priority === 'low',
                                    ])>
                                        {{ ucfirst($task->priority) }}
                                    </span>
                                    <span @class([
                                        'px-2 py-1 rounded text-xs font-medium',
                                        'bg-gray-100 text-gray-700'   => $task->status === 'pending',
                                        'bg-blue-100 text-blue-700'   => $task->status === 'in_progress',
                                        'bg-green-100 text-green-700' => $task->status === 'completed',
                                    ])>
                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('tasks.edit', $task) }}"
                                   class="text-blue-500 hover:underline text-sm">
                                    Editar
                                </a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('¿Eliminar esta tarea?')"
                                            class="text-red-500 hover:underline text-sm">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>