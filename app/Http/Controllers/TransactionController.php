<?php

namespace App\Http\Controllers;

use App\Events\MadePayment;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Transaction;
use App\Responses\TransactionResponse;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class TransactionController extends BaseController
{
    public function __construct(public TransactionService $transactionService)
    {
    }

    public function initiateTransaction(Request $request)
    {
        $data = $request->validate([
            'customer_id' => ['uuid','required'],
            'product_id' => ['uuid','required'],
            'quantity' => ['integer','required'],
        ]);
        try{
            DB::beginTransaction();

            $product = Product::find($data['product_id']);
            $total =  $data['quantity'] * $product['price'];
            $transaction = Transaction::create([
                'customer_id' => $data['customer_id'],
                'product_id' => $data['product_id'],
                'total_amount' => $total,
                'quantity' => $data['quantity'],
            ]);
            Order::create([
                'transaction_id' => $transaction->id,
                'amount_paid' => 0,
                'total_amount' => $total,
                'status' => 'pending'
            ]);
            $transactionRes = new TransactionResponse();
            $transactionRes->setMessage("Transaction Stored");
            $transactionRes->setData($transaction);

            DB::commit();
            return $this->success("Transaction Stored", $transactionRes->getData());
        }
        catch (\Exception $exception){
            DB::rollBack();
            Log::error("A transaction error occurred: " . $exception->getMessage());
            return $this->error("An error occurred", 400);
        }


    }

    public function makePayment(Request $request)
    {
        $data = $request->validate([
            'customer_id' => ['required','uuid'],
            'transaction_id' => ['required','uuid'],
            'amount' => ['required', 'decimal:0,2']
        ]);

        try {
            DB::beginTransaction();
            $order = Order::where('transaction_id',$data['transaction_id'])->where('status','pending')->first();
            if($data['amount'] > $order->total_amount - $order->amount_paid){
                return $this->error("Excess Payment", 400);
            }

            $payment = Payment::create([
                'customer_id' => $data['customer_id'],
                'transaction_id' => $data['transaction_id'],
                'amount' => $data['amount']
            ]);

            MadePayment::dispatch($payment);

            DB::commit();
            return $this->success("Payment made successfully", $payment->makeHidden('id'));
        }
        catch (\Exception $exception){
            DB::rollBack();
            Log::error($exception->getMessage());
            return $this->error("An error occurred", 400);
        }

    }

    public function getAllCustomerTransaction(Request $request)
    {
        $data = $request->validate([
            'customer_id' => ['uuid','required']
        ]);

        try {
            $transaction = $this->transactionService->getAllCustomerTransaction($data['customer_id']);
            if (!$transaction->isSuccess()) {
                return $this->error($transaction->getMessage(), 400);
            }

            return $this->success($transaction->getMessage(), $transaction->getSingle());
        }
        catch (\Exception $exception){
            Log::error("An error occurred: " . $exception);
            return $this->error("An error occurred", 400);
        }
    }
}
