<?php

namespace App\Http\Controllers;
use App\movieapp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function home()
    {
        return view("home", ["key" => "home"]);
    }

    public function movies()
    {
        $movies = movieapp::orderBy('id', 'desc')->get();
        return view("movies", ["key" => "movies", "mv" =>$movies]);
    }

    public function addmovies()
    {
        return view("formadd", ["key" => "movies"]);
    }

    public function savemovies(Request $request)
    {
        $file_name = time(). '-'.$request->file('poster')->getClientOriginalName();
        $path = $request->file('poster')->storeAs('poster', $file_name, 'public');

        movieapp::create([
            'title'  => $request->title,
            'genre'  => $request->genre,
            'year'   => $request->year,
            'poster' => $path
        ]);

        return redirect("movies")->with('alert','Data Berhasil Diubah');
    }

    public function editmovies($id){
        $movies = movieapp::find($id);
        return view("formedit",["key" => "movies" ,"mv" => $movies]);
    }

    public function updatemovies($id, Request $request){
        $movies = movieapp::find($id);
        
        $movies->title = $request->title;
        $movies->genre = $request->genre;
        $movies->year = $request->year;

        if ($request->poster){
            if($movies->poster){
                Storage::disk('public')->delete($movies->poster);
            }

            $file_name = time(). '-'.$request->file('poster')->getClientOriginalName();
            $path = $request->file('poster')->storeAs('poster', $file_name, 'public');
            $movies->poster = $path;
        }
        $movies->save();
        return redirect("/movies")->with('alert','Data Berhasil Diubah');
    }

    public function deletemovies($id){
        $movies = movieapp::find($id);

        if($movies->poster){
            Storage::disk('public')->delete($movies->poster);
        }

        $movies->delete();
        return redirect ("/movies")->with('alert','Data Berhasil Diubah');
    }

    public function login(){
        return view("login");
    }
}