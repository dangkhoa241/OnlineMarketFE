<?php
session_start();
error_reporting(0);
include('includes/config.php');
// Code user Registration
if(isset($_POST['submit']))
{
    $name = $_POST['fullname'];
    $email = $_POST['emailid'];
    $password = $_POST['password'];
    $role = 'seller';
    $mobile_number = $_POST['contactno'];
    $address = $_POST['address'];



    $url = "http://localhost:9000/api/users";


    $myObj = new stdClass();
    $myObj->name = $name;
    $myObj->email = $email;
    $myObj->password = $password;
    $myObj->role = $role;
    $myObj->mobile_number = $mobile_number;
    $myObj->address = $address;

    $myJSON = json_encode($myObj);
    
    //url-ify the data for the POST

    echo "<script>console.log($myJSON);</script>";
    //open connection
    $ch = curl_init();
    
    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS, $myJSON);
    
    //So that curl_exec returns the contents of the cURL; rather than echoing it
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
    
    //execute post
    $result = curl_exec($ch);
    echo "<script>console.log($result);</script>";
    echo "<script>  if($result.code < 200 || $result.code >= 300)
                    alert($result.data.info);
                    else {console.log($result.data);
                        alert('Đăng ký tài khoản bán hàng thành công. Hãy đợi công ty xét duyệt tài khoản của bạn');
                         localStorage.setItem('token', $result.data.token);
                         window.location = 'http://localhost/OnlineMarket/shop';}
            </script>";



}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">

    <title>Online Market | Shop Register</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/green.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css">
    <!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
    <link href="assets/css/lightbox.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/rateit.css">
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

    <!-- Demo Purpose Only. Should be removed in production -->
    <link rel="stylesheet" href="assets/css/config.css">

    <link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
    <link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
    <link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
    <link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
    <link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
    <!-- Demo Purpose Only. Should be removed in production : END -->


    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- <script type="text/javascript">
    function valid() {
        if (document.register.password.value != document.register.confirmpassword.value) {
            alert("Password and Confirm Password Field do not match  !!");
            document.register.confirmpassword.focus();
            return false;
        }
        return true;
    }
    </script> -->
    <!-- <script>
    function userAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check_availability.php",
            data: 'email=' + $("#email").val(),
            type: "POST",
            success: function(data) {
                $("#user-availability-status1").html(data);
                $("#loaderIcon").hide();
            },
            error: function() {}
        });
    }
    </script> -->



</head>

<body class="cnt-home">



    <!-- ============================================== HEADER ============================================== -->
    <header class="header-style-1">

        <!-- ============================================== TOP MENU ============================================== -->
        <?php include('includes/top-header.php');?>
        <!-- ============================================== TOP MENU : END ============================================== -->
        <?php include('includes/main-header.php');?>
        <!-- ============================================== NAVBAR ============================================== -->
        <?php include('includes/menu-bar.php');?>
        <!-- ============================================== NAVBAR : END ============================================== -->

    </header>

    <!-- ============================================== HEADER : END ============================================== -->
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="home.html">Home</a></li>
                    <li class='active'>Shop Register</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content outer-top-bd">
        <div class="container">
            <div class="sign-in-page inner-bottom-sm">
                <div class="row">
                    <!-- create a new account -->
                    <div class="col-md-12 col-sm-12 create-new-account">
                        <h4 class="checkout-subtitle">Register as Shop</h4>
                        <p class="text title-tag-line">Đăng ký một tài khoản bán hàng riêng cho cửa hàng của bạn.</p>
                        <form class="register-form outer-top-xs" role="form" method="post" name="register"
                            onSubmit="return valid();">
                            <div class="form-group">
                                <label class="info-title" for="fullname">Full Name <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="fullname"
                                    name="fullname" required="required">
                            </div>


                            <div class="form-group">
                                <label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
                                <input type="email" class="form-control unicase-form-control text-input" id="email"
                                    onBlur="userAvailability()" name="emailid" required>
                                <span id="user-availability-status1" style="font-size:12px;"></span>
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="contactno">Contact No. <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="contactno"
                                    name="contactno" maxlength="10" required>
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="address">Address <span>*</span></label>
                                <input type="text" class="form-control unicase-form-control text-input" id="address"
                                    name="address" maxlength="100" required>
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="password">Password. <span>*</span></label>
                                <input type="password" class="form-control unicase-form-control text-input"
                                    id="password" name="password" required>
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="agreeterms">
                                    Khi xác nhận đăng ký là bạn đã đồng ý với các
                                    <a href="terms-of-service.php">điều khoản.<a>
                                </label>
                            </div>


                            <button type=" submit" name="submit" class="btn-upper btn btn-primary checkout-page-button"
                                id="submit">Đăng ký</button>
                        </form>

                    </div>
                    <!-- create a new account -->
                </div><!-- /.row -->
            </div>

        </div>
    </div>
    <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.11.1.min.js"></script>

    <script src="assets/js/bootstrap.min.js"></script>

    <script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>

    <script src="assets/js/echo.min.js"></script>
    <script src="assets/js/jquery.easing-1.3.min.js"></script>
    <script src="assets/js/bootstrap-slider.min.js"></script>
    <script src="assets/js/jquery.rateit.min.js"></script>
    <script type="text/javascript" src="assets/js/lightbox.min.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/scripts.js"></script>

    <!-- For demo purposes – can be removed on production -->

    <script src="switchstylesheet/switchstylesheet.js"></script>

    <script>
    $(document).ready(function() {
        $(".changecolor").switchstylesheet({
            seperator: "color"
        });
        $('.show-theme-options').click(function() {
            $(this).parent().toggleClass('open');
            return false;
        });
    });

    $(window).bind("load", function() {
        $('.show-theme-options').delay(2000).trigger('click');
    });
    </script>
    <!-- For demo purposes – can be removed on production : End -->



</body>

</html>

</html>