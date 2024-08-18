<?php


namespace App\Responses;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TransactionResponse
{
    protected bool $isSuccess;
    protected string $message;
    protected Model|Collection|array $data;

    /**
     * @param bool $isSuccess
     */
    public function setIsSuccess(bool $isSuccess): void
    {
        $this->isSuccess = $isSuccess;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param Model|Collection $data
     */
    public function setData(Model|Collection $data): void
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            'Customer Name' => $this->data->customer->first_name . ' ' . $this->data->customer->last_name,
            'Product Name' => $this->data->product->name,
            'Total amount' => $this->data->total_amount,
            'Quantity' => $this->data->quantity
        ];
    }

    public function getSingle(): array
    {
        $data = [];
        foreach ($this->data as $key => $item){
            $data[$key] = [
                'Customer Name' => $item->customer->first_name . ' ' . $item->customer->last_name,
                'Product Name' => $item->product->name,
                'Total amount' => $item->total_amount,
                'Quantity' => $item->quantity
            ];
        }
        return $data;
    }
}
