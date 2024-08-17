@extends('layouts.template')
@section('css')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="mb-3 col-md-6">
                                <label>Product Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label>Product Price</label>
                                <input type="number" class="form-control" name="price" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label>Product Stock</label>
                                <input type="number" class="form-control" name="stock" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label>Product Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="">--choose--</option>
                                    <option value="active">ACTIVE</option>
                                    <option value="inactive">INACTIVE</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label>Product Decription</label>
                                <input id="x" type="hidden" name="description" required>
                                <trix-editor input="x"></trix-editor>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label>Product Image</label>
                                <input type="file" name="image" id="image"
                                    class="form-control @error('image') is-invalid @enderror" placeholder="choose file"
                                    onchange="previewFile()" accept=".png,.jpg,.jpeg" required>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <img class="file-preview mt-1" height="100">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">SAVE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function previewFile() {
            const file = document.querySelector('#image');
            const filePreview = document.querySelector('.file-preview');
            filePreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(file.files[0]);
            oFReader.onload = function(oFREvent) {
                filePreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
