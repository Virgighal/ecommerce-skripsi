<!DOCTYPE html>
<html>
<head>
  <title>Laporan Penjualan</title>
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
            <h4 class="text-white text-uppercase">Laporan Penjualan Warung Mbo'e</h4>
            @if (!empty($datas['date'][0]))
                <p>{{ $datas['date'][0] }}</p>
            @endif
        </div>
    </div>
  <table>
    <tr>
        @foreach ($datas['header'] as $header)
            <th>{{ $header }}</th>
        @endforeach
    </tr>
    @foreach ($datas['content'] as $content)
        <tr>
            @foreach ($content as $item)
                <th>{{ $item }}</th> 
            @endforeach
        </tr>
    @endforeach
    <tr>
        @foreach ($datas['footer_1'] as $footer)
            <th>{{ $footer }}</th>
        @endforeach
    </tr>
  </table>
  
  {{-- <h2>Order Items</h2>
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
    @endforeach --}}
    <tr>
      <td colspan="2" class="total">Total:</td>
      {{-- <td class="total">Rp. {{ number_format($order->total_price) }}</td> --}}
    </tr>
  </table>
  <h4 style="text-align:center">---Terima Kasih---</h4>
</body>
</html>