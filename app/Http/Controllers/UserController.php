<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(StoreUserRequest $request): JsonResponse
    {
        $params = $request->validated();
        $user = User::create([
            'email' => $params['email'],
            'password' => Hash::make($params['password'])
        ]);

        return response()->json(['message' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(): JsonResponse
    {
        $user = auth()->user();

        $users = User::get();

        return response()->json(['message' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request): JsonResponse
    {
        $params = $request->validated();

        $user = auth()->user();

        if(empty($user))
        {
            return response()->json(['error' => 'Такого пользователя не существует'], 404);
        }


        foreach ($params as $key => $item) {
            switch ($key) {
                case 'first_name':
                    $user->first_name = $params['first_name'];
                    break;
                case 'last_name':
                    $user->last_name = $params['last_name'];
                    break;
                case 'email':
                    $user->email = $params['email'];
                    break;
                case 'password':
                    $user->password = Hash::make($params['password']);
                    break;
                case 'admin':
                    $user->is_admin = $params['admin'];
                    break;
            }
        }

        $user->save();

        return response()->json(['message' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(DeleteUserRequest $request)
    {
        $params = $request->validated();

        $user = auth()->user();

        if(empty($user))
        {
            return response()->json(['error' => 'Такого пользователя не существует'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Пользователь успешно удален']);
    }
}
