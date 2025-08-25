@props(['tema' => null])

<div class="bg-white p-6 rounded shadow">
    <form method="POST" action="{{ $tema ? route('admin.temas.update', $tema) : route('admin.temas.store') }}">
        @csrf
        @if($tema)
            @method('PUT')
        @endif

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Título</label>
            <input type="text" name="titulo" class="w-full border p-2 rounded"
                   value="{{ old('titulo', $tema->titulo ?? '') }}" required>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Descripción</label>
            <textarea name="descripcion" class="w-full border p-2 rounded">{{ old('descripcion', $tema->descripcion ?? '') }}</textarea>
        </div>

        @if($tema)
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Estado</label>
                <select name="estado" class="w-full border p-2 rounded">
                    <option value="activo" {{ $tema->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="desactivado" {{ $tema->estado == 'desactivado' ? 'selected' : '' }}>Desactivado</option>
                    <option value="borrado" {{ $tema->estado == 'borrado' ? 'selected' : '' }}>Borrado</option>
                </select>
            </div>
        @endif

        <div class="flex items-center justify-between">
            <a href="{{ route('admin.temas.index') }}"
            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium
                    text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                Cancelar
            </a>

            <x-primary-button>
                {{ $tema ? 'Actualizar' : 'Crear' }}
            </x-primary-button>
        </div>
    </form>
</div>
