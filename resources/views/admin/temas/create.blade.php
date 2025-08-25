<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Nuevo Tema') }}
        </h2>
    </x-slot>
    

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <x-admin.form-tema />
        </div>
    </div>
</x-app-layout>
