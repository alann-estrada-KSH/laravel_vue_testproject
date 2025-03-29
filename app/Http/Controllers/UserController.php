<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Address;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with("addresses")->get();
        return Inertia::render("TableUsers", [
            "users" => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("Register");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            User::create($request->validated());
            return Inertia::location(route('user.index'))->with('success', 'Usuario creado correctamente');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('addresses')->find($id);
        if (!$user) {
            return redirect()->route('user.index')->with('error', 'Usuario no encontrado');
        }

        $userResource = new UserResource($user);

        return Inertia::render('ViewUser', [
            'user' => $userResource,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        if (!$user)
            return response()->json(['message' => 'User not found for edit'], 404);
        return Inertia::render('EditUser', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = User::find($id);
        if (!$user)
            return response()->json(['message' => 'User not found for update'], 404);
        $user->update($request->validated());
        return to_route("user.show", $id)->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found for delete'], 404);
        }

        $user->delete();
        return response()->json(['success' => true]);
    }
}
