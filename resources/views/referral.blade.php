<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>‌ثبت‌نام در بسپار</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style>
    body {
        background: #97ff76;
        direction: rtl;
    }
</style>
<body>
<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">

        <h3>سلام</h3>
        <br>
        <h1>دوست شما {{$refPerson}}
        </h1>

        <br>
        شما را دعوت کرده تا اولین کارواش خود را با ۸۰۰۰ تومان اعتبار مهمان بسپار باشید.
        قصد شستن ماشین خود را دارید، با اپلیکیشن بسپار به سادگی به مقصد خود می‌رسید با اولین کارواش خود را با بسپار امتحان
        کنید!
    </div>
    <br>
</div>
<div class="row">
    <br>
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <form action="/api/v1/custom/alive/preregister">
            <div class="form-group">
                <label for="phonenumber">تلفن همراه:</label>
                <input type="number" class="form-control" id="number">
            </div>
            <button type="submit" class="btn btn-default">دریافت بسپار و ۸۰۰۰ تومان اعتبار رایگان</button>
        </form>
    </div>
</div>
</body>
</html>