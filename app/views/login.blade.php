@extends('layout')

@section('content')
 


 


{{ Form::open(array('url'=>'login', 'class'=>'form-signin')) }}
                <h1>Login</h1>

    <!-- check for login error flash var -->
    @if (Session::has('flash_error'))
        <div id="flash_error">{{ Session::get('flash_error') }}</div>
    @endif
                
                <div class="clearfix"> 
                    <label for="username">Email</label> 
                    <div class="input"> 
                        <input type="text" size="30" name="username" id="username" class="xlarge"> 
                    </div> 
                </div><!-- /clearfix -->
                
                <div class="clearfix"> 
                    <label for="password">Password</label> 
                    <div class="input"> 
                        <input type="password" size="30" name="password" id="password" class="xlarge"> 
                    </div> 
                </div><!-- /clearfix -->
	            
	            <div class="clearfix">
	                <div class="input">
				        <input type="checkbox" id="rememberme" name="rememberme">  Remember me
				    </div>
                </div><!-- /clearfix -->   

				<br><br>
				
                <div class="actions">
                    <input type="submit" value="Log In" class="btn large primary">
                    &nbsp; &nbsp; &nbsp;<br><br>
                    <a href="/account/reset" class="btn danger">Forgot password? Reset it here</a>
                </div>
{{ Form::close() }}