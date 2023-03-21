@extends('admin.include_admin.Master_admin')
@section('content_admin')
@push('style')
@endpush
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                        </div>
                        <div class="card-header py-3">
                        <form action="{{route('admin.all_product')}}" method="GET">
                            <div class="container">
                                <div class="row">
                                  <div class="col">
                                    <select class="form-select form-control" name="brand_srearch">
                                        <option value=""></option>
                                        @foreach($brand as $items)
                                        <option value="{{$items->brand_id}}">{{$items->brand_name}}</option>
                                        @endforeach    
                                    </select>
                                  </div>
                                  <div class="col">
                                    <select class="form-select form-control" name="category_srearch">
                                        <option value=""></option>
                                        @foreach($categoty as $items)
                                            <option value="{{$items->category_id}}">{{$items->category_name}}</option>
                                        @endforeach    
                                      </select>
                                  </div>
                                  <div class="col">
                                    <button type="submit" class="btn btn-primary" ><i class="fas fa-search fa-sm"></i></button>
                                  </div>
                                </div>
                              </div>
                            {{-- @csrf --}}
                         </form>
                        </div>
               
                        @if (\Session::has('msg'))
                        <div class="col-sm-offset-3 col-sm-9">
                        <span  class=" alert alert-success text-center">{!! \Session::get('msg') !!}</span>
                        </div>
                        @endif
                      
                        <div class="card-body"> 
                            <div>
                                <a href="{{route('admin.add_product')}}" class="btn btn-primary"> Thêm sản phẩm mới</a>
                            </div>
                            <div>Tìm Thấy : {{count($data)}}</div>
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr> 
                                            <th>Stt</th>
                                            <th>Name</th>
                                            <th>Danh Mục</th>
                                            <th>Thương hiệu</th>
                                            {{-- <th>Mô Tả</th>
                                            <th>Nội Dung</th> --}}
                                            <th>Giá</th>  
                                            <td>Hình ảnh</td>
                                            <th>Trạng Thái</th>
                                            <th>Ngày Tạo</th>
                                            <th>Ngày Ngày sữa</th>
                                            <th>Hiệu Chỉnh</th>
                                        </tr>
                                    </thead>
                                    {{-- <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </tfoot> --}}
                                    <tbody>
                                        @foreach ($data as $key => $value )
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$value->product_name}}</td>
                                            <td>{{$value->category_name}}</td>
                                            <td>{{$value->brand_name}}</td>
                                            {{-- <td>{{$value->product_desc}}</td>
                                            <td>{{$value->product_content}}</td> --}}
                                            <td>{{number_format($value->product_price)}} VND</td>
                                            <td><img src="Eshopper\images\product-details\{{$value->product_img}}" height="200" alt=""></td>
                                            <td class="d-flex justify-content-center">
                                              
                                                @if($value->product_status==1)
                                                <a href="{{ route('admin.costome.product', ['id' => $value->product_id , 'custome' => 1]) }}"   class="btn btn-warning btn-circle btn-sm">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </a>
                                                @else
                                                <a href="{{ route('admin.costome.product', ['id' => $value->product_id , 'custome' => 2]) }}"  class="btn btn-success btn-circle btn-sm">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                                @endif
                                            </td>
                                            <td>{{$value->created_at}}</td>
                                            <td>{{$value->updated_at??''}}</td>
                                            <td>
                                                <a href="{{ route('admin.costome.product', ['id' => $value->product_id , 'custome' => 'sua']) }}" class="btn btn-info btn-circle btn-sm">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                                <a  href="{{ route('admin.costome.product', ['id' => $value->product_id, 'custome' => 'xoa']) }}" onclick="return confirm('are you sure?')"  class="btn btn-danger btn-circle btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <!-- /.container-fluid -->
    
@endsection

@push('script')
       <!-- Custom script for this template-->
@endpush