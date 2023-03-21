@extends('page.cart.include_cart.master_cart')
@section('content_cart')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">PayMent</li>
            </ol>
        </div><!--/breadcrums-->
        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-5 ">
                    <div class="bill-to">
                        <p>Thông tin đơn hàng của bạn</p>
                        <div class="form-one">
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                </div>					
            </div>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Sản Phẩm</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số Lượng</td>
                        <td class="total">Tổng Tiền</td>
                        <td>Trạng Thái</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($CartShow as $key =>$value)
              
                    <tr>
                        <td class="cart_product">
                                <img src="{{asset('Eshopper/images/product-details/'.$value->shoping_has_product->product_img)}}" height="200" alt="">
                        </td>
                        <td class="cart_description">
                            <h4>{{number_format($value->shoping_has_product->product_price)}} VND</h4>
                        </td>
                        <td class="cart_price">
                          <p>{{$value->qty}}</p>
                        </td>
                        <td class="cart_quantity">
                            <p class="cart_total_price">
                                {{number_format($value->qty * $value->shoping_has_product->product_price)}}
                            </p>
                        </td>
                        <td>{{$value->status==1? 'Đang chờ xác nhận': 'Đã Giao Hàng'}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="brother"> 
        
            <a href="{{route('pdf_user')}}"class="btn btn-primary">  In Hóa Đơn </a>
        </div>
       
        
    </div>
</section> <!--/#cart_items-->
@endsection