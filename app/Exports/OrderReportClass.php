<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;

class OrderReportClass implements FromArray
{
    protected $startDate;
    protected $endDate;
    protected $transactionNumber;
    protected $productName;

    public function __construct($startDate, $endDate, $transactionNumber, $productName)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->transactionNumber = $transactionNumber;
        $this->productName = $productName;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        $orders = new Order;

        if(!empty($this->startDate) && !empty($this->endDate)) {
            $orders = $orders->whereBetween('created_at', [
                $this->startDate, $this->endDate
            ]);
        }

        if(!empty($this->transactionNumber)) {
            $orders = $orders->where('transaction_number', $this->transactionNumber);
        }

        if(!empty($this->productName)) {
            $product = Product::where('name', $this->productName)->first();
            if(!empty($product)) {
                $orderIds = OrderItem::where('product_id', $product->id)->pluck('order_id')->toArray();
                $orders = $orders->whereIn('id', $orderIds);
            }
        }

        $orders = $orders->get();

        $dataToReturn = [];

        $header = [
            'TRANSACTION NUMBER',
            'ORDER DATE',
            'CUSTOMER',
            'ORDER METHOD',
            'DELIVERY ADDRESS',
            'DELIVERY FEE',
            'PRODUCT NAME',
            'QUANTITY',
            'PRICE',
            'AMOUNT'
        ];

        $dataToReturn['header'] = $header;
        
        $contents = [];
        $grandTotal = 0;
        foreach($orders as $order) {
            $orderItems = OrderItem::where('order_id', $order->id)->get();
            foreach($orderItems as $orderItem) {
                $product = Product::where('id', $orderItem->product_id)->first();
                $productName = 'N/A';
                if(!empty($product)) {
                    $productName = $product->name;
                }

                $amount = $orderItem->quantity * $orderItem->price;
                $grandTotal += $amount;

                $contents[] = [
                    (string) $order->transaction_number,
                    Carbon::createFromFormat('Y-m-d H:i:s', $order->created_at)->format('d/m/Y H:i:s'),
                    $order->user_name,
                    $order->payment_method,
                    $order->delivery_address,
                    $order->delivery_fee ?? 0,
                    $productName,
                    $orderItem->quantity,
                    'Rp. '.number_format($orderItem->price),
                    'Rp. '.number_format($amount)
                ];
            }
        }

        $dataToReturn['content'] = $contents;

        $footer = [
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            'GRAND TOTAL'
        ];

        $footer[] = 'Rp. '.number_format($grandTotal);
        $dataToReturn['footer'] = $footer;
        
        return $dataToReturn;
    }
}
