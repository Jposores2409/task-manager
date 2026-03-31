<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nueva Tarea
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-lg shadow">

                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Título *
                        </label>
                        <input type="text" name="title" value="{{ old('title') }}"
                               class="w-full border rounded px-3 py-2 @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Descripción
                        </label>
                        <textarea name="description" rows="3"
                                  class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Prioridad *
                        </label>
                        <select name="priority" class="w-full border rounded px-3 py-2">
                            <option value="low"    {{ old('priority') === 'low'    ? 'selected' : '' }}>Baja</option>
                            <option value="medium" {{ old('priority') === 'medium' ? 'selected' : '' }} selected>Media</option>
                            <option value="high"   {{ old('priority') === 'high'   ? 'selected' : '' }}>Alta</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Fecha límite
                        </label>
                        <input type="date" name="due_date" value="{{ old('due_date') }}"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="flex gap-3">
                        <button type="submit"
                                class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                            Crear Tarea
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