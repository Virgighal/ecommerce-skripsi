<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Shows the homepage to the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        if(auth()->user()->user_level != 'Admin') {
            return redirect()->route('home');
        }

        $comments = Comment::orderBy('id', 'DESC')->groupBy('order_id')->paginate(25);

        foreach($comments as $comment) {
            $orderNumber = '';
            $order = Order::where('id', $comment->order_id)->first();
            if(!empty($order)) {
                $orderNumber = $order->transaction_number;
            }

            $comment->order_number = $orderNumber;
        }

        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $transactionNumber = $request->transaction_number;
        $productName = $request->product_name;

        if(!empty($startDate)) {
            if(empty($endDate)) {
                return redirect()->back()->with('error_message', 'Please select end date!');
            }
        }

        if(!empty($endDate)) {
            if(empty($startDate)) {
                return redirect()->back()->with('error_message', 'Please select start date!');
            }
        }

        $products = Product::orderBy('name', 'ASC');
        if(!empty($productName)) {
            $products = $products->where('name', 'LIKE', '%'.$productName.'%');
        }
        $products = $products->get();

        $dataToReturn = [];

        if(!empty($startDate) && !empty($endDate)) {
            $dataToReturn["date"] = [
                'Tanggal '. Carbon::createFromFormat('Y-m-d', $startDate)->translatedFormat('d F Y').' s/d '. Carbon::createFromFormat('Y-m-d', $endDate)->translatedFormat('d F Y')
            ];
        }

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
            $totalSelledStock = OrderItem::where('product_id', $product->id);
            if(!empty($transactionNumber)) {
                $order = Order::where('transaction_number', $transactionNumber)->first();
                if(!empty($order)) {
                    $totalSelledStock = $totalSelledStock->where('order_id', $order->id);
                }
            }

            if(!empty($startDate) && !empty($endDate)) {
                $totalSelledStock = $totalSelledStock->whereBetween('created_at', [
                    $startDate, $endDate
                ]);
            }

            $totalSelledStock = $totalSelledStock->sum('quantity');

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

        return view('admin.home')
            ->with('comments', $comments)
            ->with('datas', $dataToReturn);
    }
}
