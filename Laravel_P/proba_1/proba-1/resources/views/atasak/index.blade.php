@extends('proba')

@section('content')
<div class="container mt-5 ">
    <form class="w-25 card p-3 m-auto" action="{{'atasak'}}" method="POST">
        @csrf

        @if (session('success'))
        <h6 class="alert alert-success">
            {{session('success')}}
        </h6>

        @endif

        @error('izena')
        <h6 class="alert alert-danger">
            {{$message}}
        </h6>
        @enderror

        <div class="form-group mb-3">
            <label for="izena">Atasaren izena</label>
            <input type="text" class="form-control" id="izena" placeholder="Izena" name="izena">
        </div>
        <button type="submit" class="btn btn-primary">Sortu atasa</button>
    </form>

</div>
@endsection