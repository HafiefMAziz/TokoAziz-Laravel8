
@extends('layouts.main')

@section('container')
{{-- @dd($daftaritem1) --}}
<div class="container mt-4">
  <h1 class="display-6 mb-4">{{ $title }}</h1>
  <form action="/daftaritem">
  <div class="input-group mb-3">
      @if (request('category'))
          <input type="hidden" name="category" value={{request('category')}}>
      @endif
      <input type="text" name="search" class="form-control" placeholder="Search.." value={{request('search')}}>
      <button class="btn btn-outline-secondary" type="submit">Search</button>
    </div>
  </form>
  @if ($daftaritem->count())
    <caption>{{ $caption }}</caption>
    <div class="container">
      <div class="row justify-content-center">
        @foreach ($daftaritem as $item)
        <div class="col-sm-2 my-1 border">
          <div class="card shadow-sm" style="width: 12rem;">
            <div class="position-absolute py-1 px-1" style="background-color: rgba(0, 0, 0, 0.6)"><a href="/daftaritem?category={{$item->category->slug}}" class="text-decoration-none text-white">{{$item->category->name}}</a></div>
            @if ($item->image)
            <img src="\storage\{{ $item->image }}" class="card-img-top img-fluid" alt="...">
            @else 
            <img src="\storage\item-img\default.png" class="card-img-top img-fluid" alt="...">
            @endif
            <div class="card-body">
              <h5 class="card-title">{{$item->name}}</h5>
              <p class="card-text">{{$item->satuan}}</p>
              <p><strong>Rp. {{$item->harga}}</strong></p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>  
    <div class="d-flex justify-content-center">
        {{ $daftaritem->links() }}
    </div>
    @else
      {{ "Data tidak ditemukan "}}
    @endif
</div>
{{-- <script>
  var keyword = document.getElementById('cari');
  var table = document.getElementById('container-table');

  keyword.addEventListener('keyup', function(){
    console.log(keyword.value);

    //buat object ajax
    var ajax = new XMLHttpRequest();

    //cek kesiapan ajax
    ajax.onreadystatechange = function() {
      if (ajax.readyState == 4 && ajax.status == 200) {
        console.log('ajax Ok !');
      }
    }

    // eksekusi ajax
    ajax.open('GET', 'coba.txt', true);
    ajax.send();

  })
</script> --}}
@endsection
