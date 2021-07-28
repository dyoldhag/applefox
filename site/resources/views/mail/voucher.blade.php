<!DOCTYPE html>
<html>

<head>
    <title>Claim your free fox and celebrate Apple Day with us!</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
 
    <style type="text/css"> 
        body {
            margin: auto;
            padding: 0;
            width: 800px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 1rem;
            font-weight: 400;
            max-width: 100%;
            color: #000000;
        }
        div {
            box-sizing: border-box;

             display: block;

        }
        @media (max-width: 576px) { 
            html {
                font-size: 10px;
            }
        }
        .header { 
            border-bottom: 1px solid #323232;
             font-family: Arial, Helvetica, sans-serif;
             font-weight: 700;
            font-size: 1.5rem;
            padding: 20px 48px;
            color: #000000;
        }

        .content {
            background-color: #fffad5;
        }

        .cover img {
            width: 100%;
        }

        .main {
            padding: 32px 64px;
        }

        .container {
            padding: 0 100px;
        }

        .description {
            font-family: Arial, Helvetica, sans-serif;font-weight: 400;
            font-size: 2rem;
            text-align: center;
            line-height: 2.5rem;
            color: #000000;
        }

        .title {
            font-family: Arial, Helvetica, sans-serif;font-weight: 400;
            margin: auto;
            margin-top: 32px;
            font-size: 2rem;
            text-align: center;
            line-height: 2.5rem;
            color: #000000;
        }

        .voucher {
            margin: auto;
            text-align: center;
            margin-top: 4rem;
        }
        .container-flex {
            display: flex;
        }
        .voucher .code {
            width: 400px;
            max-width: 100%;
             font-family: Arial, Helvetica, sans-serif;font-weight: 700;
            margin: auto;
            padding: 8px 32px;
            border: 5px solid #000;
            text-align: center;
            font-size: 5rem;
            color: #007b00;
        }

        .redemption {
            margin: auto;
            margin-top: 32px;
            text-align: center;
            margin-top: 4rem;
        }

        .redemption .box {
            position: relative; 
             font-family: Arial, Helvetica, sans-serif;font-weight: 700;
            margin: auto;
            padding: 8px 16px;
            border: 5px solid #000;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .redemption .box p {
            width: 100%;
            margin: 0;
            font-size: 2.8rem;
            color: #000000;
        }

        .footer {
            margin-top: 60px;
            text-align: center;
        }

        .footer .btn-black {
             font-family: Arial, Helvetica, sans-serif;font-weight: 700;
            background-color: #000;
            color: #fffad5;
            font-size: 3rem;
            width: 100%;
            padding: 24px;
            text-transform: uppercase;
            margin-top: 16px;

             text-decoration: none;

        }

        .info {
            font-family: Arial, Helvetica, sans-serif;font-weight: 400;
            margin-top: 48px;
            font-size: 13px;
            text-align: center;
            line-height: 1rem;
            color: #000000;
        }
        @media (max-width: 576px) { 
            .main {
                padding: 32px 32px;
            }
            .container {
                padding: 0 0;
            }
        }
    </style>
</head>

<body width="800" style="margin: 0 auto; width: 800px ; max-width: 100%;background: #fffad5;">
    <div class="header">
        PSST, YOUR APPLE FOX VOUCHER IS READY!
    </div>
    <div class="content">
        <div class="cover">
            <img src="https://applefox.bjdev.net/images/REDEMPTION-EMAIL.png">
        </div>
        <div class="main">
            <div class="description">
                2020 is a bummer. But, FOX IT!<br>
                With a little curiosity and a thirst for fun, you can
                switch the vibe around. On this Apple Day,
                we’re giving the amazing red fruit some big love.<br>
                Join us, claim your free Apple Fox Cider and
                raise a toast to the amazing apple!
            </div>
            <div class="voucher">
                <p class="title">VOUCHER CODE</p>
                <div class="code">
                {{ $data['voucher'] }}
                </div>
            </div>
            <div class="redemption">
                <p class="title">REDEMPTION OUTLET AND DATE</p>
                <div class="container">
                    <div class="box">
                        <p> {{ $data['outlet'] }}</p>
                    </div>
                    <div class="box" style="margin-top: 24px;">
                        <p>{{ $data['date'] }} 2020</p>
                    </div>
                </div>
            </div>
            <div class="footer">
                <p class="title">When at the outlet, contact an outlet staff
                    to claim your free Apple Fox Cider! </p>
                <div class="container-flex"> 
                    <a href="https://applefox.com/redeem" class="btn-black">
                        redeem now
                    </a>
                </div>
            </div>
            <p class="info">Limited to 1 (One) Apple Fox Cider per person per day. For non-Muslims aged 21
                and above only. Terms and conditions apply. While stocks last.</p>

        </div>

    </div>

</body>

</html>