<?php

namespace App\Controllers;

class Home extends FrontendController
{
    public function index(): string
    {
        return view('pages/home', $this->data);
    }
    public function about(): string
    {
        return view('pages/about', $this->data);
    }
    public function contact(): string
    {
        return view('pages/contact', $this->data);
    }
    public function terms(): string
    {
        return view('pages/terms', $this->data);
    }
    public function privacy(): string
    {
        return view('pages/privacy', $this->data);
    }
}
