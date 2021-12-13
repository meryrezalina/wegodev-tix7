<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Movie;
use App\Models\Theater;
use App\Models\Studio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StudioController extends Controller
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

        $studios = Studio::where('theater_id', $theater->id)
                                            ->with('movies')
                                            ->whereHas('movies', function($query) use ($q){
                                                $query->where('title', 'like', '%'.$q.'%');
                                            })
                                            ->paginate();

        $request = $request->all();

        return view('dashboard/studio/list', [
                     'studios'        => $studios,
                     'theater'       => $theater,
                     'request'       => $request, 
                     'active'        => $active]);
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
        return view('dashboard/studio/form', [
        'theater' => $theater,
        'movies' => $movies,
        'url'    => 'dashboard.theaters.studio.store',
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
    public function store(Request $request, Studio $studio)
    {
        $validator = Validator::make($request->all(), [
            'theater_id'=> 'required',
            'studio'    => 'required',
            'price'     => 'required',
            'movie_id'  => 'required',
            'rows'      => 'required',
            'columns'   => 'required',
            'schedules'  => 'required',
            'status'    => 'required'

           // 'thumbnail' => 'required'
        ]);

        if($validator->fails()){
            return redirect()
                    ->route('dashboard.theaters.studio.create', $request->input('theater_id'))
                    ->withErrors($validator)
                    ->withInput();
        }else{

            $seats = [
                'rows'    => $request->input('rows'),
                'columns' => $request->input('columns')

            ]; 

            $studio->theater_id    = $request->input('theater_id');
            $studio->studio        = $request->input('studio');
            $studio->price         = $request->input('price');
            $studio->movie_id      = $request->input('movie_id');
            $studio->status        = $request->input('status');
            $studio->seats         = json_encode($seats);
            $studio->schedules     = json_encode($request->input('schedules'));
            $studio->save();

            return redirect()
                    ->route('dashboard.theaters.studio', $request->input('theater_id'))
                    ->with('message', __('message.create_theater', ['theater' => $request->input('studio')]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function show(Studio $studio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function edit(Theater $theater, Studio $studio)
    {
        $active = 'Theaters';

        $movies = Movie::get();

        return view('dashboard/studio/form', [
        'theater'           => $theater,
        'movies'            => $movies,
        'studio'            => $studio,
        'url'               => 'dashboard.theaters.studio.update',
        'button'            => 'Update',
        'active'            => $active
    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Studio $studio)
    {
        $validator = Validator::make($request->all(), [
            'theater_id'=> 'required',
            'studio'    => 'required',
            'price'     => 'required',
            'movie_id'  => 'required',
            'rows'      => 'required',
            'columns'   => 'required',
            'schedules'  => 'required',
            'status'    => 'required'

           // 'thumbnail' => 'required'
        ]);
        if($validator->fails()){
            return redirect()
                    ->route('dashboard.theaters.studio.edit', 
                            [   'theater'        => $request->input('theater_id'),
                                'studio'         => $studio->id])
                    ->withErrors($validator)
                    ->withInput();
        }else{
            $seats = [
                'rows'    => $request->input('rows'),
                'columns' => $request->input('columns')

            ]; 

            $studio->theater_id    = $request->input('theater_id');
            $studio->studio        = $request->input('studio');
            $studio->price         = $request->input('price');
            $studio->movie_id      = $request->input('movie_id');
            $studio->status        = $request->input('status');
            $studio->seats         = json_encode($seats);
            $studio->schedules     = json_encode($request->input('schedules'));
            $studio->save();

            return redirect()
                    ->route('dashboard.theaters.studio', $request->input('theater_id'))
                    ->with('message', __('message.update_theater', ['theater' => $request->input('studio')]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Studio  $studio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Studio $studio)
    {
        $studio->delete();
        $studio= $studio->studio;
        

        return redirect()
            ->route('dashboard.theaters.studio', $request->input('theater_id'))
            ->with('message', __('message.delete_theater', ['theater' => $request->input('studio')]));

    }
}
