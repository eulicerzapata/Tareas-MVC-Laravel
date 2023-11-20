@extends('app')

@section('content')

<div class="container w-25 border p-4 rounded bg-light mt-4">
    <div class="row mx-auto">
    <form  method="POST" action="{{route('todos')}}">
        @csrf

        <div class="mb-3 col">
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif
            
            <h1 class="text-center">Añadir una nueva tarea a tu lista</h1>
            <label for="title" class="form-label">Ingresa el título de la tarea.</label>
            <input type="text" class="form-control mb-2" name="title" id="exampleFormControlInput1" placeholder="Comprar la cena">

            <label for="category_id" class="form-label">Elige el usuario que mejor se adapte a la tarea. </label>
            <select name="category_id" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <input type="submit" value="Añadir tarea y ver lista" class="btn btn-primary my-2 text-white rounded" />
        </div>
    </form>
</div>


    <div >
        @foreach ($todos as $todo)
        
            <div class="row py-1">
                <div class="col-md-9 d-flex align-items-center">
                    <a href="{{ route('todos-edit', ['id' => $todo->id]) }}">{{ $todo->title }}</a>
                </div>

                <div class="col-md-3 d-flex justify-content-end">
                    <form action="{{ route('todos-destroy', [$todo->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </div>
            </div>
            
        @endforeach
    </div>
    </div>
</div>
@endsection