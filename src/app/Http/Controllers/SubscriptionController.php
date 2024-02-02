<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Services\SubscriptionService;

class SubscriptionController extends Controller
{

    public function __construct(
        private SubscriptionService $subscriptionService
    ) {
    }

    public function subscribe(SubscriptionRequest $request)
    {
        response()->json([
            $this->subscriptionService->subscribe($request->validated())
        ]);

    }
}
