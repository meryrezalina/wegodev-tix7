<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Movie;
use App\Models\Theater;
use App\Models\ArrangeMovie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArrangeMovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Theater $theater)
    {
        $q = $request->input('q');

        $active = 'Theaters';

        // $theaters = $theaters ->when($q, function($query) use ($q) {
        //                     return $query->where('theater', 'like', '%'.$q.'%');
        // })
        //             ->paginate(10);
        
        // $request = $request->all();

        return view('dashboard/arrange_movie/list', ['theater' => $theater,
                                            'request'=>$request, 
                                            'active' => $active]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Theater $theater)
    {

        $active = 'Theaters';
        $movies = Movie::get();
        return view('dashboard/arrange_movie/form', [
        'theater' => $theater,
        'movies' => $movies,
        'url'    => 'dashboard.theaters.arrange.movie.store',
        'button' => 'Create',
        'active' => $active
    ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ArrangeMovie  $arrangeMovie
     * @return \Illuminate\Http\Response
     */
    public function show(ArrangeMovie $arrangeMovie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ArrangeMovie  $arrangeMovie
     * @return \Illuminate\Http\Response
     */
    public function edit(ArrangeMovie $arrangeMovie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ArrangeMovie  $arrangeMovie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ArrangeMovie $arrangeMovie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ArrangeMovie  $arrangeMovie
     * @return \Illuminate\Http\Response
     */
    public function destroy(ArrangeMovie $arrangeMovie)
    {
        //
    }
}
