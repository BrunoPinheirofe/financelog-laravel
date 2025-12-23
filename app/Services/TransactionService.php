<?php

class TransactionService
{
    public function createInstallmentTransactions($transaction)
    {

        return $transaction;
    }

    public function calculateTotalAmount($transactions)
    {
        $total = 0;
        foreach ($transactions as $transaction) {
            if ($transaction->type === 'income') {
                $total += $transaction->amount;
            } elseif ($transaction->type === 'expense') {
                $total -= $transaction->amount;
            }
        }

        return $total;
    }
}
