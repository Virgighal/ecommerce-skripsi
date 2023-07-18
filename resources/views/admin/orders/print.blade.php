<!DOCTYPE html>
<html>
<head>
  <title>Receipt</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    h2 {
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    
    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    
    th {
      background-color: #f2f2f2;
    }

    .total {
      font-weight: bold;
    }
  </style>
    <script>
        window.onload = function() {
          window.print();
        };
    </script>
</head>
<body>
    <div style="display: flex">
        <img src="{{ asset('web-asset/img/logo.jpeg') }}" alt="Image" style="width: 70px;height:70px;border-radius:10px">
        <div style="line-height: 1.5px">
            <h4 class="text-white text-uppercase">Warung Mbo'e</h4>
            <p><i class="fa fa-map-marker-alt mr-2"></i>BSI 2 Jl. Cendrawasih 9A Blok C4 RT 04/10 No 12 Kelurahan Pengasinan, Kecamatan Sawangan, Kota Depok, Kode Pos 16518</p>
            <p><i class="fa fa-phone-alt mr-2"></i>+62812-8304-4180 (Ibu Kuswati)</p>
            <p><i class="fa fa-phone-alt mr-2"></i>+62878-7630-7623 (Wahyu Rasyid Almanan)</p>
            <p class="m-0"><i class="fa fa-envelope mr-2"></i>achmadnurrohman9@gmail.com</p>
            <p class="m-0"><i class="fa fa-envelope mr-2"></i>wahyurasyidalmanan@gmail.com</p>
        </div>
    </div>
    <h2 style="text-align: center">#{{ $order->transaction_number }}</h2>
  <table>
    <tr>
      <th>Order Date</th>
      <th>Order User Name</th>
      <th>Total Price</th>
      <th>Delivery Address</th>
    </tr>
    <tr>
      <td>{{ $order->created_at }}</td>
      <td>{{ $order->user_name }}</td>
      <td>{{ number_format($order->total_price) }}</td>
      <td>{{ $order->delivery_address }}</td>
    </tr>
  </table>
  
  <h2>Order Items</h2>
  <table>
    <tr>
      <th>Product Name</th>
      <th>Quantity</th>
      <th>Price</th>
    </tr>
    @foreach($order->items as $item)
        <tr>
            <td> {{ !empty($item->product) ? $item->product->name : 'N/A' }}</td>
            <td>{{ number_format($item->quantity) }}</td>
            <td>Rp. {{ number_format($item->price) }}</td>
        </tr>
    @endforeach
    <tr>
      <td colspan="2" class="total">Total:</td>
      <td class="total">Rp. {{ number_format($order->total_price) }}</td>
    </tr>
  </table>
  <h4 style="text-align:center">---Terima Kasih---</h4>
</body>
</html>