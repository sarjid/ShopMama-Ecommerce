<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Invoice</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }

    .gray {
        background-color: lightgray
    }
    .font{
      font-size: 15px;
    }
    .authority {
      
        /*text-align: center;*/
        float: right
    }

    .authority h5 {
        margin-top: -10px;
        color: #ec5d01;
        /*text-align: center;*/
        margin-left: 35px;
       
    }
    
    .thanks p {
        color: #ec5d01;;
        font-size: 16px;
        font-weight: normal;
        font-family: serif;
        margin-top: 20px;
    }
</style>

</head>
<body>

  <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
    <tr>
        <td valign="top">
          {{-- <img src="" alt="" width="150"/> --}}
          <h2 style="color: #ec5d01; font-size: 26px;"><strong>SHopMama</strong></h2>
          
        </td>
        <td align="right" >        
            <pre class="font" >
               ShopMama Head Office
               Email:shopmama@gmail.com <br>
               Mob: 01722260010 <br>
               Dhaka 1207,Dhanmondi:#4 <br>
               Dhaka ,Bangladesh
            </pre>
        </td>
    </tr>

  </table>
  <table width="100%" style="background:white; padding:2px;""></table>
  <table width="100%" style="background: #F7F7F7; padding:0 5 0 5px;" class="font">
    <tr>
        <td>
          <p class="font" style="margin-left: 20px;">
           <strong>Name:</strong> {{ $shipping->shipping_name }} <br>
           <strong>Email:</strong> {{ $shipping->shipping_email }} <br>
           <strong>Phone:</strong> {{ $shipping->shipping_phone }} <br>
            @php
                $div = $shipping->division->division_name;
                $dis = $shipping->district->district_name;
                $sts = $shipping->state->state_name;
                $division_name = substr($div, 0, strpos($div,'-'));
                $district_name = substr($dis, 0, strpos($dis,'-'));
                $state_name = substr($sts, 0, strpos($sts,'-'));
            @endphp
           <strong>Address:</strong> {{ $division_name }}, 
            {{ $district_name }}, 
            {{ $state_name }} <br> 
           <strong>Post Code:</strong> {{ $shipping->post_code }}
         </p>
        </td>
        <td>
          <p class="font">
            <h3><span style="color: #ec5d01;">Invoice:</span> #{{ $order->invoice_no }}</h3>
            Order Date: {{ $order->order_date }} <br>
            @if ($order->delivered_date == NULL)
             @else   
             Due Date: {{ Carbon\Carbon::parse($order->delivered_date)->format('d F Y') }} <br>
            @endif
            Payment Type : <span style="color:#ec5d01;">{{ $order->payment_type }}</span>
         </p>
        </td>
    </tr>

  </table>

  <br/>
<h3>Products</h3>
  <table width="100%">
    <thead style="background-color: #ec5d01; color:#FFFFFF;">
      <tr class="font">
        <th>Product Name</th>
        <th>Size</th>
        <th>Color</th>
        <th>Code</th>
        <th>Quantity</th>
        <th>Unit Price </th>
        <th>Total </th>
      </tr>
    </thead>
    <tbody>
     
      @foreach ($order_details as $row)
      <tr class="font">
        <td align="center">{{ $row->product->product_name_en }}</td>
        @if ($row->size == NULL)
        <td align="center">.....</td>  
        @else
        <td align="center">{{ $row->size }}</td>  
        @endif
        <td align="center">{{ $row->color }}</td>
        <td align="center">{{ $row->product->product_code }}</td>
        <td align="center">{{ $row->quantity }}</td>
        <td align="center">{{ $row->single_price }}.tk</td>
        <td align="center">{{ $row->total_price }}.tk</td>
      </tr>
      @endforeach
    </tbody>

  </table>
 
  <br>

  <table width="100%" style=" padding:0 10px 0 10px;">
    <tr>
        <td align="right" >
            <h2><span style="color: #ec5d01;">Subtotal:</span> {{ $order->subtotal }}.tk</h2>
            <h2><span style="color: #ec5d01;">Total:</span> {{ $order->paying_amount }}.tk</h2>
            {{-- <h2><span style="color: green;">Full Payment PAID</h2> --}}
         
        </td>
    </tr>

  </table>

  <div class="thanks mt-3">
    <p>Thanks For Buying Products..!!</p>
  </div>

  <div class="authority float-right mt-5">
      <p>-----------------------------------</p>
      <h5>Authority Signature:</h5>
    </div>

</body>
</html>