@extends('dashboard.layouts.main')

@section('container')
<div class="div">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Item</h1>
      </div>
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="{{ ($item->image) ? asset('storage/' . $item->image) : asset('storage/item-img/default.png') }}" class="img-fluid rounded-start border border-1 " alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">{{$item->name}}</h5>
              <ul>
                  <li>{{$item->id}}</li>
                  <li>{{$item->slug}}</li>
                  <li>{{$item->satuan}}</li>
                  <li>{{$item->harga}}</li>
                  <li>{{$item->category->name}}</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
</div>


@endsection