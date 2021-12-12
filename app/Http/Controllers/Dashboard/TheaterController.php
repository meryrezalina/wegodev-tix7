<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Theater;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TheaterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Theater $theaters)
    {
        $q = $request->input('q');

        $active = 'Theaters';

        $theaters = $theaters ->when($q, function($query) use ($q) {
                            return $query->where('theater', 'like', '%'.$q.'%');
        })
                    ->paginate(10);
        
        $request = $request->all();

        return view('dashboard/theater/list', ['theaters' => $theaters,
                                            'request'=>$request, 
                                            'active' => $active]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active = 'Theaters';

        return view('dashboard/theater/form', [
        'active' => $active,
        'url'    => 'dashboard.theaters.store',
        'button' => 'Create'
    ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Theater $theater)
    {
        $validator = Validator::make($request->all(), [
            'theater' => 'required|unique:App\Models\Theater,theater',
            'address' => 'required',
            'status' => 'required'
           // 'thumbnail' => 'required'
        ]);

        if($validator->fails()){
            return redirect()
                    ->route('dashboard.theaters.create')
                    ->withErrors($validator)
                    ->withInput();
        }else{
            // $image = $request->file('thumbnail');
            // $filename = time() .'.'. $image->getClientOriginalExtension();
            // Storage::disk('local')->putFileAs('public/theaters', $image, $filename);

            $theater->theater = $request->input('theater');
            $theater->address = $request->input('address');
            $theater->status = $request->input('status');

            //$theater->thumbnail = $filename;
            $theater->save();
            return redirect()
                    ->route('dashboard.theaters')
                    ->with('message', __('message.create_theater', ['theater' => $request->input('theater')]));

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Theater  $theater
     * @return \Illuminate\Http\Response
     */
    public function show(Theater $theater)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Theater  $theater
     * @return \Illuminate\Http\Response
     */
    public function edit(Theater $theater)
    {
        $active = 'Theaters';


        return view('dashboard/theater/form', [
            'active' => $active,
            'theater' => $theater,
            'button' => 'Update',
            'url'    => 'dashboard.theaters.update'

    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Theater  $theater
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Theater $theater)
    {
        $validator = Validator::make($request->all(), [
            'theater' => 'required|unique:App\Models\Theater,theater,'.$theater->id,
            'address' => 'required',
            'status' => 'required'
           // 'thumbnail' => ''
        ]);

        if($validator->fails()){
            return redirect()
                    ->route('dashboard.theaters.update', $theater->id)
                    ->withErrors($validator)
                    ->withInput();
        }else{
            //if($request->hasFile('thumbnail')){

           // $image = $request->file('thumbnail');
           // $filename = time() .'.'. $image->getClientOriginalExtension();
           //Storage::disk('local')->putFileAs('public/theaters', $image, $filename);
            //$theater->thumbnail = $filename;
          //}
            
            
            $theater->theater = $request->input('theater');
            $theater->address = $request->input('address');
            $theater->status  = $request->input('status');


            $theater->save();
            return redirect()
                    ->route('dashboard.theaters')
                    ->with('message', __('message.update_theater', ['theater' => $request->input('theater')]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Theater  $theater
     * @return \Illuminate\Http\Response
     */
    public function destroy(Theater $theater)
    { 
  
        $theater->delete();
        $theater = $theater->theater;
        

        return redirect()
            ->route('dashboard.theaters')
            ->with('message', __('message.delete_theater', ['theater' => $theater]));
    }
}
