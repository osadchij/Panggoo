function pg_signup(flag) {
    var e=window.event.srcElement;
    var foliate_signup=document.getElementById('foliate_signup');
    var signup_log=document.getElementById('signup_log');
    if (!flag) {
        pg_foliate(0);
        pg_foliate(1);
        foliate_signup.classList.remove('display-none');
        window.history.pushState(null, null, '/registration');
    } else {
        if (e.getAttribute('data-id')=='foliate_button') {
            pg_btnload(1, e);
            signup_log.classList.add('display-none');
        }
        var xhr=get_xhr();
        var data=new FormData();
        for (var i=0; i<foliate_signup.getElementsByTagName('input').length; i++) {
            data.append(foliate_signup.getElementsByTagName('input')[i].name, foliate_signup.getElementsByTagName('input')[i].value);
        }
        xhr.open('post', '/php/signup.php', true);
        xhr.onreadystatechange=function () {
            if (xhr.status==200 && xhr.readyState==4) {
                try {
                    var response=JSON.parse(xhr.responseText);
                    if (response[0]) {
                        window.location.href='/';
                    } else {
                        signup_log.classList.remove('display-none');
                        signup_log.innerHTML=response[1];
                    }
                    pg_btnload(0, e);
                } catch (err) {
                    console.log(xhr.responseText);
                }
            }
        };
        xhr.send(data);
    }
}
function pg_signin(flag) {
    var e=window.event.srcElement;
    var foliate_signin=document.getElementById('foliate_signin');
    var signin_log=document.getElementById('signin_log');
    if (!flag) {
        pg_foliate(0);
        pg_foliate(1);
        foliate_signin.classList.remove('display-none');
        window.history.pushState(null, null, '/login');
    } else {
        if (e.getAttribute('data-id')=='foliate_button') {
            pg_btnload(1, e);
            signin_log.classList.add('display-none');
        }
        var xhr=get_xhr();
        var data=new FormData();
        for (var i=0; i<foliate_signin.getElementsByTagName('input').length; i++) {
            data.append(foliate_signin.getElementsByTagName('input')[i].name, foliate_signin.getElementsByTagName('input')[i].value);
        }
        xhr.open('post', '/php/signin.php', true);
        xhr.onreadystatechange=function () {
            if (xhr.status==200 && xhr.readyState==4) {
                try {
                    var response=JSON.parse(xhr.responseText);
                    if (response[0]) {
                        window.location.href='/';
                    } else {
                        signin_log.classList.remove('display-none');
                        signin_log.innerHTML=response[1];
                    }
                } catch (err) {
                    console.log(xhr.responseText);
                }
                pg_btnload(0, e);
            }
        };
        xhr.send(data);
    }
}
function pg_resign(flag) {
    var e=window.event.srcElement;
    var foliate_resign=document.getElementById('foliate_resign');
    var resign_log=document.getElementById('resign_log');
    if (!flag) {
        pg_foliate(0);
        pg_foliate(1);
        foliate_resign.classList.remove('display-none');
        if (pg_path()[0]=='recovery' && Object.keys(pg_get()).length && pg_get()[0][0]=='token') {
            pg_resign(1);
        } else {
            window.history.pushState(null, null, '/recovery');
        }
    } else {
        var xhr=get_xhr();
        var data=new FormData();
        var is_recovery=pg_path()[0]=='recovery' && Object.keys(pg_get()).length && pg_get()[0][0]=='token';
        if (is_recovery) {
            e=foliate_resign.getElementsByTagName('button')[0];
            data.append('token', pg_get()[0][1]);
            window.history.pushState(null, null, '/recovery');
        } else {
            for (var i=0; i<foliate_resign.getElementsByTagName('input').length; i++) {
                data.append(foliate_resign.getElementsByTagName('input')[i].name, foliate_resign.getElementsByTagName('input')[i].value);
            }
        }
        if (e.getAttribute('data-id')=='foliate_button') {
            pg_btnload(1, e);
            resign_log.classList.add('display-none');
        }
        xhr.open('post', '/php/resign.php', true);
        xhr.onreadystatechange=function () {
            if (xhr.status==200 && xhr.readyState==4) {
                try {
                    var response=JSON.parse(xhr.responseText);
                    if (response[0]) {
                        resign_log.classList.add('display-none');
                    } else {
                        resign_log.classList.remove('display-none');
                        resign_log.innerHTML=response[1];
                    }
                } catch (err) {
                    console.log(xhr.responseText);
                }
                pg_btnload(0, e);
            }
        };
        xhr.send(data);
    }
}