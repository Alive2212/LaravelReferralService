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
                        قصد شستن ماشین خود را دارید، با اپلیکیشن بسپار به سادگی به مقصد خود می‌رسید با اولین کارواش خود
                        را با بسپار امتحان
                        کنید!
                    </p>
                    <form action="/api/v1/custom/alive/referral/preregister" method="POST" style="">
                        <script src='https://www.google.com/recaptcha/api.js'></script>
                        <div class="g-recaptcha" data-sitekey="6LfGl2wUAAAAADKX_VlI9uz7AeXMnjQRsM8lyj2T"></div>
                        <div class="form" style="margin-bottom: 10px;">
                            <input type="tel"
                                   placeholder="شماره موبایل خود را وارد کنید… (مانند ۰۹۱۲۱۲۳۴۵۶۷۹)"
                                   pattern="^09[0-9]{9}$" id="number"
                                   title="شماره موبایل خود را به صورت صحیح وارد کنید."
                                   name="phone_number">
                            <input type="hidden" value="{{$userId}}" name="user_id">
                            <input type="hidden" value="98" name="country_code">
                            <button name="send"><i class="mdi mdi-ml mdi-md mdi-briefcase-download"></i>دریافت بسپار و
                                ۸۰۰۰
                                تومان اعتبار رایگان
                            </button>
                        </div>
                    </form>
                    <br>
                    <div class="list">
                    <ul >

                            <li>پس از ثبت‌نام در بسپار، با همین شماره موبایل حساب کاربری خود را فعال کنید تا اعتبار ۸۰۰۰
                                تومان برای اولین سفارش شما شارژ شود.</li>
                            <li>شما تنها در صورتی که تا به‌حال در بسپار ثبت‌نام نکرده باشید، می‌توانید از این اعتبار ۸۰۰۰
                                تومانی استفاده کنید.</li>
                            <li>بسپار در حال حاضر در شهرهای تهران، کرج، اصفهان، شیراز، مشهد، قم، تبریز، اهواز، رشت، بابل،
                                قائم شهر، ساری، بندرعباس و قزوین فعال است.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
</body>
</html>