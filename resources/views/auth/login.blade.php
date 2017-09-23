@extends('layouts.base')

@section('footer')
<script type="text/javascript">
    $('body').addClass('be-splash-screen');
    if($('.alert').length > 0)
    {
        $('.splash-container').addClass('has-alert');
    }
</script>
@endsection

@section('body')
    <div class="be-wrapper be-login">
      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="splash-container">
            <div class="panel panel-default panel-border-color panel-border-color-primary">
              <div class="panel-heading"><img src="assets/img/logo.jpg" alt="logo" width="125" height="125" class="logo-img"><span class="splash-description">Please enter your user information.</span></div>
              <div class="panel-body">
                 @include('layouts.partials._alerts')
                {!! Form::open(['url' => 'login', 'method' => 'POST']) !!}
                  <div class="form-group">
                      {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                  </div>
                  <div class="form-group">
                      {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
                  </div>
                  <div class="form-group row login-tools">
                    <div class="col-xs-6 login-remember">
                      <div class="be-checkbox">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember Me</label>
                      </div>
                    </div>
                    <div class="col-xs-6 login-forgot-password"><a href="#">Forgot Password?</a></div>
                  </div>
                  <div class="form-group login-submit">
                    <button data-dismiss="modal" type="submit" class="btn btn-primary btn-xl">Sign me in</button>
                  </div>
                {!! Form::close() !!}
              </div>
            </div>
            <div class="splash-footer"><span>Don't have an account? {!! Html::link('register', 'Sign Up') !!}</span></div>
          </div>
        </div>
      </div>
    </div>
@endsection
