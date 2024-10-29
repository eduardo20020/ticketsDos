<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ticket #{{$ticket->id}}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="space-y-6">
                        <!-- Información General del Ticket -->
                        <div class="bg-gray-100 p-4 rounded-lg  m-6">
                            <span class="font-semibold text-lg">{{$ticket->asunto}}</span> <br>
                            <span class="font-semibold">De:</span> {{$ticket->correo}}
                        </div>

                        <!-- Mensaje del Ticket -->
                        <div class="bg-gray-100 p-4 rounded-lg m-6">
                            <span class="font-semibold text-lg">Mensaje:</span>
                            <p>{{$ticket->mensaje}}</p>
                        </div>

                        <!-- Información de Gestión del Ticket -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">




                            <!-- Etiqueta -->
                            <div>
                                <label class="font-semibold text-lg">Etiqueta:</label>
                                <input type="text" class="w-full border-gray-300 rounded">
                            </div>


                            <div class="flex justify-between">
                                <!-- Agente -->
                                <div>
                                    <label class="font-semibold text-lg">Agente:</label>
                                    <select class="w-full border-gray-300 rounded">
                                        <option value="">{{$ticket->agente->name}}</option>
                                        <option value="pablo">Pablo</option>
                                        <option value="alma">Alma</option>
                                        <option value="brandon">Brandon</option>
                                    </select>
                                </div>

                                <!-- Estado -->
                                <div>
                                    <label class="font-semibold text-lg">Estado:</label>
                                    <select class="w-full border-gray-300 rounded">
                                        <option value="">{{$ticket->estado}}</option>
                                        <option value="abierto">Abierto</option>
                                        <option value="cerrado">Cerrado</option>
                                    </select>
                                </div>


                                <!-- Tipo -->
                                <div>
                                    <label class="font-semibold text-lg">Tipo:</label>
                                    <select class="w-full border-gray-300 rounded">
                                        <option value="">{{$ticket->tipo}}</option>
                                        <option value="requerimiento">Requerimiento</option>
                                        <option value="incidente">Incidente</option>
                                    </select>
                                </div>


                                <!-- Prioridad -->
                                <div>
                                    <label class="font-semibold text-lg">Prioridad:</label>
                                    <select class="w-full border-gray-300 rounded">
                                        <option value="">{{$ticket->prioridad}}</option>
                                        <option value="baja">Baja</option>
                                        <option value="media">Media</option>
                                        <option value="alta">Alta</option>
                                        <option value="urgente">Urgente</option>
                                    </select>
                                </div>


                                <!-- Grupo -->
                                <div>
                                    <label class="font-semibold text-lg">Grupo:</label>
                                    <select class="w-full border-gray-300 rounded">
                                        <option value="">{{$ticket->grupo}}</option>
                                        <option value="cadereyta">Cadereyta</option>
                                        <option value="garcia">Garcia</option>
                                        <option value="beta">Beta</option>
                                        <option value="pabellon">Pabellon</option>
                                    </select>
                                </div>
                            </div>





                            <!-- Nota -->
                            <div class="col-span-1 sm:col-span-2 lg:col-span-3">
                                <label class="font-semibold text-lg">Nota:</label>
                                <textarea class="w-full border-gray-300 rounded"></textarea>
                            </div>
                        </div>

                        <!-- Botón Eliminar -->
                        <form action="{{ route('delTicket', $ticket->id) }}" method="POST"
                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar este ticket?');" class="mt-6">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-600">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>