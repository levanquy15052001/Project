@extends('page.cart.include_cart.master_cart')
@section('content_cart')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        @error('msg')
            <span class="mx-auto text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image" colspan="2">Item</td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Quantity</td>
                        <td colspan="1"></td>
                    </tr>
                </thead>
                <tbody>
                @foreach($order as $items)
                    <tr>
                        <td class="cart_product">
                            <img src={{asset('Eshopper/images/product-details/'.$items->product_img)}} height='70'
                                alt="">
                        </td>
                        <td class="cart_description">
                            <h4><a href="" class="cart_name_product_ajax">{{$items->product_name}}</a></h4>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($items->product_price)}} VND</p>
                        </td>
                        <td class="cart_quantity">
                            <input type="button" name="down-to-qty" value="-" data-id_product="{{$items->product_id}}" class="btn btn-fefault cart action-to-qty">
                            <input type="text" name="" value="  {{$items->qty}} " id="" @readonly(true) class="btn btn-fefault">
                            <button type="button" name="up-to-qty" data-id_product="{{$items->product_id}}" id="up-to-qty" class="btn btn-fefault cart up-to-qty">+</button>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price"> {{number_format($items->product_price * $items->qty )}}VND</p>
                            
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete"
                                href=""><i
                                    class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
            </table>
    </div>
    </div>
</section>
<!--/#cart_items-->
<section id="do_action">
    <div class="container">
        <div class="col-sm-6">
            <div class="total_area">
                <ul>
                    <li>Tổng<span> {{number_format($sumOrder)}} VND</span></li>
                    <li>Thuế <span></span></li>
                    <li>Phí Vận Chuyển <span>Free</span></li>
                    <li>Thành Tiền <span></span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 information">
                <p>Thông tin đặt hàng</p>
                        <div class="form-one">
                            <form action="" method="POST" >
                                @csrf
                                <input type="text" placeholder="Email" name="email" >   
                                <input type="text" placeholder="Họ Tên" name="name" >
                             
                                <input type="text" placeholder="Số điện thoại" name="phone">
                               
                                    <select id="city" class="form-control address_new" name="city">
                                    <option value="" selected>Chọn tỉnh thành</option>           
                                    </select>
                                  
                                    <select id="district" class="form-control address_new" name="district">
                                    <option value="" selected>Chọn quận huyện</option>
                                    </select>
                                   
                                    <select id="ward" class="form-control address_new" name="ward">
                                    <option value="" selected>Chọn phường xã</option>
                                    </select> 
                                  
                                <input type="text" placeholder="Địa chỉ" name="address" >
                              
                                <textarea name="note" placeholder="note order " cols="50" rows="10"></textarea>
                                <button type="submit" class=" btn btn-primary"> Gửi</button>
                            </form>
                        </div>
        </div>
        <div class="col-sm-6 information">
            <p>Thông tin đặt hàng</p>
            <form action="" method="POST" >
            @csrf
          
            <div class="form-check">
                <input class="form-check-input" type="radio" name="id_address" id="exampleRadios1" value="" checked>
                <label class="form-check-label" for="exampleRadios1">
                    Người Nhận: Sdt:
                    Ghi chu :
                </label>
              </div>
           
            <button type="submit" class=" btn btn-primary"> Gửi</button>
            <button type="submit" class=" btn btn-primary" name="address"> Thêm Địa Chỉ Mới</button>
        </form>
        </div>
       
    </div>
</section>
<!--/#do_action-->

@endsection
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
 
        var citis = document.getElementById("city");
        var districts = document.getElementById("district");
        var wards = document.getElementById("ward");
        var Parameter = {
        url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json", 
        method: "GET", 
        responseType: "application/json", 
        };
        var promise = axios(Parameter);
        promise.then(function (result) {
        renderCity(result.data);
        });

        function renderCity(data) {
        for (const x of data) {
        var opt = document.createElement('option');
        opt.value = x.Name;
        opt.text = x.Name;
        opt.setAttribute('data-id', x.Id);
        citis.options.add(opt);
        }
        citis.onchange = function () {
        district.length = 1;
        ward.length = 1;
        if(this.options[this.selectedIndex].dataset.id != ""){
        const result = data.filter(n => n.Id === this.options[this.selectedIndex].dataset.id);

        for (const k of result[0].Districts) {
            var opt = document.createElement('option');
            opt.value = k.Name;
            opt.text = k.Name;
            opt.setAttribute('data-id', k.Id);
            district.options.add(opt);
        }
        }
        };
        district.onchange = function () {
        ward.length = 1;
        const dataCity = data.filter((n) => n.Id === citis.options[citis.selectedIndex].dataset.id);
        if (this.options[this.selectedIndex].dataset.id != "") {
        const dataWards = dataCity[0].Districts.filter(n => n.Id === this.options[this.selectedIndex].dataset.id)[0].Wards;

        for (const w of dataWards) {
            var opt = document.createElement('option');
            opt.value = w.Name;
            opt.text = w.Name;
            opt.setAttribute('data-id', w.Id);
            wards.options.add(opt);
        }
        }
        };
        }
</script>
@endpush