@props([
    'action',          // ruta del form (store/update)
    'method' => 'POST',// POST | PUT
    'leccion',         // instancia de Leccion (nueva o existente)
    'temas' => [],     // colección de temas para el select
])

<form method="POST" action="{{ $action }}" class="bg-white p-4 rounded shadow">
    @csrf
    @if (strtoupper($method) !== 'POST')
        @method($method)
    @endif

    {{-- Tema --}}
    <div class="mb-3">
        <label class="block mb-1">Tema</label>
        <select name="tema_id" class="w-full border rounded px-2 py-1" required>
            <option value="">— Seleccionar —</option>
            @foreach($temas as $t)
                <option value="{{ $t->id }}"
                    @selected(old('tema_id', $leccion->tema_id) == $t->id)>
                    {{ $t->titulo }}
                </option>
            @endforeach
        </select>
        @error('tema_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Orden --}}
    <div class="mb-3">
        <label class="block mb-1">Orden</label>
        <input type="number" name="orden" min="1" class="w-full border rounded px-2 py-1"
               value="{{ old('orden', $leccion->orden ?? 1) }}">
        @error('orden') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Título --}}
    <div class="mb-3">
        <label class="block mb-1">Título</label>
        <input type="text" name="titulo" class="w-full border rounded px-2 py-1"
               value="{{ old('titulo', $leccion->titulo) }}" required>
        @error('titulo') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Descripción --}}
    <div class="mb-3">
        <label class="block mb-1">Descripción</label>
        <textarea name="descripcion" rows="4" class="w-full border rounded px-2 py-1">{{ old('descripcion', $leccion->descripcion) }}</textarea>
        @error('descripcion') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    {{-- Estado (visible/oculta) --}}
    <div class="mb-5">
        <label class="inline-flex items-center gap-2">
            <input type="checkbox" name="estado" value="1"
                   @checked(old('estado', $leccion->estado ?? true))>
            Visible para usuarios
        </label>
        @error('estado') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="flex gap-2">
        <button class="px-4 py-2 bg-blue-600 text-white rounded">
            {{ strtoupper($method) === 'POST' ? 'Crear lección' : 'Guardar cambios' }}
        </button>
        <a href="{{ route('admin.lecciones.index') }}" class="px-4 py-2 bg-gray-200 rounded">Volver</a>
    </div>
</form>
