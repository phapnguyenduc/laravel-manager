<?php

namespace PhapNguyenDuc\LaravelManager\Http\Controllers;

class ProfileController extends Controller
{
    public function create()
    {
        return view('laravel-manager::pages.profile');
    }

    public function update()
    {

        $user = request()->user();
        $attributes = request()->validate([
            'email' => 'required|email|unique:users,email,'.$user->id,
            'name' => 'required',
            'phone' => 'required|max:10',
            'about' => 'required:max:150',
            'location' => 'required'
        ]);

        auth()->user()->update($attributes);
        return back()->withStatus('Profile successfully updated.');

}
}
