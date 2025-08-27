{{-- resources/views/admin/lecciones/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lecciones') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('ok'))
            <div class="mb-4 p-3 bg-green-100 rounded">{{ session('ok') }}</div>
        @endif

        <form class="mb-4 flex gap-3">
            <div class="relative inline-block">
                <select name="tema_id" class="appearance-none pr-8 border rounded px-2 py-1">
                    <option value="">— Todos los temas —</option>
                    @foreach($temas as $t)
                    <option value="{{ $t->id }}" @selected($temaId==$t->id)>{{ $t->titulo }}</option>
                    @endforeach
                </select>
                {{-- caret custom --}}
                </div>

                <div class="relative inline-block">
                    <select name="estado" class="appearance-none pr-8 border rounded px-2 py-1">
                        <option value="">Todas</option>
                        <option value="visibles" @selected($estado==='visibles')>Visibles</option>
                        <option value="ocultas"  @selected($estado==='ocultas')>Ocultas</option>
                    </select>
                </div>

            <button class="px-3 py-1 bg-gray-800 text-white rounded">Filtrar</button>

            <a href="{{ route('admin.lecciones.create') }}" class="ml-auto px-3 py-1 bg-blue-600 text-white rounded">
                Nueva lección
            </a>
        </form>

        <div class="bg-white shadow-sm rounded overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="text-left p-2">Tema</th>
                        <th class="text-left p-2">Orden</th>
                        <th class="text-left p-2">Título</th>
                        <th class="text-left p-2">Estado</th>
                        <th class="text-right p-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lecciones as $l)
                        <tr class="border-t">
                            <td class="p-2">{{ $l->tema->titulo ?? '—' }}</td>
                            <td class="p-2">{{ $l->orden }}</td>
                            <td class="p-2">{{ $l->titulo }}</td>
                            <td class="p-2">
                                @if($l->estado)
                                    <span class="px-2 py-1 text-xs rounded bg-green-100">Visible</span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded bg-yellow-100">Oculta</span>
                                @endif
                            </td>
                            <td class="p-2 text-right">
                                <a href="{{ route('admin.lecciones.edit',$l) }}" class="px-2 py-1 text-blue-700">Editar</a>

                                @if($l->estado)
                                    <form action="{{ route('admin.lecciones.destroy',$l) }}" method="POST" class="inline"
                                          onsubmit="return confirm('¿Ocultar la lección?');">
                                        @csrf @method('DELETE')
                                        <button class="px-2 py-1 text-red-700">Ocultar</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.lecciones.restore',$l) }}" method="POST" class="inline"
                                          onsubmit="return confirm('¿Mostrar la lección?');">
                                        @csrf @method('PATCH')
                                        <button class="px-2 py-1 text-green-700">Mostrar</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="p-4 text-center text-gray-500">Sin resultados</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
        <div class="mt-4">{{ $lecciones->links() }}</div>
    </div>
</x-app-layout>
