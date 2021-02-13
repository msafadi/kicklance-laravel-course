<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::with('profile', 'products')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'name' => 'required',
            'birthday' => 'date',
        ]);

        $data = $request->only('name', 'email', 'password');
        $data['password'] = Hash::make($request->post('password'));
        
        DB::beginTransaction();
        try {
            $user = User::Create($data);
            $user->profile()->create($request->only('birthday', 'gender', 'phone', 'address'));
            
            DB::commit();

            return [
                'code' => 1,
                'message' => 'User created',
                'data' => $user->load('profile')
            ];

        } catch (Throwable $e) {
            DB::rollBack();
            return response()->json([
                'code' => 0,
                'message' => $e->getMessage(),
            ], 500);
        }
        


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user->load('profile', 'products');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
