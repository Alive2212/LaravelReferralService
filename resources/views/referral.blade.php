<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0 user-scalable=no width=device-width">
    <title>‌ثبت‌نام در بسپار</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="../../../../../css/style.css">
{{--<link rel="stylesheet" href="../../../../../css/styles.css">--}}

<!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}

    <style>
        msg-error {
            color: #c65848;
        }
        .g-recaptcha.error {
            width: 19em;
        }
    </style>
</head>
<body>
<main class="referral">
    <div class="container">
        <div class="wrap-row" style=" margin: auto; justify-content: center; align-items: center; min-height:40vh; padding-top:20px;">
            <div class="col-flex ">
                <div class="ta-left">
                    <div class="bespar-logo">
                        <img src="https://besparapp.com/Content/img/logo3.png"
                             height="150px" width="150px"/>
                    </div>
                </div>
            </div>
            <div class="contain">
                <div class="col-flex col-7"
                     style=" margin: auto; justify-content: center; align-items: center; padding-top: 25px;">
                    <h5 class="little-title">سلام!</h5>
                    <h4 class="title">دوست شما {{$refPerson}}</h4>

                    <h6 class="subtitle">
                        شما را دعوت کرده تا اولین کارواش خود را با ۸۰۰۰ تومان اعتبار مهمان بسپار باشید.
                    </h6>
                    <p>
                        اپلیکیشن بسپار را نصب کنید ودر زمان و ماکن دلخواه خودرو خود را تمیز کنید
                    </p>
                    <form action="{{$config}}" method="POST" style="">
                        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                        <span class="msg-error error"></span>
                        <div class="g-recaptcha" id="recaptcha"  data-sitekey="6LfGl2wUAAAAADKX_VlI9uz7AeXMnjQRsM8lyj2T"></div>
                        <div class="form" style="margin-bottom: 10px;">
                            <input type="tel"
                                   placeholder="شماره موبایل خود را وارد کنید… (مانند ۰۹۱۲۱۲۳۴۵۶۷۹)"
                                   pattern="^09[0-9]{9}$" id="number"
                                   title="شماره موبایل خود را به صورت صحیح وارد کنید."
                                   name="phone_number" required>
                            <input type="hidden" value="{{$userId}}" name="user_id">
                            <input type="hidden" value="{{$userNumber}}" name="user_number">
                            <input type="hidden" value="98" name="country_code">
                            <button type="submit" id="btn-validate" name="send"><i class="mdi mdi-ml mdi-md mdi-briefcase-download"></i>دریافت بسپار و
                                ۸۰۰۰
                                تومان اعتبار رایگان
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
<script type="text/javascript">
    //    $( '#btn-validate' ).click(function(){
    //        var $captcha = $( '#recaptcha' ),
    //            response = grecaptcha.getResponse();
    //        if (response.length === 0) {
    //            $( '.msg-error').text( "reCAPTCHA is mandatory" );
    //            if( !$captcha.hasClass( "error" ) ){
    //                $captcha.addClass( "error" );
    //            }
    //        } else {
    //            $( '.msg-error' ).text('');
    //            $captcha.removeClass( "error" );
    //            alert( 'reCAPTCHA marked' );
    //        }
    //    })
    $('#btn-validate').click(function (event) {

        var $captcha = $( '#recaptcha' ),
            response = grecaptcha.getResponse();
        if (response.length === 0) {
            event.preventDefault();
            $( '.msg-error').text( "لطفا گزینه من ربات نیستم را فعال کنید" );
            if( !$captcha.hasClass( "error" ) ){
                $captcha.addClass( "error" );
            }
        } else {

        }

    })
</script>
</body>
</html>