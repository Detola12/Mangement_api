<?php

namespace App\Services;

use App\Interfaces\Transactionable;
use App\Models\Customer;
use App\Models\Transaction;
use App\Responses\TransactionResponse;

class TransactionService implements Transactionable
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAllTransaction() : TransactionResponse
    {
        $transactions = Transaction::paginate(20);
        $transactionRes = new TransactionResponse();
        $transactionRes->setIsSuccess(true);
        $transactionRes->setMessage("Transactions fetched");
        $transactionRes->setData($transactions);
        return $transactionRes;
    }

    public function getAllCustomerTransaction($customer_id): TransactionResponse
    {
        $transactions = Transaction::with('customer')->where('customer_id',$customer_id)->get();
        $transactionRes = new TransactionResponse();
        if(!$transactions){
            //
        }
        $transactionRes->setIsSuccess(true);
        $transactionRes->setMessage("Transactions fetched");
        $transactionRes->setData($transactions);
        return $transactionRes;
    }

    public function getCustomerCurrentBalance()
    {
        // TODO: Implement getCustomerCurrentBalance() method.
    }
}
