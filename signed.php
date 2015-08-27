<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" />
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html" lang="en-US">
<head>
    <title>Panggoo - Happy Work!</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="6scZAxCzKOxoEhaxf2UyNP6SnP_lmR9mLLrs6s_fb1g" />
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <link rel="stylesheet" type="text/css" href="/css/index.css">
    <link rel="stylesheet" type="text/css" href="/css/signed.css">
    <script src="/js/index.js" type="text/javascript"></script>
    <script src="/js/signed.js" type="text/javascript"></script>
</head>
<body style="overflow-y: auto;" onload="on_load();" onresize="on_resize();">
<div class="foliate display-none" id="foliate">
    <div class="foliate-wrap" id="wrapper" onclick="pg_foliate(0);"></div>
    <div class="foliate-item" id="foliate_advertup">
        <form action="javascript:;" class="foliate-item-box" id="foliate_advertup">
            <h3>Create an Advert</h3>
            <div class="foliate-item-label">Set a picture</div>
            <div class="foliate-item-input-picture" onclick="pg_advertup(1);" id="advertup_picboard">Click to upload a picture PNG, GIF or JPEG</div>
            <input type="file" accept="image/*" class="display-none" name="picture" onchange="pg_advertup(2);" id="advertup_picinput">
            <div class="foliate-item-desc">Picture catches the eye</div>
            <div class="foliate-item-label">Advert title</div>
            <input type="text" class="foliate-item-input" name="title" maxlength="35" id="advertup_ttlinput" onkeyup="pg_advertup(3);">
            <div class="foliate-item-desc" id="advertup_ttldesc">Title motivates to action</div>
            <div class="foliate-item-label">Address URL</div>
            <input type="text" class="foliate-item-input" placeholder="http://example.com/sector/page.html" name="url">
            <div class="foliate-item-desc">People will be here</div>
            <button type="submit" class="foliate-item-button" data-id="foliate_button" onclick="pg_advertup(4);">Create</button>
            <div class="foliate-item-desc">If you have a <strong>domain</strong> in the <strong>national language</strong>, type it's in ASCII coding, just like this <strong>http://xn--h1alffa9f.xn--p1ai/</strong></div>
            <div class="foliate-item-log display-none" id="advertup_log"></div>
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
            <a href="javascript:;">Profile</a>
            <a href="javascript:;" onclick="pg_prflswitch();">Switch</a>
            <a href="javascript:;" onclick="pg_signout(0);">Sign Out</a>
        </div>
    </div>
</div>
<div class="content">
    <div class="content-tip shadow-underline">
        <div class="content-tip-box">
            To switch between Webmaster and Advertiser click the Switch
        </div>
    </div>
<!--    <a href="javascript:;" onclick="pg_advertup(0);" >New advert</a>-->
    <div class="profile shadow-around">
        <div class="profile-ico">
        </div>
        <div class="profile-username">username</div>
        <div class="profile-stat-box shadow-underline">
            <div class="profile-stat-item">Balance: <strong>10$</strong></div>
            <div class="profile-stat-item">Common CTR: <strong>24%</strong></div>
            <div class="profile-stat-item">Common Traffic: <strong>954</strong></div>
            <div class="profile-stat-item">etc...</div>
            <div class="clear-both"></div>
        </div>
        <div class="profile-switch-box" id="prfl_wm">
            <!-- some form for webmasters start -->
            <div class="advert-printer-box">
                <div class="advert-printer-place shadow-underline" id="advertprt_box">
                    <div class="advert-printer-plus" onclick="pg_advertup(0);">+</div>
                    <a rel="nofollow" target="_blank" class="advert-printer-item display-none" id="advertprt_item">
                        <div class="advert-printer-item-picture" data-id="picture"></div>
                        <div class="advert-printer-item-title" data-id="title"></div>
                    </a>
                </div>
            </div>
            <div class="clear-both"></div>
            <!-- some form for webmasters end -->
            <div class="advert-code-box">
                <textarea class="advert-code-place shadow-around">


                    ...some code...



                </textarea>
            </div>
        </div>
        <div class="profile-switch-box display-none" id="prfl_ad">
            <div class="advert-box" id="advert_box">
                <div class="advert-item shadow-around display-none" id="advert_item">
                    <div class="advert-item-title" data-id="title"></div>
                    <div class="advert-item-picture" data-id="picture"></div>
                    <a class="advert-item-block">Block it!</a>
                    <div class="advert-item-stat-box">
                        <div class="advert-item-stat-attr">Balance today: <strong>28%</strong></div>
                        <div class="advert-item-stat-attr">CTR today: <strong>28%</strong></div>
                        <div class="advert-item-stat-attr">Traffic today: <strong>876</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>


















