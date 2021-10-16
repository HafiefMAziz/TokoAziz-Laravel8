@extends('dashboard.layouts.main')

@section('container')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Daftar Item</h1>
    </div>
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Search.." name="searchitem" id="searchitem">
      <button class="btn btn-outline-secondary" type="button" name="searchitembutton" id="searchitembutton">Search</button>
    </div>
    @if (session()->has('succesAddItem'))
    <div class="alert alert-success" role="alert">
      {{ session('succesAddItem' )}}
    </div> 
    @endif
    <form action="/dashboard/items">
      <div class="input-group mb-3">
          @if (request('category'))
              <input type="hidden" name="category" value={{request('category')}}>
          @endif
        </div>
      </form>
      <a href="/dashboard/items/create" role="button" class="btn btn-primary"><span data-feather="plus-square"></span> Buat item baru</a>
      @if ($daftaritem->count())
      <div id="container-table" class="col-lg-10">
        <table class="table align-middle caption-top">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">ID</th>
              <th scope="col">Nama item</th>
              <th scope="col">Satuan</th>
              <th scope="col">Category</th>
              <th scope="col">Harga</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($daftaritem as $key => $b)
            <tr>
              <th scope="row">{{ $daftaritem->firstItem() + $key }}</th>
              <th scope="row">{{ $b->id }}</th>
              <td>{{ $b->name }}</td>
              <td>{{ $b->satuan }}</td>
              <td><a class="text-decoration-none" href="/dashboard/items?category={{ $b->category->slug}}">{{ $b->category->name}}</a></td>
              <td>{{ $b["harga"] }}</td>
              <td>
                <a href="/dashboard/items/{{ $b->slug }}" class="badge bg-info"><span data-feather="eye"></span></a>
                <a href="/dashboard/items/{{ $b->slug }}/edit" class="badge bg-warning"><span data-feather="edit-2"></span></a>
                <form action="/dashboard/items/{{ $b->slug }}" class="d-inline" method="POST">
                  @method('DELETE')
                  @csrf
                  <button class="badge bg-danger border-0" onclick="confirm('Yakin ?')"><span data-feather="x"></span></button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
    </div>  
    <div class="d-flex justify-content-right">
        {{ $daftaritem->links() }}
    </div>
    @else
      {{ "Data tidak ditemukan "}}
    @endif

<script>
  var keyword = document.getElementById('searchitem');
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
    ajax.open('GET', '/public/ajax/coba.txt', true);
    ajax.send();

  })
</script>

@endsection