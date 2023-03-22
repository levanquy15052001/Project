<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/pdf.css')}}">
        <title>Hóa đơn</title>
    </head>
    <style>
        .text-red{
            color: red;
        }
    </style>
    <body>
        <h1> Hóa Đơn Mua Hàng</h1>
        <div>Tên khách hàng: {{$user->name}}
               
        </div>
        <div>Số điện thoại:    
            {{$user->phone}}
        </div>
        <div>Ghi chú:   
            
        </div>

        <div>Nội Dung Đơn Hàng</div>
        <table>
            <tr>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
        @foreach ($data as  $key => $item)
            <tr>
                <td>{{$item->product_name}}</td>
                <td>{{number_format($item->tbl_cart_price)}}</td>
                <td>{{$item->qty}}</td>
                <td>{{number_format($item->tbl_cart_price * $item->qty)}} VND</td>
            </tr>
           
            @if( @$data[$key]->id_information  !=  @$data[$key+1]->id_information)
            <tr class="text-red">
                <td colspan="4">Nơi Nhận: {{$item->information_address}}</td>
               
            </tr>
            <tr class="text-red">
                <td colspan="4">SDT: {{$item->phone}}</td>
               
            </tr>
            <tr class="text-red"> <td colspan="4">Ghi Chú: {{$item->note}}</td></tr>
            @endif
        @endforeach
          
            <tr>
                <td colspan="3" style="text-align: right;">Tổng cộng:</td>
                <td>{{number_format($sumPrice)}}VNĐ</td>
            </tr>
        </table>
    </body>
</html>