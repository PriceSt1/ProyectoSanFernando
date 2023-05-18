<div>
    <div class="mt-2 table-responsive-md">
        <br>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h1 style="text-align: center; padding: 15px">PROFESORES</h1>
        <div class="table-wrapper-scroll-y my-custom-scrollbar">
            <table class="table mb-0 tabla-scroll " style="width:100%; margin:auto; text-align: center;">
            <thead>
            <tr>
                <th>Nick</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Email</th>
                <th>Cambiar contraseña</th>
                <th>Modificar</th>
                <th>Eliminar</th>
            </tr>
            </thead>
            <tbody>
                @foreach($profesores as $profesor)
                        <tr class="table" style="text-align: center; background: #F6F0D2">
                            <td>{{$profesor->nick}}</td>
                            <td>{{$profesor->nombre}}</td>
                            <td>{{$profesor->apellidos}}</td>
                            <td>{{$profesor->email}}</td>
                            <td>
                                <button type="submit" class="btn btn-success"><a
                                        style="color:white; text-decoration: none"
                                        href="{{route('cambiarPassword', $profesor->id)}}">CAMBIAR CONSTRASEÑA</a>
                                </button>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-primary"><a
                                        style="color:white; text-decoration: none"
                                        href="{{route('modificarProfesor', $profesor->id)}}">MODIFICAR</a>
                                </button>
                            </td>
                            <td>
                                <button wire:click="destroyProfesor({{$profesor->id}})" class="btn btn-danger">
                                    ELIMINAR
                                </button>
                            </td>
                        </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>

    <br>

    <div class="d-flex justify-content-center">
        {{ $profesores->links() }}
    </div>
</div>
