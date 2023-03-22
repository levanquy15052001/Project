@extends('page.cart.include_cart.master_cart')
@section('content_cart')
<section id="do_action">
<div class="container">
<div class="col-sm-6 information">
    <p>Thông tin đặt hàng</p>
            <div class="form-one">
                <form action="{{route('save_inforOrder')}}" method="POST" >
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
</div>
</section>

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