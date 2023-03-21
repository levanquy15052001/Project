@extends('admin.include_admin.Master_admin')
@push('style')
@endpush
@section('content_admin')

                <!-- Begin Page Content -->
                <div class="container-fluid">
            <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Thông Tin Đơn Hàng Đã Xác Nhận</h6>
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
                                                                              
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                Người nhận:
                                                   
                                                SDT:
                                                </td>
                                            <td><a href=""><img src="{{asset('Eshopper/images/product-details/')}}" height="200" alt=""></a></td>
                                            <td>   
                                                VND                               
                                            </td>
                                            <td></td>
                                            <td>
                                               
                                                <a href="" class="btn btn-info btn-circle btn-sm">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                                <a  href="" onclick="return confirm('are you sure?')"  class="btn btn-danger btn-circle btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <a href="{{route('management.pdf')}}"><img src="{{asset('Eshopper/images/icon/printer.png')}}" alt="" width="30"></a>
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