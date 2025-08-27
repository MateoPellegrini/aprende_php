<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Nueva Lección') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <x-admin.form-leccion
                :action="route('admin.lecciones.store')"
                method="POST"
                :leccion="new \App\Models\Leccion"
                :temas="$temas"
            />
        </div>
    </div>
</x-app-layout>
