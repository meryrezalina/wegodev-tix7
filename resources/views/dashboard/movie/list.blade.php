@extends('layouts.dashboard')

@section('content')
    <div class="mb-2">
        <a href=" {{route('dashboard.movies.create')}} " class="btn btn-primary">+ Movie</a>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Movies</h3>
                </div>

                <div class="col-4">
                    <form method="get" action="{{ url('dashboard/movies')}}">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" name="q" value="{{ $request['q'] ?? ''}}">
                            <div class="input-group-append">
                                <button type= "submit" class="btn btn-primary btn-sm">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if($movies->total())
                <table class="table table-borderless table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Thumbnail</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movies as $movie)
                    <tr>
                        <th scope="row">{{ ($movies->currentPage() - 1) * $movies->perPage() + $loop->iteration }}</th>
                        <td>{{ $movie->title}}</td>
                        <td>{{ $movie->thumbnail}}</td>
                        <td> <a href="{{route('dashboard.movies.edit', ['id' => $movie->id])}}" class="btn btn-success btn-sm">
                            <i class="fas fa-edit"></i> Edit</a></td>
                    </tr> 
                    @endforeach
                </tbody>
                </table>

                {{ $movies ->appends($request)->links()}}
            @else
                <h4 class="text-center"> GAK ADA FILM BOSS </h4>
            @endif 
        </div>
    </div>

@endsection