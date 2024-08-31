<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\TopUpRequest;
use App\Http\Requests\TransferRequest;
use App\Http\Resources\TransactionResource;
use App\Http\Services\WalletService;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;

class WalletController extends Controller
{
    /**
     * Handle a request to top up the user's wallet.
     *
     * @param TopUpRequest $request
     * @return JsonResponse
     */
    public function topUp(TopUpRequest $request): JsonResponse
    {
        $data = $request->validated();
        $balance = $data['balance'];

        $walletService = new WalletService(auth()->user());

        try {
            $walletService->topUp($balance);
            return response()->json(['message' => 'Top-up successful.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Handle a request to transfer funds from the user's wallet.
     *
     * @param TransferRequest $request
     * @return JsonResponse
     */
    public function transfer(TransferRequest $request): JsonResponse
    {
        $data = $request->validated();
        $recipientId = Crypt::decryptString($data['recipient_id']);
        $recipient = User::find($recipientId);

        if (!$recipient) {
            return response()->json(['message' => 'Recipient not found.'], 404);
        }

        $walletService = new WalletService(auth()->user());

        try {
            $walletService->transfer($recipient, $data['balance']);
            return response()->json(['message' => 'Transfer successful.'], 200);
        } catch (\RuntimeException $e) {
            return response()->json([
                'status' => false,
                'message' => 'inputErrors',
                'errors' => [
                    'balance' => [$e->getMessage()],
                ],
            ], 422);
        }
    }

    /**
     * Get the current balance of the authenticated user.
     *
     * @return JsonResponse
     */
    public function checkBalance(): JsonResponse
    {
        $walletService = new WalletService(auth()->user());
        $balance = $walletService->getBalance();
        return response()->json(['balance' => $balance], 200);
    }

    /**
     * Get the transaction history of the authenticated user.
     *
     * @return JsonResponse
     */
    public function transactionHistory(): JsonResponse
    {
        $walletService = new WalletService(auth()->user());
        $transactions = $walletService->getTransactionHistory();
        return response()->json([
            'transactions' => TransactionResource::collection($transactions)
        ], 200);
    }
}
