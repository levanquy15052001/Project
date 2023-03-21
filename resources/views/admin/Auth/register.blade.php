@extends('admin.Auth.inludeAuth.masterAuth')
@section('content_auth')
@push('style')
@endpush

<main>
    <div class="row">
      <div class="colm-form">
            @if (\Session::has('done'))
            <div class="alert alert-success">
            
                    {!! \Session::get('done') !!}
             
            </div>
        @endif
        <form action="{{route('userCheck.Register')}}" method="POST">
          @csrf 
          <div class="form-container"><h1>Register User</h1>
              <input type="text" placeholder="Name" name="name" value="{{old('name')}}">
              @if($errors->has('name'))
                  <div class="text-danger" >{{ $errors->first('name') }}</div>
              @endif
              <input type="text" placeholder="Email " name="email" value="{{old('email')}}">
              @if($errors->has('email'))
                  <div class="text-danger">{{ $errors->first('email') }}</div>
              @endif
              <input type="text" placeholder="Phone " name="phone" value="{{old('phone')}}">
              @if($errors->has('phone'))
                  <div class="text-danger">{{ $errors->first('phone') }}</div>
              @endif
              <input type="password" placeholder="Password"  name="password">
              @if($errors->has('password'))
                  <div class="text-danger">{{ $errors->first('password') }}</div>
              @endif
              <input type="password" placeholder="ConfiPassword"  name="confipassword">
              @if($errors->has('confipassword'))
                  <div class="text-danger">{{ $errors->first('confipassword') }}</div>
              @endif
              <button type="submit" class="btn-login">Register</button>
              <a href="{{route('admin.login')}}" class="btn-new">Login</a>
          </div>
        </form>
      </div>
    </div>
</main>

  @endsection

@push('script')
       <!-- Custom script for this template-->
@endpush