@extends('admin.Auth.inludeAuth.masterAuth')
@section('content_auth')
@push('style')
@endpush

    <main>
        <div class="row">
            <div class="colm-logo">
                {{-- <img src="https://static.xx.fbcdn.net/rsrc.php/y8/r/dF5SId3UHWd.svg" alt="Logo"> --}}
                <h2>Coder helps you connect and share with the people in your life.</h2>
            </div>
            <div class="colm-form">
              <form action="{{route('admin.check_login')}}" method="POST">
                @csrf
                <div class="form-container">
                    <input type="text" placeholder="Email address or phone number" name="email">
                    <input type="password" placeholder="Password"  name="password">
                    <button type="submit" class="btn-login">Login</button>

                    @if($errors->any())
                    <h4 class="red">{{$errors->first()}}</h4>
                    @endif
                  </form>
                    <a href="{{route('user.Register')}}" class="btn-new">Create new Account</a>
                    <a href="{{ url('/auth/redirect/facebook') }}" class="btn-login">Facebook</a>
                </div>
                <p><a href="#"><b>Create a Page</b></a> for a celebrity, brand or business.</p>
               
            </div>
        </div>
    </main>

  @endsection

@push('script')
  
       <!-- Custom script for this template-->
       {{-- <script src="https://www.google.com/recaptcha/enterprise.js?render=6Le7_EwlAAAAAFfzY7TMKbRz_b66_tvtPrtxOBsF"></script>
       <script src="{{asset('js/jqueryajax.min.js')}}"></script>
       <script type="text/javascript">
         var input = document.getElementById('reload');
              input.onclick = function(){
                  $.ajax({
                      type: 'GET',
                      url: '{{route("reload_captcha")}}',
                      success: function (data) {
                        console.log('ok')
                          $(".captcha span").html(data.captcha);
                      }
                  }); 
              };
      
        </script> --}}
@endpush