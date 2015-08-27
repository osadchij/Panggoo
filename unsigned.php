<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" />
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html" lang="en-US">
<head>
    <title>Panggoo - We help you to understand your audience</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="Оставляйте Ваши объявления о продаже/покупке/обмене игровыми ценностями и персонажами из различных ММОРПГ.">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="6scZAxCzKOxoEhaxf2UyNP6SnP_lmR9mLLrs6s_fb1g" />
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <link rel="stylesheet" type="text/css" href="/css/index.css">
    <script src="/js/index.js" type="text/javascript"></script>
    <script src="/js/unsigned.js" type="text/javascript"></script>
</head>
<body style="overflow-y: auto;" onload="on_load();" onresize="on_resize();">
<div class="foliate display-none" id="foliate">
    <div class="foliate-wrap" id="wrapper" onclick="pg_foliate(0);"></div>
    <div class="foliate-item display-none"data-id="foliate-item" id="foliate_signup">
        <form action="javascrip:;" class="foliate-item-box">
            <h3>Create an Account</h3>
            <div class="foliate-item-label">Username</div>
            <input class="foliate-item-input" name="username">
            <div class="foliate-item-desc">You'll use this to Sign In</div>

            <div class="foliate-item-label">Email Address</div>
            <input class="foliate-item-input" name="email" placeholder="example@example.com">
            <div class="foliate-item-desc">Optional, but it can ease process of recovery</div>

            <div class="foliate-item-label">Password</div>
            <input type="password" class="foliate-item-input" name="password">
            <div class="foliate-item-desc">Minimum length just 1 character, but be careful</div>

            <div class="foliate-item-label">Retype Password</div>
            <input type="password" class="foliate-item-input" name="repassword">
            <div class="foliate-item-desc">as the above</div>
            <button type="submit" class="foliate-item-button" data-id="foliate_button" onclick="pg_signup(1);">Create</button>
            <a href="javascript:;" onclick="pg_signin(0)">Sign In</a>
            <a href="javascript:;" onclick="pg_resign(0);">Forgot?</a>
            <div class="foliate-item-log display-none" id="signup_log"></div>
        </form>
    </div>
    <div class="foliate-item display-none"data-id="foliate-item" id="foliate_signin">
        <form action="javascrip:;" class="foliate-item-box">
            <h3>Sign In</h3>
            <div class="foliate-item-label">Username or email</div>
            <input class="foliate-item-input" name="username">
            <div class="foliate-item-desc">Type just like from Sign Up</div>

            <div class="foliate-item-label">Password</div>
            <input type="password" class="foliate-item-input" name="password">
            <div class="foliate-item-desc">Again, like Sign Up, please</div>

            <button type="submit" class="foliate-item-button" data-id="foliate_button" onclick="pg_signin(1);">Sign In</button>
            <a href="javascript:;" onclick="pg_resign(0);">Forgot?</a>
            <a href="javascript:;" onclick="pg_signup(0);">Create an Account</a>
            <div class="foliate-item-log display-none" id="signin_log"></div>
        </form>
    </div>
    <div class="foliate-item display-none" data-id="foliate-item" id="foliate_resign">
        <form action="javascript:;" class="foliate-item-box">
            <h3>Recovery of an Account</h3>
            <div class="foliate-item-label">Email Address</div>
            <input class="foliate-item-input" name="email" placeholder="example@example.com">
            <div class="foliate-item-desc">
                Remember - "Optional, but..."?!
                <br>
                If encounter any trouble - support@panggoo.com
            </div>

            <button type="submit" class="foliate-item-button" data-id="foliate_button" onclick="pg_resign(1);">Recover</button>
            <a href="javascript:;" onclick="pg_signin(0);">Sign In</a>
            <a href="javascript:;" onclick="pg_signup(0);">Create an Account</a>
            <div class="foliate-item-log display-none" id="resign_log"></div>
        </form>
    </div>
</div>
<div class="header shadow-underline">
    <div class="header-box">
        <div class="header-logo">
            <div class="header-logo-note">since 2015</div>
            <div class="header-logo-badge">+</div>
            <span>Panggoo</span>
        </div>
        <div class="header-path">
            <a href="javascript:;" onclick="pg_signin(0);">Sign In</a>
        </div>
    </div>
</div>
<div class="content">
    <div class="content-photo-chief">
        We help you to understand your audience
    </div>
</div>
</body>
</html>