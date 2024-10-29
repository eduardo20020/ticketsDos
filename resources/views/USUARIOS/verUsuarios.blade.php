<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight ">
            <a class="border py-4 rounded border item px-4"
                href="{{route('register')}}">{{ __('Crear un nuevo usuario') }}</a>
        </h2>
    </x-slot>

    @foreach ($usuarios as $usuario)
        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg item">
                    <div class="p-6 text-gray-900">
                        <div class="flex items-center justify-between">
                            <span>Nombre: {{$usuario->name}}</span>
                            <form action="{{ route('delUsuarios', $usuario->id) }}" method="POST"
                                onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
                                @csrf
                                @method('DELETE') <!-- Esto es necesario para indicar que es un DELETE -->
                                <button type="submit" class="bg-red-500 px-4 py-2 rounded">Eliminar</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>