<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Temas') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 rounded bg-green-100 text-green-800 p-3">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Botón nuevo tema --}}
            <div class="mb-4">
                <a href="{{ route('admin.temas.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent
                          rounded-md font-semibold text-xs text-white uppercase tracking-widest
                          hover:bg-blue-700 focus:outline-none transition">
                    {{ __('Nuevo Tema') }}
                </a>
            </div>

            {{-- Filtro: Ver borrados --}}
            <div class="mb-4 px-4 py-3 bg-white rounded shadow-sm flex justify-between items-center">

                <form method="GET" action="{{ route('admin.temas.index') }}" class="flex items-center gap-3">
                    <label class="inline-flex items-center space-x-2">
                        <input type="checkbox" name="ver_borrados" value="1"
                        @checked($verBorrados) onchange="this.form.submit()"
                        class="rounded">
                        <span>Ver borrados</span>
                    </label>
                    
                    @if($verBorrados)
                    <a href="{{ route('admin.temas.index') }}" class="text-sm underline">
                        Quitar filtro
                    </a>
                    @endif
                </form>
            </div>
            {{-- /Filtro --}}


            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Título</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($temas as $tema)
                            <tr>
                                <td class="px-6 py-4">{{ $tema->id }}</td>
                                <td class="px-6 py-4">{{ $tema->titulo }}</td>
                                <td class="px-6 py-4 capitalize">{{ $tema->estado }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('admin.temas.edit', $tema) }}"
                                       class="text-blue-600 hover:underline">Editar</a>

                                    <form action="{{ route('admin.temas.destroy', $tema) }}" method="POST"
                                          class="inline"
                                          onsubmit="return confirm('¿Marcar como borrado?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Borrar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td class="px-6 py-4" colspan="4">Sin registros</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
