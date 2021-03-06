<?php

namespace App\Http\Controllers;
use App\Post;

class PagesController extends Controller {


    public function getIndex() {

        $posts = Post::orderBy('created_at','desc')->limit(4)->get();
        return view('pages.welcome')->withPosts($posts);

        return view('pages/welcome');
    }

    public function getAbout() {
         $first = 'Jonas';
        $last = 'Adnan';


        $fullname = $first . " " . $last;
        $email = 'jonas@innit.no';
        $data = [];

        $data['email'] = $email;
        $data['fullname'] = $fullname;

        return view('pages.about')->withData($data);

    }

      public function getContact() {



          return view('pages/contact');
      }

}