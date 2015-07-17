{{ Form::open(array('url'=>'users/signin', 'class'=>'form-signin')) }}
	<h2 class="form-signin-heading">Please Login</h2>

	{{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address')) }}
	{{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}

	{{ Form::submit('Login', array('class'=>'btn btn-large btn-primary btn-block'))}}
{{ Form::close() }}

{{ Form::open(array('url'=>'users/signin', 'class'=>'form-signin')) }}
                
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