<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\User;
use App\Models\Genre;
use App\Models\Purchase;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\FilmStoreRequest;
use App\Http\Requests\FilmUpdateRequest;

class FilmController extends Controller
{
    public function index()
    {
        $films = Film::whereHas('genre', function ($query) {
            $query->where('name', 'Action');
        })->get();

        $users = User::all();
        $usersAge = User::where('dob', '<', date('Y-m-d', strtotime('-50 years')))->get();
        $filmCount = Film::all();
        $sn = 0;
        foreach ($filmCount as $film) {
            substr($film->title, -1) == 's' ? $sn++ : null;
        }

        $results = Purchase::where('status','successful')->orderBy('created_at','DESC')->get();

        return view('dashboard.index', compact('films', 'users', 'filmCount', 'sn','results','usersAge'));
    }

    public function manage()
    {
        $genres = Genre::all();
        $results = Film::all();
        return view('dashboard/manage_films', compact('genres', 'results'));
    }

    public function show($uuid)
    {
        return view('dashboard.edit', [
            'film' => Film::where('uuid', $uuid)->first(),
            'genres' => Genre::all()
        ]);
    }

    public function store(FilmStoreRequest $request)
    {
        Film::create($request->validated());
        return redirect()->back()->withSuccess('Film Added Successfully');
    }

    public function notAvailable($id)
    {
        Film::find($id)->update(['status'=>'Not Available for Sale']);
        return redirect('dashboard/manage_films')->withSuccess('Film Status Updated Successfully');
    }

    public function Available($id)
    {
        Film::find($id)->update(['status'=>'Available for Sale']);
        return redirect('dashboard/manage_films')->withSuccess('Film Status Updated Successfully');
    }

    public function update(FilmUpdateRequest $request, $id)
    {
        $data = Film::where('id', $id);
        $data->update($request->validated());
        return redirect('dashboard/manage_films')->withSuccess('Film Updated Successfully');
    }

    public function destroy($id)
    {
        Film::find($id)->delete();
        return redirect()->back()->withSuccess('Deleted Successfully');
    }

    public function getFilms()
    {
        $films = Film::all();
        return view('index', compact('films'));
    }

    public function addToCart($id)
    {
        $product = Film::findOrFail($id);

        if($product->status == "Not Available for Sale"){
            return redirect()->back()->withError('Film Not on sale at the momment');
        }

        $cart = session()->get('cart', []);
         if (!empty($cart[$id])) {
            return redirect()->back()->withError('Film Already Added to Cart');
        } else {
            $cart[$id] = [
                "title" => $product->title,
                "genre" => $product->genre->name,
                "price" => $product->price,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->withSuccess('Film added to cart successfully!');
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back();
        }
    }

    public function filmWithActionGenre(){
        return view('dashboard.sorted_films', [
            'results' => Film::whereHas('genre', function ($query) {
                $query->where('name', 'Action');
            })->get()
        ]);
    }

}
