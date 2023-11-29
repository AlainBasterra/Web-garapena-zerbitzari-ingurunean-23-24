@extends('proba')

@section('content')
<div class="container mt-5 ">
    <h1>ATASAK</h1>
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

    <div>
        @foreach ($atasak as $atasa)
        <div class="row py-1">
            <div class="col-md-9 d-flex align-items-center">
                <a href=" {{ route('atasa-edit', ['id' => $atasa->id]) }} "> {{ $atasa->izena}}</a>
            </div>
            <div class="col-md-3 d-flex justify-content-end">
                <form action="{{ route('atasa-destroy', [$atasa->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Ezabatu</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection