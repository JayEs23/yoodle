<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::where('library_id', request()->library_id)->get();
        return response()->json(['data' => $users], 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['library_id'] = request()->library_id;
        $user = User::create($validatedData);
        return response()->json(['data' => $user], 201);
    }

    public function show($id)
    {
        $user = User::where('library_id', request()->library_id)->find($id);
        if (!$user) {
            return response()->json(['error' => 'This user does not belong to this library'], 401);
        }
        return response()->json(['data' => $user], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::where('library_id', request()->library_id)->find($id);
        if (!$user) {
            return response()->json(['error' => 'This user does not belong to this library'], 401);
        }
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|min:8',
        ]);
        if ($request->has('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }
        $user->update($validatedData);
        return response()->json(['data' => $user], 200);
    }

    public function destroy($id)
    {
        $user = User::where('library_id', request()->library_id)->find($id);
        if (!$user) {
            return response()->json(['error' => 'This user does not belong to this library'], 401);
        }
        $user->delete();
        return response()->json(['message' => 'Successfully deleted'], 200);
    }

}
