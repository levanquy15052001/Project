@extends('admin.include_admin.Master_admin')
@push('style')
@endpush
@section('content_admin')

                <!-- Begin Page Content -->
                <div class="container-fluid">
            <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Thông Tin Đơn Hàng Hôm Nay</h6>
                        </div>
                        <div class="card-header py-3">
                        <form action="" method="GET">
                            <div class="container">
                                <div class="row">
                                  <div class="col">
                                    <select class="form-select form-control" name="brand_srearch">
                                        <option value=""></option>
                                       
                                    </select>
                                  </div>
                                  <div class="col">
                                    <select class="form-select form-control" name="category_srearch">
                                        <option value=""></option>
                                      </select>
                                  </div>
                                  <div class="col">
                                    <button type="submit" class="btn btn-primary" ><i class="fas fa-search fa-sm"></i></button>
                                  </div>
                                </div>
                              </div>
                         </form>
                        </div>                      
                        <div class="card-body"> 
        
                            <div>Tìm Thấy :
                                {{count($data)}}
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr> 
                                            <th>Stt</th>
                                            <th>Khách hàng</th>
                                            <th>Thông tin nhận hàng</th>
                                            <th>Sản phẩm</th>  
                                            <th>Giá</th>
                                            <th>Ngày Tạo</th>
                                            <th>Trạng Thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key =>  $value)                                            
                                        <tr>
                                            <td>{{$key +1}}</td>
                                            <td>{{$value->shoping_has_customer->name}}</td>
                                            <td>
                                                Người nhận:
                                                    {{$value->shoping_has_information->name}} {{$value->shoping_has_information->address}}
                                                SDT: {{$value->shoping_has_information->phone}}
                                                </td>
                                            <td><a href=""><img src="{{asset('Eshopper/images/product-details/'.$value->shoping_has_product->product_img)}}" height="200" alt=""></a></td>
                                            <td>   
                                                {{number_format($value->shoping_has_product->product_price)}} VND                               
                                            </td>
                                            <td>{{$value->created_at}}</td>
                                            <td>
                                                @if($value->status == 1)
                                                    <a href="{{route('management.order',['id' => $value->id])}}" class="btn btn-primary" style="
                                                    margin-bottom: 10px;"> Xác nhận</a>                                                    
                                                @else
                                                        Đã xác nhận
                                                @endif
                                                <a href="" class="btn btn-info btn-circle btn-sm">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                                <a  href="" onclick="return confirm('are you sure?')"  class="btn btn-danger btn-circle btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                               
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                             
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