<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Http\Response;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("TableUsers", [
            "users" => User::with('address')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        return Inertia::render("CreateAddress", [
            "user_id" => $id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressRequest $request, string $id)
    {
        try {
            Address::create($request->validated());
            return redirect()->route('user.show', $id)->with('success', 'Dirección creada correctamente');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $user, string $address)
    {
        $address = Address::where('id', $address)->where('user_id', $user)->first();
        if (!$address) {
            return redirect()->route('user.show', $user)->with('error', 'Dirección no encontrada');
        }

        return Inertia::render("EditAddress", [
            "address" => $address,
            "user_id" => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $user, string $address)
    {
       $searchAddress = Address::where('id', $address)->where('user_id', $user)->first();
        if (!$searchAddress) {
            return redirect()->route('user.show', $user)->with('error', 'Dirección no encontrada');
        }

        $searchAddress->update($request->all());
        return redirect()->route('user.show', $user)->with('success', 'Dirección actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $user, string $address)
    {
        $address = Address::where('id', $address)->where('user_id', $user)->first();
        if (!$address) {
            return redirect()->route('user.show', $user)->with('error', 'Dirección no encontrada');
        }

        $address->delete();
        return redirect()->route('user.show', $user)->with('success', 'true');
    }
}
