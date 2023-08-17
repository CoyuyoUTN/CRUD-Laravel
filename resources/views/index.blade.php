@extends('layouts.base')



@section('content')
    <div class="row">
        <div class="col-12">
            <div>
                <h2 class="text-white">CRUD de Tareas</h2>
            </div>
            <div>
                <a href="{{ route('tasks.create') }}" class="btn btn-primary">Crear tarea</a>
            </div>
        </div>

        @if (Session::get('success'))
            <div class="alert alert-success mt-2">
                <strong>{{ Session::get('success') }} </strong>
            </div>
        @endif

        <div class="col-12 mt-4">
            <table class="table table-bordered text-white">
                <tr class="text-secondary">
                    <th>Tarea</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
                @foreach ($tasks as $task)
                    <tr>
                        <td class="fw-bold">{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>
                            {{ $task->due_date }}
                        </td>
                        <td>
                            <span class="badge bg-warning fs-6">{{ $task->status }}</span>
                        </td>
                        <td>
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Editar</a>

                            <form action="{{ route('tasks.destroy', $task) }}" method="post" class="d-inline ">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm"
                                    data-toggle="tooltip" title='Delete'>Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </table>
            {{ $tasks->links() }}
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <script type="text/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            Swal.fire({
                title: '¿Seguro que desea eliminar tarea?',
                text: "No podrás revertir esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Eliminar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Eliminada!',
                        'Su tarea ah sido eliminada',
                        'Exito'
                    )

                    form.submit();
                }
            })
        });
    </script>
@endsection
