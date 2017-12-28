<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $title = 'Laravel from Scratch';
        return view('pages.index', [
            'title' => $title
        ]);
    }

    public function about()
    {
        $title = 'This is about page';
        return view('pages.about', [
            'title' => $title
        ]);
    }
    public function services()
    {
        $data = [
            'title' => 'services',

            'services' => [
                'seo',
                'web',
                'programming'
            ]
        ];

        return view('pages.services', $data);
    }
}
