<?php

namespace App\Interfaces;

use App\Responses\TransactionResponse;

interface Transactionable
{
    public function getAllTransaction() : TransactionResponse;

    public function getAllCustomerTransaction($customer_id) : TransactionResponse;

    public function getCustomerCurrentBalance();


}
