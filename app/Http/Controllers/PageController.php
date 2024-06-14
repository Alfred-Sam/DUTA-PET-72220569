<?php

namespace App\Http\Controllers;
use App\movieapp;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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

    public function savemovies(Request $request){
        if ($request->hasFile('photo')) {
            $file_name = time(). '-'.$request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('photo', $file_name, 'public');
        } else {
            $path = null; // Atur path ke null jika tidak ada file yang diunggah
        }
        movieapp::create([
            'nama'  => $request->nama,
            'gender'  => $request->gender,
            'year'   => $request->year,
            'photo' => $path
        ]);
        return redirect("/pet")->with('alert','Data Berhasil Diubah');
    }
    

    public function editmovies($id){
        $movies = movieapp::find($id);
        return view("formedit",["key" => "movies" ,"mv" => $movies]);
    }

    public function updatemovies($id, Request $request)
    {
        $movies = movieapp::find($id);
        $movies->nama = $request->nama;
        $movies->gender = $request->gender;
        $movies->year = $request->year;
        
        if ($request->hasFile('photo')) {
            if($movies->photo){
                Storage::disk('public')->delete($movies->photo);
            }
            $file_name = time(). '-'.$request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('photo', $file_name, 'public');
            $movies->photo = $path;
        }
        $movies->save();
        return redirect("/pet")->with('alert','Data Berhasil Diubah');
    }

    public function deletemovies($id){
        $movies = movieapp::find($id);

        if($movies->photo){
            Storage::disk('public')->delete($movies->photo);
        }

        $movies->delete();
        return redirect ("/pet")->with('alert','Data Berhasil Diubah');
    }

    public function login(){
        return view("login");
    }

    public function edituser(){
        return view("edituser" ,["key" => ""]);
    }

    public function updateuser(Request $request){
        if($request->password_baru == $request->konfirmasi_password){
            $user=Auth::user();
            $user->password= bcrypt($request->password_baru);
            $user->save();

            return redirect("/user")->with("info", "Password Berhasil diubah");
        }

        else{
            return redirect("/user")->with("info", "Password Gagal diubah");
            //Pass=meme
        }
    }
}
