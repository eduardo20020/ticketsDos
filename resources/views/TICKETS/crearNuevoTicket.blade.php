<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear nuevo ticket') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('CrearTicket') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="email" class="block text-gray-700 font-bold mb-2">Correo:</label>
                                <input type="email" id="email" name="email"
                                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required>
                            </div>
                            <div>
                                <label for="subject" class="block text-gray-700 font-bold mb-2">Asunto:</label>
                                <input type="text" id="subject" name="subject"
                                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-gray-700 font-bold mb-2">Mensaje:</label>
                            <textarea id="message" name="message" rows="4"
                                class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required></textarea>
                        </div>
                        <div class="flex justify-between mb-4">

                            <!-- Agente -->
                            <div class="px-4">
                                <label for="agent" class="font-semibold text-lg">Agente:</label>
                                <select id="agent" name="agent" class="w-full border-gray-300 rounded">
                                    <option value="">Seleccionar agente</option>
                                    
                                    @foreach ($usuarios as $usuario)
                                    <option value="{{$usuario->id}}">{{$usuario->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Estado -->
                            <div class="px-4">
                                <label for="estado" class="font-semibold text-lg">Estado:</label>
                                <select id="estado" name="estado" class="w-full border-gray-300 rounded">
                                    <option value="abierto">Abierto</option>
                                    <option value="cerrado">Cerrado</option>
                                </select>
                            </div>

                            <!-- Tipo -->
                            <div class="px-4">
                                <label for="tipo" class="font-semibold text-lg">Tipo:</label>
                                <select id="tipo" name="tipo" class="w-full border-gray-300 rounded">
                                    <option value="requerimiento">Requerimiento</option>
                                    <option value="incidente">Incidente</option>
                                </select>
                            </div>

                            <!-- Prioridad -->
                            <div class="px-4">
                                <label for="prioridad" class="font-semibold text-lg">Prioridad:</label>
                                <select id="prioridad" name="prioridad" class="w-full border-gray-300 rounded">
                                    <option value="baja">Baja</option>
                                    <option value="media">Media</option>
                                    <option value="alta">Alta</option>
                                    <option value="urgente">Urgente</option>
                                </select>
                            </div>

                            <!-- Grupo -->
                            <div class="px-4">
                                <label for="grupo" class="font-semibold text-lg">Grupo:</label>
                                <select id="grupo" name="grupo" class="w-full border-gray-300 rounded">
                                    <option value="">Seleccionar grupo</option>
                                    <option value="cadereyta">Cadereyta</option>
                                    <option value="garcia">Garcia</option>
                                    <option value="beta">Beta</option>
                                    <option value="pabellon">Pabellon</option>
                                </select>
                            </div>

                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-600">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>