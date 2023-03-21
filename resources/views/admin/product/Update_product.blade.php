@extends('admin.include_admin.Master_admin')
@section('content_admin')
@push('style')
@endpush
<div class="container">
    <section class="panel panel-default">
  <div class="panel-heading"> 
  <h3 class="panel-title">Cập Nhật Sản Phẩm</h3> 
  </div> 
      @if (\Session::has('msg'))
      <div class="col-sm-offset-3 col-sm-9">
      <span  class=" alert alert-success text-center">{!! \Session::get('msg') !!}</span>
    </div>
      @endif
  <div class="panel-body">
  <form action="{{route('update_pruduct')}}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
     <div class="form-group">
      <label for="name" class="col-sm-3 control-label">Tên Sản Phẩm</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="product_name"  value="{{$data->product_name}}">
        <input type="hidden" name="id" value="{{$data->product_id}}">
        <input type="hidden" name="img" value="{{$data->product_img}}">
        @error('product_name')
        <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Hình Ảnh Sản Phẩm</label>
        <div class="col-sm-9">
          <input type="file" class="form-control" name="product_img" >
          <img src={{asset('Eshopper/images/product-details/'.$data->product_img)}}>
          @error('product_img')
          <div class="text-danger">{{ $message }}</div>
          @enderror
        </div>
    <div class="form-group">
      <label for="name" class="col-sm-3 control-label">Giá Sản Phẩm</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="product_price"  value="{{$data->product_price}}">
        @error('product_price')
        <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
    <div class="form-group">
      <label for="about" class="col-sm-3 control-label">Mô Tả Sản Phẩm</label>
      <div class="col-sm-9">
        <textarea class="form-control" rows="5" name="product_desc" > {{$data->product_desc}}</textarea>
        @error('product_desc')
        <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="about" class="col-sm-3 control-label">Nội Dung Sản Phẩm</label>
        <div class="col-sm-9">
          <textarea class="form-control" rows="5" name="product_content" >{{$data->product_content}}</textarea>
        @error('product_content')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
    </div> <!-- form-group // -->
    <div class="form-group">
      <label for="tech" class="col-sm-3 control-label">Danh Mục</label>
      <div class="col-sm-3">
     <select class="form-control" name="product_category">
      <option value=""></option>
      @foreach ($categoty as $item)
      <option value="{{$item->category_id}}" {{$item->category_id==$data->category_id?'selected="selected"':''}}>{{$item->category_name}}</option>
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
     <select class="form-control" name="product_brand">
      <option value=""></option>
      @foreach ($brand as $item)
      <option value="{{$item->brand_id}} " {{$item->brand_id==$data->brand_id?'selected="selected"':''}}>{{$item->brand_name}}</option>
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
     <select class="form-control" name="product_status">
      <option value=""></option>
      <option value="1"{{$data->product_status==1 ? 'selected="selected"' : ''}} >Ẩn</option>
      <option value="2"{{$data->product_status==2 ? 'selected="selected"' : ''}}>Hiện</option>
     </select>
     @error('product_status')
     <div class="text-danger">{{ $message }}</div>
     @enderror
      </div>
    </div> <!-- form-group // -->
    <hr>
    <div class="form-group">
      <div class="col-sm-offset-3 col-sm-9">
        <button type="submit" class="btn btn-primary">Cập Nhật  Sản Phẩm</button>
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
  
    
  </div> <!-- container// -->
@endsection

@push('script')
       <!-- Custom script for this template-->
@endpush