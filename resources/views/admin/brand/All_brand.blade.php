@extends('admin.include_admin.Master_admin')
@section('content_admin')
@push('style')
@endpush

                <!-- Begin Page Content -->
                <div class="container-fluid">
                  
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>

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
                                            <th>Name</th>
                                            <th>Mô tả</th>
                                            <th>Trạng Thái</th>
                                            <th>Ngày Tạo</th>
                                            <th>Lần Sữa Cuối Cùng</th>
                                            <th>Người Tạo</th>
                                            <th>Hiệu Chỉnh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $value )
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$value->brand_name}}</td>
                                            <td>{{$value->brand_name}}</td>
                                            <td class="d-flex justify-content-center">
                                              
                                                @if($value->brand_status==1)
                                                <a href="{{ route('admin.costome.brand', ['id' => $value->brand_id, 'custome' => 1]) }}"   class="btn btn-warning btn-circle btn-sm">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                </a>
                                                @else
                                                <a href="{{ route('admin.costome.brand', ['id' => $value->brand_id, 'custome' => 2]) }}"  class="btn btn-success btn-circle btn-sm">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                                @endif
                                            </td>
                                            <td>{{$value->created_at}}</td>
                                            <td>{{$value->updated_at??''}}</td>
                                            <td>  
                                                @foreach($value->users as $items)
                                                    {{$items->name}}
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.costome.brand', ['id' => $value->brand_id, 'custome' => 'sua']) }}" class="btn btn-info btn-circle btn-sm">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
                                                <!-- Button trigger modal -->
                                                <a  href="{{ route('admin.costome.brand', ['id' => $value->brand_id, 'custome' => 'xoa']) }}" id="delete_brand" onclick="return confirm('are you sure?')" class="btn btn-danger btn-circle btn-sm">  <i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
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

