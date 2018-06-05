<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
</head>
<body>
    <form id="loginForm">
    <!--<form id="loginForm" action="service.php" method="POST">-->
    <div>
        <span>Username:</span>
        <input id="inp_username" type="text" name="username" />
    </div>
    <div>
        <span>Password:</span>
        <input id="inp_password" type="password" name="password" />
    </div>
    <button type="submit">Submit</button>
    </form>
    <br/><span id="txt_result"></span>
    <script type="text/javascript" src="<?php echo base_url()?>assets/vendor/jquery/dist/jquery.js" ></script>
    <script type="text/javascript">
        $(function (){
            console.log("test");
            $('#loginForm').submit(function(event){
                event.preventDefault();
                var username = $('#inp_username').val();
                var password = $('#inp_password').val();

                $.post('<?php echo base_url()?>/welcome/service', {
                    'username' : username,
                    'password' : password
                }, function(_result) {
                    console.log(_result);
                    var message = _result.message;
                    console.log(message);
                    if (_result.status == 'success') {
                        window.top.location = "<?php echo base_url()?>/welcome/success"
                    }
                    else {
                        $('#txt_result').html(message);
                    }
                });
            });
        });
    </script>
</body>
</html>