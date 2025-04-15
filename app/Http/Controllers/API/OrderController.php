<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\Order;
use App\Services\OrderService;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
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
    public function store(StoreOrderRequest $request): JsonResponse
    {
        $validated = $request->validated();
        OrderService::create($validated, Auth::user());
        return response()->json();
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $m)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $m)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $m)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $m)
    {
        //
    }
}
