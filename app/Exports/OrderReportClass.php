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
        $products = Product::orderBy('name', 'ASC');
        if(!empty($productName)) {
            $products = $products->where('name', 'LIKE', '%'.$productName.'%');
        }
        $products = $products->get();

        $dataToReturn = [];

        $dataToReturn[] = ["LAPORAN PENJUALAN"];
        $dataToReturn[] = ["WARUNG Mbo'e"];
        if(!empty($this->startDate) && !empty($this->endDate)) {
            $dataToReturn[] = [
                Carbon::createFromFormat('Y-m-d H:i:s', $this->startDate)->format('d F Y').' s/d '. Carbon::createFromFormat('Y-m-d H:i:s', $this->endDate)->format('d F Y')
            ];
        }
        $dataToReturn[] = [""];

        $header = [
            'NO',
            'PRODUK',
            'JUMLAH STOK TERSEDIA',
            'JUMLAH STOK TERJUAL',
            'HARGA PRODUK',
            'TOTAL PENJUALAN'
        ];

        $dataToReturn['header'] = $header;
        
        $contents = [];
        $grandTotal = 0;
        $no = 1;
        foreach($products as $product) {
            $totalSelledStock = OrderItem::where('product_id', $product->id)->get()->sum('quantity');
            $totalSalesPerProduct = $totalSelledStock * $product->price;

            $grandTotal += $totalSalesPerProduct;

            $contents[] = [
                $no++,
                $product->name,
                $product->stock,
                $totalSelledStock ?? '0',
                'Rp. '.number_format($product->price),
                'Rp. '.number_format($totalSalesPerProduct),
            ];
        }

        $dataToReturn['content'] = $contents;

        $footer_1 = [
            '',
            '',
            '',
            '',
            'GRAND TOTAL',
        ];

        $footer_1[] = 'Rp. '.number_format($grandTotal);
        $dataToReturn['footer_1'] = $footer_1;
        
        return $dataToReturn;
    }
}
