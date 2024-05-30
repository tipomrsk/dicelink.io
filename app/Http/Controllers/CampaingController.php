<?php

namespace App\Http\Controllers;

use App\Models\Campaing;
use Illuminate\Http\Request;

class CampaingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Campaing::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Campaing::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Campaing $campaing)
    {
        return $campaing;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Campaing $campaing)
    {
        $campaing->update($request->all());
        return $campaing;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campaing $campaing)
    {
        $campaing->delete();
        return response()->json(null, 204);
    }
}
