@extends('layouts.main')

@section('container')
<div class="container mt-4">
        {{ $item->name }}
        {{ $item->slug }}
        {{ $item->satuan }}
        {{ $item->category->name }}
        {{ $item->harga }}

</div>
    
@endsection