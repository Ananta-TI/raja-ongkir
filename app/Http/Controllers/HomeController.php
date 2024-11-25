<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    // function tes(){

    // $users = DB::table('users')->get();

    //     dd($users);
    // }
    public function index()
     {
         $berita = Berita::all();
         $services = [
             [
                 'title' => 'UI/UX Design',
                 'description' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered.',
                 'icon' => 'path/to/icon1.svg', // Ganti dengan path ke ikon yang sesuai
             ],
             [
                 'title' => 'Product Design',
                 'description' => 'All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary making.',
                 'icon' => 'path/to/icon2.svg',
             ],
             [
                 'title' => 'Frontend Development',
                 'description' => 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.',
                 'icon' => 'path/to/icon3.svg',
             ],
         ];

         return view('home', [
             'services' => $services,
             'berita' => $berita,
             // Data lainnya yang ingin dikirim ke view
         ]);
     }

}

