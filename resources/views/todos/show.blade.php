@extends('app')

@section('content')

<div class="container w-25 border p-4 rounded bg-light mt-4">
    <div class="row mx-auto">
    <form  method="POST" action="{{ route('todos-update', ['id' => $todo->id]) }}">
        @method('PATCH')
        @csrf

        <div class="mb-3 col">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            @if (session('success'))
                    <h6 class="alert alert-success">{{ session('success') }}</h6>
            @endif

            <h1 class="text-center">Editar una tarea existente</h1>
            <label for="title" class="form-label">Ingresa el nuevo título de la tarea que quieres modificar. </label>
            <input type="text" class="form-control mb-2" name="title" id="exampleFormControlInput1" placeholder="Comprar la cena" value="{{ $todo->title }}">

             <label for="category_id" class="form-label">Elige el Usuario que mejor se adapte a tu tarea.</label>
            <select name="category_id" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <input type="submit" value="Actualizar tarea y ver lista" class="btn btn-primary my-2 text-white rounded" />
        </div>
    </form>
</div>

</div>
@endsection