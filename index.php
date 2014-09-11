<style>

    .modal_loading {
        display:    none;
        position:   fixed;
        top:        0;
        left:       0;
        height:     100%;
        width:      100%;
        background: url("img/ajax-loader1.gif") no-repeat scroll 50% 50% transparent;
        z-index: 1020;

    }



    body.loading {
        overflow: hidden;
    }


    body.loading .modal_loading {
        display: block;
    }

</style>

<?php
setcookie("session", "", time()-3600);
if(isset($_COOKIE["session"]))
{
    echo "<script>window.location='index2.php'</script>";
}
 //   setcookie('session', "hola", time() + 1*24*60*60);

?>

<style>
    .bg-black
    {
        background-image: url('img/developer/dlbbackground.jpeg');
        background-position: center;
        background-repeat: no-repeat;
        background-size: 100% auto;
    }
</style>
<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>DLBGROUP WORLDWIDE</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Sign In</div>
            <form name="login" id="login" action="#" method="POST" enctype="multipart/form-data">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="email" id="email" class="form-control" placeholder="User"  autofocus required/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required/>
                    </div>          
                    <div class="form-group">
                        <input type="checkbox" name="remember_me"/> Remember me
                    </div>
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-black btn-block">Sign me in</button>
                    
                    <p><a href="#">I forgot my password</a></p>
                    
                    <a href="register.html" class="text-center">Register a new membership</a>
                </div>
            </form>

            <!--div class="margin text-center">
                <span>Sign in using social networks</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

            </div-->
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.2.0.2.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>

<script type="application/javascript">
    function getDoc(frame) {
        var doc = null;

        // IE8 cascading access check
        try {
            if (frame.contentWindow) {
                doc = frame.contentWindow.document;
            }
        } catch(err) {
        }

        if (doc) { // successful getting content
            return doc;
        }

        try { // simply checking may throw in ie8 under ssl or mismatched protocol
            doc = frame.contentDocument ? frame.contentDocument : frame.document;
        } catch(err) {
            // last attempt
            doc = frame.document;
        }
        return doc;
    }

    $("#login").submit(function(e)
    {
        var formObj = $(this);
        var formURL = "funciones_ajax.php?func=1";
     //   var formURL = formObj.attr("action");

        if(window.FormData !== undefined)  // for HTML5 browsers
        {

            var formData = new FormData(this);
            $.ajax({
                url: formURL,
                type: "POST",
                data:  formData,
                mimeType:"multipart/form-data",
                contentType: false,
                cache: false,
                processData:false,
                success: function(data, textStatus, jqXHR)
                {
                    if(data==0) alert('Usuario / Contrasena Invalido');
                    if(data==1) window.location = 'index2.php';
                },
                error: function(jqXHR, textStatus, errorThrown)
                {
                }
            });
            e.preventDefault();
        }
        else  //for olden browsers
        {
            //generate a random id
            var  iframeId = "unique" + (new Date().getTime());

            //create an empty iframe
            var iframe = $('<iframe src="javascript:false;" name="'+iframeId+'" />');

            //hide it
            iframe.hide();

            //set form target to iframe
            formObj.attr("target",iframeId);

            //Add iframe to body
            iframe.appendTo("body");
            iframe.load(function(e)
            {
                var doc = getDoc(iframe[0]);
                var docRoot = doc.body ? doc.body : doc.documentElement;
                var data = docRoot.innerHTML;
                //data return from server.

            });

        }

    });


    $body = $("body");

    $(document).on({
        ajaxStart: function() { $body.addClass("loading");    },
        ajaxStop: function() { $body.removeClass("loading"); }
    });


</script>
<div class="modal_loading"><!-- Place at bottom of page --></div>
