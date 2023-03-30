@extends('admin.include_admin.Master_admin')
@section('content_admin')
@push('style')
<style>
  .error{
    width: 100% !important;
    color: red;
    font-size: 1rem !important;
  }
</style>
@endpush
<div class="card shadow mb-4">
  <div class="card-body">
    <section class="panel panel-default">
      <div class="panel-heading"> 
      <h3 class="panel-title">Thêm Sản Phẩm</h3> 
      </div> 
          @if (\Session::has('msg'))
          <div class="col-sm-offset-3 col-sm-9">
          <span  class=" alert alert-success text-center">{!! \Session::get('msg') !!}</span>
        </div>
          @endif
      <div class="panel-body">
      <form action="{{route('add_product')}}" method="POST" id="add_product" class="form-horizontal" role="form" enctype="multipart/form-data">
         <div class="form-group">
          <label for="name" class="col-sm-3 control-label">Tên Sản Phẩm</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="product_name"  id="product_name" value="{{old('product_name')}}">
            @error('product_name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Hình Chính Của Ảnh Sản Phẩm</label>
            <div class="col-sm-9">
              <input type="file" class="form-control" name="product_img" id="product_img">
              @error('product_img')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
        <div class="form-group">
          <label for="name" class="col-sm-3 control-label">Giá Sản Phẩm</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" name="product_price" id="product_price"  value="{{old('product_price')}}"> 
            @error('product_price')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
        <div class="form-group">
          <label for="about" class="col-sm-3 control-label">Mô Tả Sản Phẩm</label>
          <div class="col-sm-9">
            <textarea class="form-control" id="desc_product" rows="5" name="product_desc" id="product_desc" >{{old('product_desc')}}</textarea>
            @error('product_desc')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label for="about" class="col-sm-3 control-label">Nội Dung Sản Phẩm</label>
            <div class="col-sm-9">
              <textarea class="form-control" rows="5" id="content_product" name="product_content" >{{old('product_content')}}</textarea>
            @error('product_content')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            </div>
        </div> <!-- form-group // -->
        <div class="form-group">
          <label for="tech" class="col-sm-3 control-label">Danh Mục</label>
          <div class="col-sm-3">
         <select class="form-control" name="product_category" id="product_category">
          <option value=""></option>
          @foreach ($categoty as $item)
          <option value="{{$item->category_id}}" {{old('product_category')?'selected="selected"':''}}>{{$item->category_name}}</option>
          @endforeach
         </select>
         @error('product_category')
         <div class="text-danger">{{ $message }}</div>
         @enderror
          </div>
        </div> <!-- form-group // -->
        <div class="form-group">
          <label for="tech" class="col-sm-3 control-label">Thương Hiệu</label>
          <div class="col-sm-3">
         <select class="form-control" name="product_brand" id="product_brand">
          <option value=""></option>
          @foreach ($brand as $item)
          <option value="{{$item->brand_id}}" {{old('product_brand')?'selected="selected"':''}}>{{$item->brand_name}}</option>
          @endforeach
         </select>
         @error('product_brand')
         <div class="text-danger">{{ $message }}</div>
         @enderror
          </div>
        </div> <!-- form-group // -->
        <div class="form-group">
          <label for="tech" class="col-sm-3 control-label">Ẩn/ Hiện</label>
          <div class="col-sm-3">
         <select class="form-control" name="product_status" id="product_status">
          <option value=""></option>
          <option value="1"{{old('product_status') ==1 ? 'selected="selected"' : ''}} >Ẩn</option>
          <option value="2"{{old('product_status') ==2 ? 'selected="selected"' : ''}}>Hiện</option>
         </select>
         @error('product_status')
         <div class="text-danger">{{ $message }}</div>
         @enderror
          </div>
        </div> <!-- form-group // -->
        <hr>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
          </div>
          @if (\Session::has('msg'))
          <div class="col-sm-offset-3 col-sm-9">
          <span  class=" alert alert-success text-center">{!! \Session::get('msg') !!}</span>
        </div>
          @endif
        </div> <!-- form-group // -->
        @csrf
      </form>
        
      </div><!-- panel-body // -->
      </section><!-- panel// -->
  </div>
</div>
@endsection

@push('script')
       <!-- Custom script for this template-->
      <script>
          // ClassicEditor
          //   .create( document.querySelector( '#desc_product' ) )
          //   .catch( error => {
          //       console.error( error );
          //   } );
            
          // ClassicEditor
          // .create( document.querySelector( '#content_product' ) )
          // .catch( error => {
          //     console.error( error );
          // } );
      // Validate
      jQuery.validator.addMethod("uploadFile", function (val, element) {

var size = element.files[0].size;
  console.log(size);

 if (size > 1048576)// checks the file more than 1 MB
 {
     console.log("returning false");
      return false;
 } else {
     console.log("returning true");
     return true;
 }

}, "File type error");
      $("#add_product").validate({
      
        rules: {
          product_name: "required",
          product_img:{
              required: true,
              accept: "image/jpeg, image/png, image/gif"
          },
          datecreate:{
            required: true,
            date: true,
            dateISO: true,
            dateFormat: "d-M-y"
          },
          product_price:'required',
          product_desc:'required',
          product_content:'required',
          product_category:'required',
          product_brand:'required',
          product_status:"required"
        },
        messages: {
          datecreate: {
            required: "Please enter a date",
          }
      },

        submitHandler: function(form) {
            form.submit();
          }
		  });
      </script>
@endpush