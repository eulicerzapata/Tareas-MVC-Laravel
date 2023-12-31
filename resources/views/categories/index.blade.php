@extends('app')

@section('content')

<div class="container w-25 border p-4 rounded bg-light mt-4">
    <div class="row mx-auto">
    <form  method="POST" action="{{route('categories.store')}}">
        @csrf

        <div class="mb-3 col">

        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

         @error('color')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @if (session('success'))
                <h6 class="alert alert-success text-center">{{ session('success') }}</h6>
        @endif

            <h1 class="text-center">Crear un nuevo Usuario</h1>
            <label for="exampleFormControlInput1" class="form-label">Nombre del Usuario</label>
            <input type="text" class="form-control mb-2" name="name" id="exampleFormControlInput1" placeholder="Eulicer Zapata">
            
            <label for="exampleColorInput" class="form-label text-center">Elige un color que te represente </label>
            <input type="color" class="form-control form-control-color" name="color" id="exampleColorInput" value="#563d7c" title="Choose your color">

            <input type="submit" value="Crear Usuario " class="btn btn-primary my-2 text-white rounded" />
        </div>
    </form>
</div>



    <div >
        @foreach ($categories as $category)
            <div class="row py-1">
                <div class="col-md-9 d-flex align-items-center">
                    <a class="d-flex align-items-center gap-2" href="{{ route('categories.show', ['category' => $category->id]) }}">
                        <span class="color-container" style="background-color: {{ $category->color }}"></span> {{ $category->name }}
                    </a>
                </div>

                <div class="col-md-3 d-flex justify-content-end">
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{$category->id}}">Eliminar</button>
                    
                </div>
            </div>

            <!-- MODAL -->
            <div class="modal fade" id="modal{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Al eliminar el Usuario <strong>{{ $category->name }}</strong> se eliminan todas las tareas asignadas a ese usuario. 
                        ¿Está seguro que desea eliminar a <strong>{{ $category->name }}</strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, cancelar</button>
                        <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-primary">Sí, eliminar Usuario</button>
                        </form>
                        
                    </div>
                    </div>
                </div>
            </div>
            
        @endforeach
    </div>
    </div>
</div>
@endsection