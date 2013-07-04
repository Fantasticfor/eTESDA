     <div id="signinModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel"> Sign in to e-TESDA Learn </h3>
            </div>
            <div class="modal-body">
                
                    <form >
                        <h5 class="gray">Please Log in</h5>
                        
                        <input type="text"  placeholder="Email address"><br>
                        <input type="password"  placeholder="Password">
                        <label class="checkbox">
                            <input type="checkbox" value="remember-me"> Remember me
                            <a class="btn btn-link" style="font-size:8pt; margin-bottom:2px "> forget your Password?</a>
                        </label>
                         
                        <a class="btn btn-primary" href="{{ url:site }}users/login">Sign in</a>
                       
                       
                    </form>
               
            </div>

        </div>