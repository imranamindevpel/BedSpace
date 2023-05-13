<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Address;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(){
        $this->user = new User();
        $this->profile = new Profile();
        $this->address = new Address();
        
        $session = session();
        $id = $session->get('id');
        $userData = $this->user->find($id);
        $this->userName = $userData['first_name'].' '. $userData['last_name'];
        $this->role = $userData['role_id'];
    }

    public function index()
    {
        dd("Here");
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Profile $profile)
    {
        //
    }

    public function edit(Profile $profile)
    {
        //
    }

    public function update(Request $request, Profile $profile)
    {
        //
    }

    public function destroy(Profile $profile)
    {
        //
    }
}
