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
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}

<!-- Latest compiled JavaScript -->
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}


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
                        <script src='https://www.google.com/recaptcha/api.js'></script>
                        <div class="g-recaptcha" data-sitekey="6LfGl2wUAAAAADKX_VlI9uz7AeXMnjQRsM8lyj2T" required></div>
                        <div class="form" style="margin-bottom: 10px;">
                            <input type="tel"
                                   placeholder="شماره موبایل خود را وارد کنید… (مانند ۰۹۱۲۱۲۳۴۵۶۷۹)"
                                   pattern="^09[0-9]{9}$" id="number"
                                   title="شماره موبایل خود را به صورت صحیح وارد کنید."
                                   name="phone_number" required>
                            <input type="hidden" value="{{$userId}}" name="user_id">
                            <input type="hidden" value="{{$userNumber}}" name="user_number">
                            <input type="hidden" value="98" name="country_code">
                            <button name="send"><i class="mdi mdi-ml mdi-md mdi-briefcase-download"></i>دریافت بسپار و
                                ۸۰۰۰
                                تومان اعتبار رایگان
                            </button>
                        </div>
                    </form>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
</body>
</html>