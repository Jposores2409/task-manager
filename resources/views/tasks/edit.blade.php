<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Tarea
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-lg shadow">

                <form action="{{ route('tasks.update', $task) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Título *</label>
                        <input type="text" name="title" value="{{ old('title', $task->title) }}"
                               class="w-full border rounded px-3 py-2 @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea name="description" rows="3"
                                  class="w-full border rounded px-3 py-2">{{ old('description', $task->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Prioridad *</label>
                        <select name="priority" class="w-full border rounded px-3 py-2">
                            <option value="low"    {{ old('priority', $task->priority) === 'low'    ? 'selected' : '' }}>Baja</option>
                            <option value="medium" {{ old('priority', $task->priority) === 'medium' ? 'selected' : '' }}>Media</option>
                            <option value="high"   {{ old('priority', $task->priority) === 'high'   ? 'selected' : '' }}>Alta</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estado *</label>
                        <select name="status" class="w-full border rounded px-3 py-2">
                            <option value="pending"     {{ old('status', $task->status) === 'pending'     ? 'selected' : '' }}>Pendiente</option>
                            <option value="in_progress" {{ old('status', $task->status) === 'in_progress' ? 'selected' : '' }}>En progreso</option>
                            <option value="completed"   {{ old('status', $task->status) === 'completed'   ? 'selected' : '' }}>Completada</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha límite</label>
                        <input type="date" name="due_date" value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="flex gap-3">
                        <button type="submit"
                                class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                            Guardar Cambios
                        </button>
                        <a href="{{ route('tasks.index') }}"
                           class="text-gray-500 px-6 py-2 rounded border hover:bg-gray-50">
                            Cancelar
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>