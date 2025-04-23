<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\Order;
use App\Models\Work;
use App\Services\OrderService;
use Auth;
use Carbon\Carbon;
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
        $order_files = $request->file('files');

        $order = OrderService::create($validated, $order_files, Auth::user());

        if(!$order){
             return response()->json(['message' => 'Заказ уже существует. Удалите предыдущий, чтобы создать новый'], 418);
        }

        return response()->json();
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order): JsonResponse
    {
        OrderService::destroy($order);
        return response()->json();
    }

    public function accept(Order $order): JsonResponse
    {
        OrderService::accept($order, Auth::user());
        return response()->json();
    }

    public function reject(Order $order): JsonResponse
    {
        OrderService::reject($order, Auth::user());
        return response()->json();
    }

    public function complete(Order $order): JsonResponse
    {
        OrderService::complete($order, Auth::user());
        return response()->json();
    }
}
