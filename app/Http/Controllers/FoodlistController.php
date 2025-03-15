<?php

namespace App\Http\Controllers;

use App\Models\Foodlist;
use App\Http\Requests\StoreFoodlistRequest;
use App\Http\Requests\UpdateFoodlistRequest;

class FoodlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFoodlistRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Foodlist $foodlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Foodlist $foodlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodlistRequest $request, Foodlist $foodlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Foodlist $foodlist)
    {
        //
    }
}
