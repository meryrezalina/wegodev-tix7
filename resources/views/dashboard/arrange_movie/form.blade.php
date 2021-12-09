@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Theaters</h3>
                </div>

                <div class="col-4 text-right">
                    <button class=" btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="card-body ">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form method="post" action="{{route($url, $theater->id ?? '') }}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($theater))
                        @method('put')
                        @endif

                        <input type="button" name="theater" value=" {{ $theater->theater }} ">


                        <div class="form-group">
                            <label for="studio">Studio</label>
                            <input type="text" class="form-control @error('studio') {{'is-invalid'}} @enderror" name="studio" value=" {{ old('studio') ?? $theater->studio ?? ''}} ">
                            @error('studio')
                            <span class="text-danger"> {{$message}} </span>   
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control @error('price') {{'is-invalid'}} @enderror" name="price" value=" {{ old('price') ?? $theater->price ?? ''}} ">
                            @error('price')
                            <span class="text-danger"> {{$message}} </span>   
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="movie">Movies</label>
                            <select name="movie-id" class="form-control">
                                <option value="">Pilih Film</option>
                                @foreach($movies as $movie)
                                    <option value="{{$movie->id}}" placeholder="Pilih Film">{{ $movie->title }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group form-row mt-4">
                            <div class="col-2 align-self-center">
                                <label for="Seats">Seats</label>
                            </div>
                            <div class="col-5">
                                <input type="number" class="form-control @error('rows') {{'is-invalid'}} @enderror" placeholder="Rows" name="rows" value=" {{ old('rows') ?? $theater->rows ?? ''}} ">
                                @error('rows')
                                <span class="text-danger"> {{$message}} </span>   
                                @enderror
                            </div>
                            <div class="col-5">
                                <input type="text" class="form-control @error('columns') {{'is-invalid'}} @enderror" placeholder="Columns" name="columns" value=" {{ old('columns') ?? $theater->columns ?? ''}} ">
                                @error('columns')
                                <span class="text-danger"> {{$message}} </span>   
                                @enderror
                            </div>
                        </div>

                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="form-group mb-0">
                                    <label for="schedule">Schedule</label>
                                </div>
                                 <schedule-component></schedule-component>
                            </div>
                            @error('columns')
                                <span class="text-danger"> {{$message}} </span>   
                                @enderror
                        </div>

                        <div class="mb-2">
                        <div class="form-group mb-0">
                            <label for="status">Status</label>
                        </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="status" class="form-check-input" value="Coming Soon" id="Coming Soon" @if((old('status') ?? $theater->status ?? '') == 'Coming Soon') checked @endif>
                                <label for="Coming Soon" class="form-check-label">Coming Soon</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" name="status" class="form-check-input" value="In Theater" id="In Theater" @if((old('status') ?? $theater->status ?? '') == 'In Theater') checked @endif>
                                <label for="In Theater" class="form-check-label">In Theater</label>
                            </div>
                            @error('status')
                            <span class="text-danger"> {{$message}} </span>   
                        @enderror
                        </div>

                      <!--  <div class="form-group mt-4">
                            <div class="custom-file">
                            <input type="file" name="thumbnail" class="custom-file-input" value="old('thumbnail')">
                            <label for="thumbnail" class="custom-file-label">Thumbnail</label>
                           @error('thumbnail"')
                                <span class="text-danger"> {{$message}} </span>   
                            @enderror
                            </div>
                        </div> -->

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary btn-sm">{{ $button }}</button>
                            <button type="button" onclick="window.history.back()" class="btn btn-sm btn-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @if(isset($theater))
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Delete</h5>
                </div>

                <div class="modal-body">
                    <p>Hapus theater {{$theater->theater}}????????</p>
                </div>

                <div class="modal-footer">
                    <form action="{{route('dashboard.theaters.delete', $theater->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection