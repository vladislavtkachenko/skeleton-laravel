<?php

namespace App\Http\Controllers;


class SiteController extends Controller
{
    /**
     * Главная страница
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('pages.home');
    }
}
