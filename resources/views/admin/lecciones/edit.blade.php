<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Editar Lección') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <x-admin.form-leccion
                :action="route('admin.lecciones.update', $leccion)"
                method="PUT"
                :leccion="$leccion"
                :temas="$temas"
            />
        </div>
    </div>
</x-app-layout>
