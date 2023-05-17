<?php

namespace App\Http\Controllers;
use Yajra\DataTables\CollectionDataTable;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Profile;
use App\Models\Address;
use DataTables;

use Illuminate\Http\Request;

class UserController extends Controller
{
    function __construct()
    {
        //  $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
        //  $this->middleware('permission:user-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    public function index(){
        return view('users');
    } 

    public function get_users_data(){
        $jsonData = UserResource::collection(User::all())->toJson();
        $data = json_decode($jsonData);
        return Datatables::of($data)->make(true);
    }

    // public function create_user(Request $request){
    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path('images'), $imageName);
    //         $imagePath = '/images/' . $imageName;
    //     }
    //     $user_data = [
    //         'name'  => $request['name'],
    //         'email'  => $request['email'],
    //         'password' => Hash::make($request['password']),
    //     ];
    //     $lastId = User::insertGetId($user_data);
    //     $user_profile_data = [
    //         'user_id' => $lastId,
    //         'image'  => @$imageName,
    //         'phone'  => $request['phone'],
    //         'address'  => $request['address'],
    //         'gender'  => $request['gender'],
    //         'bio'  => $request['bio'],
    //     ];
    //     Profile::insert($user_profile_data);
    //     return response()->json(['success' => 'User created successfully']);
    // }

    // public function get_single_user(Request $request){
    //     $user = User::with('profile')->find($request['id']);
    //     $data = [
    //         'id' => $user->id,
    //         'name' => $user->name,
    //         'email' => $user->email,
    //         'profile' => [
    //             'address' => $user->profile->address,
    //             'phone' => $user->profile->phone,
    //             'gender' => $user->profile->gender,
    //             'bio' => $user->profile->bio,
    //         ]
    //     ];
    //     return response()->json($data);
    // }

    // public function update_user(Request $request){
    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();
    //         $image->move(public_path('images'), $imageName);
    //         $imagePath = '/images/' . $imageName;
    //     }
    //     $id = $request['user_id'];
    //     $user_profile_data = [
    //         'phone'  => $request['phone'],
    //         'address'  => $request['address'],
    //         'gender'  => $request['gender'],
    //         'bio'  => $request['bio'],
    //     ];
    //     if(isset($imageName)){
    //         $user_profile_data['image'] = $imageName;
    //     }
    //     Profile::where('user_id', $id)->update($user_profile_data);
    //     return response()->json(['success' => 'User Updated successfully']);
    // }

    // public function delete_user(Request $request){
    //     $id = $request['id'];
    //     Profile::where('user_id', $id)->delete();
    //     User::where('id', $id)->delete();
    //     return response()->json(['success' => 'User Deleted successfully']);
    // }

    // public function save_address(Request $request){
    //     $user_data = [
    //         'user_id'  => $request['userId'],
    //         'address_1'  => $request['address_1'],
    //         'address_2'  => $request['address_2'],
    //         'city'  => $request['city'],
    //         'country'  => $request['country'],
    //         'post_code'  => $request['post_code'],
    //     ];
    //     Address::insert($user_data);
    //     return response()->json(['success' => 'Address Saved successfully']);
    // }

    // public function get_user_addresses(){
    //     $id = $_GET['id'];
    //     $addressData = Address::where('user_id', $id)->get();
    //     $response = json_encode($addressData);
    //     return $response;
    // }
    
    public function create(): View
    {
    }
    public function store(Request $request): RedirectResponse
    {
    }
    public function show($id): View
    {
    }
    public function edit($id): View
    {
    }
    public function update(Request $request, $id): RedirectResponse
    { }
    public function destroy($id): RedirectResponse
    {
    }
}
