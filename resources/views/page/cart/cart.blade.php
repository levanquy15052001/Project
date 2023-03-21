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
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td class="total">Check</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart_item as $item)
                    <tr>
                        <td class="cart_product">
                            <img src={{asset('Eshopper/images/product-details/'.$item->options->image)}} height='70'
                                alt="">
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$item->name}}</a></h4>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($item->price)}} VND</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <div class="quantityupdate">
                                    <form action="{{route('cart.updatecart')}}" method="GET">
                                        @csrf
                                        <input class="cart_quantity_input form-control" type="text" name="cart_quantity"
                                            value="{{$item->qty}}">
                                </div>
                                <input type="hidden" name="id" value="{{$item->rowId}}">
                                <input type="hidden" name="custome" value="update_qty">
                                <button class="btn  btn-default btn-sm ml-1" type="submit" value="update"
                                    name="update_quantity"> Cập nhật</button>
                                </form>

                            </div>
        </div>
        </td>
        <td class="cart_total">
            <p class="cart_total_price">{{number_format($item->price* $item->qty)}} VND</p>
        </td>
        <td>
            <div class="form-check">
                <input class="form-check-input" type="checkbox">
            </div>
        </td>
        <td class="cart_delete">
            <a class="cart_quantity_delete"
                href=" {{ route('cart.updatecart', ['id' => $item->rowId, 'custome' => 'xoa']) }}"><i
                    class="fa fa-times"></i></a>
        </td>
        </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            @if(Cart::subtotal()!=0)
            <td class="cart_total_price">Tổng :</td>
            <td class="cart_total_price">{{Cart::subtotal(0,',','.')}} </td>
            @else
            <td class="cart_total_price"> Giỏ Hàng Trống</td>
            <td></td>
            @endif
        </tr>
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
                    <li>Tổng<span>{{Cart::priceTotal(0,',','.')}}</span></li>
                    <li>Thuế <span>{{Cart::tax(0,',','.')}}</span></li>
                    <li>Phí Vận Chuyển <span>Free</span></li>
                    <li>Thành Tiền <span>{{Cart::total(0,',','.')}}</span></li>
                </ul>
            </div>
        </div>
        @if(count($Customer->user_has_information)==0)
        <div class="col-sm-6 information">
                <p>Thông tin đặt hàng</p>
                        <div class="form-one">
                            <form action="{{route('check_out')}}" method="POST" >
                                @csrf
                                <input type="text" placeholder="Email" name="email" value="{{old('email')}}">
                                @if($errors->has('email'))
                                    <div class="text-danger" >{{ $errors->first('email') }}</div>
                                @endif
                                <input type="text" placeholder="Họ Tên" name="name" value="{{old('name')}}">
                                @if($errors->has('name'))
                                    <div class="text-danger" >{{ $errors->first('name') }}</div>
                                @endif
                                <input type="text" placeholder="Số điện thoại" name="phone" value="{{old('phone')}}">
                                @if($errors->has('phone'))
                                    <div class="text-danger" >{{ $errors->first('phone') }}</div>
                                @endif
                                    <select id="city" class="form-control address_new" name="city">
                                    <option value="" selected>Chọn tỉnh thành</option>           
                                    </select>
                                    @if($errors->has('city'))
                                        <div class="text-danger" >{{ $errors->first('city') }}</div>
                                    @endif 
                                    <select id="district" class="form-control address_new" name="district">
                                    <option value="" selected>Chọn quận huyện</option>
                                    </select>
                                    @if($errors->has('district'))
                                        <div class="text-danger" >{{ $errors->first('district') }}</div>
                                    @endif 
                                    <select id="ward" class="form-control address_new" name="ward">
                                    <option value="" selected>Chọn phường xã</option>
                                    </select> 
                                    @if($errors->has('ward'))
                                        <div class="text-danger" >{{ $errors->first('ward') }}</div>
                                    @endif 
                                <input type="text" placeholder="Địa chỉ" name="address" value="{{old('address')}}">
                                @if($errors->has('address'))
                                    <div class="text-danger" >{{ $errors->first('address') }}</div>
                                @endif
                                <textarea name="note" placeholder="note order " cols="50" rows="10"></textarea>
                                <button type="submit" class=" btn btn-primary"> Gửi</button>
                            </form>
                        </div>
        </div>
        @else
        <div class="col-sm-6 information">
            <p>Thông tin đặt hàng</p>
            <form action="{{route('check_out')}}" method="POST" >
            @csrf
            @foreach($Customer->user_has_information as $value)
            <div class="form-check">
                <input class="form-check-input" type="radio" name="id_address" id="exampleRadios1" value="{{$value->id}}" checked>
                <label class="form-check-label" for="exampleRadios1">
                    Người Nhận: {{$value->name}}  {{$value->address}} Sdt:   {{$value->phone}}
                    Ghi chu :{{$value->note}}
                </label>
              </div>
            @endforeach
            <button type="submit" class=" btn btn-primary"> Gửi</button>
        </form>
        </div>
        @endif
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