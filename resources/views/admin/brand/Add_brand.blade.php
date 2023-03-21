@extends('admin.include_admin.Master_admin')
@section('content_admin')
@push('style')
@endpush
<div class="container">
    <section class="panel panel-default">
  <div class="panel-heading"> 
  <h3 class="panel-title">Thêm Thương Hiệu Sản Phẩm</h3> 
  </div> 
  <div class="panel-body">
  <form action="{{route('add_brand')}}" method="POST" class="form-horizontal" role="form">
     <div class="form-group">
      <label for="name" class="col-sm-3 control-label">Tên Thương Hiệu</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="brand_name" id="categoty_name">
      </div>
    <div class="form-group">
      <label for="about" class="col-sm-3 control-label">Mô Tả</label>
      <div class="col-sm-9">
        <textarea class="form-control" rows="5" name="brand_desc"></textarea>
      </div>
    </div> <!-- form-group // -->
    <div class="form-group">
      <label for="tech" class="col-sm-3 control-label">Ẩn / Hiên</label>
      <div class="col-sm-3">
     <select class="form-control" name="brand_status">
      <option value="1">Ẩn</option>
      <option value="2">Hiện</option>
     </select>
      </div>
    </div> <!-- form-group // -->
    <hr>
    <div class="form-group">
      <div class="col-sm-offset-3 col-sm-9">
        <button type="submit" class="btn btn-primary">Thêm Thương Hiệu</button>
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