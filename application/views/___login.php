<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Linda Chung</title>

        <!-- Bootstrap -->
        <link href="<?php echo base_url();?>assets/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo base_url();?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet">
    </head>

    <body style="background:#fff;">
        <div class="">
            <a class="hiddenanchor" id="tologin"></a>

            <div id="wrapper">
                <div id="login" class=" form">
                    <section class="login_content">
                        <form>
                            <div class="">
                                <img src="assets/images/linda_logo.jpg">
                            </div>
                            <h1>CMS Portal</h1>
                            <div>
                                <input type="text" class="form-control" placeholder="Username" required="" id="inp_username" />
                            </div>
                            <div>
                                <input type="password" class="form-control" placeholder="Password" required="" id="inp_password" />
                            </div>
                            <div>
                                <button type="button" class="btn btn-default submit" id="btn_login">Log in</button>
                                <a class="reset_pass" id="btn_reset" href="javascript:void(0);" style="display:none;">Lost your password?</a>
                            </div>
                            <div class="clearfix"></div>
                            <div class="separator" style="display:none;">
                                <div class="clearfix"></div>
                                <br />
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </body>

    <script src="<?php echo base_url()?>assets/vendor/jquery/dist/jquery.js"></script>
    <script src="<?php echo base_url()?>assets/js/function.js"></script>
    <script src="<?php echo base_url()?>assets/js/app/login.js"></script>
</html>