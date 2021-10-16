@extends('dashboard.layouts.main')

@section('container')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Edit an Item</h1>
    </div>

    <div class="col-lg-8">
        <form action="/dashboard/items/{{ $item->slug }}" method="POST" enctype="multipart/form-data">
            {{-- PUT or PATCH method buat update --}}
            @method('PATCH')
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Item Name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $item->name) }}">
              <div class="invalid-feedback">
                @error('name')
                 {{$message}}   
                @enderror
              </div>
            </div>
            <div class="mb-3">
              <label for="slug" class="form-label">Slug</label>
              <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $item->slug) }}" readonly>
              <div class="invalid-feedback">
                @error('slug')
                 {{$message}}   
                @enderror
              </div>
            </div>
            <div class="mb-3">
              <input type="hidden" name="oldImage" value="{{ $item->image }}">
              <label for="image" class="form-label">Image Item</label>
              <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
              @if ($item->image)
              <img src="{{ asset('storage/' . $item->image) }}" class="img-preview img-fluid col-sm-3 mt-3">
              @else
              <img class="img-preview img-fluid col-sm-3 mt-3">
              @endif
              <div class="invalid-feedback">
                @error('image')
                 {{$message}}   
                @enderror
              </div>
            </div>
            <div class="mb-3">
              <label for="category_id" class="form-label">Satuan</label>
              <select class="form-select" id="category_id" name="category_id">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $item->name) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
              </select>
              <div class="invalid-feedback">
                @error('category_id')
                 {{$message}}   
                @enderror
              </div>
            </div>
            <div class="mb-3">
              <label for="satuan" class="form-label">Satuan</label>
              <input type="text" class="form-control @error('satuan') is-invalid @enderror" id="satuan" name="satuan" value="{{ old('satuan', $item->satuan) }}">
              <div class="invalid-feedback">
                @error('satuan')
                 {{$message}}   
                @enderror
              </div>
            </div>
            <div class="mb-3">
              <label for="harga" class="form-label">Harga</label>
              <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga', $item->harga) }}">
              <div class="invalid-feedback">
                @error('harga')
                 {{$message}}   
                @enderror
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    </div>

    <script>
        const itemname = document.querySelector('#name');
        const slug = document.querySelector('#slug');

        itemname.addEventListener('change', function() {
          fetch('/dashboard/items/checkSlug?name=' + itemname.value)
              .then(response => response.json())
              .then(data => slug.value = data.slug)
        })

        function previewImage() {
          const image = document.querySelector('#image');
          const imgPreview = document.querySelector('.img-preview');

          imgPreview.style.display = 'block';

          const oFReader = new FileReader();
          oFReader.readAsDataURL(image.files[0]);
          oFReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
          }
        }
    </script>

@endsection