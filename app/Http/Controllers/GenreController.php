<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index(){
        $results = Genre::all();
        return view('dashboard/genre', compact('results'));
    }

    public function show($id){
        return view('dashboard.edit_genre',[
            'genre' => Genre::find($id)
        ]);
    }

    public function store(GenreRequest $request){
     Genre::create($request->validated());
     return redirect()->back()->withSuccess('Film Genre Added Successfully');

    }

    public function update(UpdateGenreRequest $request, $id){
        $data = Genre::find($id);
        $data->update($request->all());
        return redirect('dashboard/genre')->withSuccess('Genre Updated Successfully');
    }

    public function destroy($id){
        Genre::find($id)->delete();
        //Film::where('genre_id', $id)->delete();
        return redirect()->back()->withSuccess('Deleted Successfully');
    }
}
