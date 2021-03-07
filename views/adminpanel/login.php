
<div class="main" style="padding-top:20px;">
    <img src="/views/adminpanel/css/back.jpg" id="img-log" style="position: absolute;left:0px;width: 100%">
       <div class="right"> 
       <div class="box" style="position: absolute;text-align:left;margin-bottom: 20px;width:350px;align-content: center;min-height: 400px;border-radius: 10px;">
        <span id="login-1" >
       <form method="POST" action="" onSubmit="return action_login(this)">
            <div class="bd" style="padding: 20px;">
                <span id="log-result"></span>
                <div class="title" style="border: transparent;padding: 0px">Username</div>
               <input type="text" name="username" style="padding: 10px;border:1px #ccc solid;width: 93%" placeholder="Username">
               <div class="title" style="border: transparent;padding: 0px;margin-top: 10px;">Password</div>
               <input type="password" name="password" style="padding: 10px;border:1px #ccc solid;width: 93%;" placeholder="Password">
            <br><br>
            <br><br>
            <button type="submit" name="login" style="cursor: pointer;padding: 10px;background: #24cd77;border: 1px #24cd77 solid;color:#fff;width: 100%;text-align: center;">Login</button>
            <br><br>
            <a style="text-decoration: none" href="/">Back To Homepage</a>
            <a style="text-decoration: none;float: right;" href="javascript:void(0)" onClick="forgot_pass()">Forgot Password</a>
            </div>
        </form>
    </span>
    <span id="login-2" style="display: none;">
        <form method="POST" action="" onSubmit="return action_recover(this)">
            <div class="bd" style="padding: 20px;">
                <span id="log-result-2"></span>
                <div class="title" style="border: transparent;padding: 0px;margin-top: 10px;">New Password</div>
               <input type="password" name="rec_pass1" style="padding: 10px;border:1px #ccc solid;width: 93%;" placeholder="New Password ...">
               <div class="title" style="border: transparent;padding: 0px;margin-top: 10px;">Repeat New Password</div>
               <input type="password" name="rec_pass2" style="padding: 10px;border:1px #ccc solid;width: 93%;" placeholder="Repeat New Password ...">
                <div class="title" style="border: transparent;padding: 0px">email</div>
               <input type="username" name="rec_email" style="padding: 10px;border:1px #ccc solid;width: 93%" placeholder="Email ...">
               <div class="title" style="border: transparent;padding: 0px;margin-top: 10px;">Pin</div>
               <input type="password" name="rec_pin" style="padding: 10px;border:1px #ccc solid;width: 93%;" placeholder="Pin ...">
            <br><br>
            <br><br>
            <input type="text"  name="rec" style="display: none">
            <button type="submit" style="cursor: pointer;padding: 10px;background: #24cd77;border: 1px #24cd77 solid;color:#fff;width: 100%;text-align: center;">Reset Password</button>
            <br><br>
            <a style="text-decoration: none" href="/">Back To Homepage</a>
            <a style="text-decoration: none;float: right;" href="javascript:void(0)" onClick="back_log()">Back To Login</a>
            </div>
        </form>
    </span>
       </div>
   </div>
</div>

