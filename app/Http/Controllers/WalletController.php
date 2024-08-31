<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopUpRequest;
use App\Http\Requests\TransferRequest;
use App\Http\Resources\TransactionResource;
use App\Http\Services\WalletService;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class WalletController extends Controller
{

    public function showTopUpForm(): View
    {
        return view('wallet.top-up');
    }

    /**
     * Handle a request to top up the user's wallet.
     *
     * @param TopUpRequest $request
     * @return Response
     */
    public function topUp(TopUpRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $balance = $data['balance'];

        $walletService = new WalletService(auth()->user());

        try {
            $walletService->topUp($balance);
            return redirect()->route('wallet.topUpForm')->with('status', 'Top-up successful.');
        } catch (\Exception $e) {
            return redirect()->route('wallet.topUpForm')->withErrors(['message' => $e->getMessage()])->withInput();;
        }
    }

    public function showTransferForm(): View
    {
        $users = User::where('id', '!=', auth()->id())->get();

        return view('wallet.transfer', compact('users'));
    }
    /**
     * Handle a request to transfer funds from the user's wallet.
     *
     * @param TransferRequest $request
     * @return Response
     */

    public function transfer(TransferRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $recipientId = Crypt::decryptString($data['recipient_id']);
        $recipient = User::find($recipientId);

        if (!$recipient) {
            return redirect()->route('wallet.transferForm')->withErrors(['message' => 'Recipient not found.']);
        }

        $walletService = new WalletService(auth()->user());

        try {
            $walletService->transfer($recipient, $data['balance']);
            return redirect()->route('wallet.transferForm')->with('status', 'Transfer successful.');
        } catch (\RuntimeException $e) {
            return redirect()->route('wallet.transferForm')->withErrors([
                'balance' => [$e->getMessage()],
            ]);
        }
    }




    /**
     * Get the current balance of the authenticated user.
     *
     * @return View
     */
    public function checkBalance(): View
    {
        $walletService = new WalletService(Auth::user());
        $balance = $walletService->getBalance();
        return view('wallet.balance', ['balance' => $balance]);
    }
    /**
     * Get the paginated transaction history of the authenticated user.
     *
     * @return View
     */
    public function transactionHistory(): View
    {
        $walletService = new WalletService(Auth::user());
        $transactions = $walletService->getTransactionHistory();
        return view('wallet.transactions', ['transactions' => $transactions]);
    }
}
