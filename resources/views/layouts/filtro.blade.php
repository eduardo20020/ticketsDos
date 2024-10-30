<x-slot name="header">

<form method="GET" action="{{route('ticketsFiltrados')}}">
    <div class="flex justify-between">
        <!-- Filtro por Fecha de Creación -->
        <div>
            <label for="fecha" class="block font-medium text-gray-700">Creados:</label>
            <select name="" id="" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <option value="hoy">hoy</option>
                <option value="ayer">ayer</option>
                <option value="hace_7_dias">hace 7 dias</option>
                <option value="hace_30_dias">hace 30 dias</option>
            </select>
        </div>

        <!-- Filtro por Estado -->
        <div>
            <label for="estado" class="block font-medium text-gray-700">Estado:</label>
            <select name="estado" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <option value="">Seleccionar estado</option>
                <option value="abierto" {{ request('estado') == 'abierto' ? 'selected' : '' }}>Abierto</option>
                <option value="cerrado" {{ request('estado') == 'cerrado' ? 'selected' : '' }}>Cerrado</option>
            </select>
        </div>

        <!-- Filtro por Agente -->
        <div>
            <label for="agente" class="block font-medium text-gray-700">Agente:</label>
            <select name="agente" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <option value="">Seleccionar agente</option>
                <!-- Agregar opciones de agentes aquí -->
                <!-- Agregar opciones de agentes aquí -->
                @foreach ($agentes as $agente)
                <option value="{{$agente->id}}">{{$agente->name}}</option>
                @endforeach
            </select>
        </div>

        <!-- Filtro por Grupo -->
        <div>
            <label for="grupo" class="block font-medium text-gray-700">Grupo:</label>
            <select name="grupo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <option value="">Seleccionar grupo</option>
                <option value="cadereyta" {{ request('grupo') == 'cadereyta' ? 'selected' : '' }}>Cadereyta</option>
                <option value="garcia" {{ request('grupo') == 'garcia' ? 'selected' : '' }}>Garcia</option>
                <option value="beta" {{ request('grupo') == 'beta' ? 'selected' : '' }}>Beta</option>
                <option value="pabellon" {{ request('grupo') == 'pabellon' ? 'selected' : '' }}>Pabellon</option>
            </select>
        </div>

        <div class=" flex justify-end">
            <button type="submit" class="bg-blue-500 text-white font-bold px-4 rounded hover:bg-blue-600">Buscar</button>
        </div>
    </div>


</form>

</x-slot>