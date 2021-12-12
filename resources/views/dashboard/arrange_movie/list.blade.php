@extends('layouts.dashboard')

@section('content')
    <div class="mb-2">
        <h3 class="text-center text-uppercase font-weight-bold ">{{ $theater->theater }}</h3>

        <a href="{{ route('dashboard.theaters') }}" class="btn btn-primary mb-0">
            <i class="fas fa-arrow-left"></i>
        </a>

        <a href=" {{route('dashboard.theaters.arrange.movie.create', $theater->id)}} " class="btn btn-primary mb-0"> 
            <i class="fas fa-plus"></i> Studio 
        </a>
    </div>

    @if(session()->has('message'))
        <div class="alert alert-success">
            <strong>{{ session()->get('message') }}</strong>
            <button class="close" type="button" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Theaters - {{ $theater->theater }}</h3>
                </div>

                <div class="col-4">
                    <form method="get" action="{{ route('dashboard.theaters.arrange.movie', $theater->id)}}">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" name="q" value="{{ $request['q'] ?? ''}}">
                            <div class="input-group-append">
                                <button type= "submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <table class="table table-borderless table-striped table-hover">
                     <thead class="text-center">
                        <tr>
                            <th>Movie</th>
                            <th>Studio</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>&nbsp;</th>
                        </tr>
                     </thead>
                <tbody>
                    <!-- KONTEN -->
                    @foreach ($arrangeMovies as $arrangeMovie)
                    <tr>
                        <td class="col-thumbnail text-center font-weight-bold">
                            {{$arrangeMovie->movies->first()->title}}
                            <img src=" {{ asset('storage/movies/'.$arrangeMovie->movies->first()->thumbnail)}} " class="img-fluid"> 
                        </td>
                        <td class="text-center">{{ $arrangeMovie->studio}}</td>
                        <td class="text-center">{{ $arrangeMovie->price}}</td>
                        <td class="text-center">{{ $arrangeMovie->status}}</td>
                        <td> 
                            <a href="{{route('dashboard.theaters.arrange.movie.edit',  [$theater->id, $arrangeMovie->id])}}" class="btn btn-success btn-sm" title="edit">
                            <i class="fas fa-edit"></i></a>
                        </td>
                    </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection