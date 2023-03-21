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
                     
                        
                        @if (\Session::has('msg'))
                        <div class="col-sm-offset-3 col-sm-9">
                        <span  class=" alert alert-success text-center">{!! \Session::get('msg') !!}</span>
                        </div>
                        @endif
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr> 
                                            <th>Stt</th>
                                            <th>Tên Khách Hàng</th>
                                            <th>Email</th>
                                            <th>Ngày Tạo</th>
                                            <th>Số Đơn Hàng Đã Mua</th>
                                            <th>Số đơn hàng chưa sử lý</th>
                                            <th>Hiệu Chỉnh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($data as $key => $value )
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$value->name}}</td>
                                            <td>
                                               {{$value->email}}
                                            </td>
                                            <td> 
                                                @foreach($value->users as $items)
                                                    {{$items->name}}
                                                @endforeach/td>
                                            <td>{{$value->updated_at??''}}</td>
                                            <td>  
                                               
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.costome.brand', ['id' => $value->brand_id, 'custome' => 'sua']) }}" class="btn btn-info btn-circle btn-sm">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                                <!-- Button trigger modal -->
                                                <a  href="{{ route('admin.costome.brand', ['id' => $value->brand_id, 'custome' => 'xoa']) }}" id="delete_brand" onclick="return confirm('are you sure?')" class="btn btn-danger btn-circle btn-sm">  <i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                   
                    </div>
                </div>
@push('script')
       <!-- Custom script for this template-->
    <script>
      
    </script>
@endpush
                <!-- /.container-fluid -->
@endsection

