<?php

namespace PhapNguyenDuc\LaravelManager\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        return view('laravel-manager::dashboard.index');
    }
}
