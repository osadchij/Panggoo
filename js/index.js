function get_xhr() {
    var xhr;
    try {
        xhr = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xhr = false;
        }
    }
    if (!xhr && typeof XMLHttpRequest!=='undefined') {
        xhr = new XMLHttpRequest();
    }
    return xhr;
}
function on_resize() {
    var foliate=document.getElementById('foliate');
    if (!foliate.classList.contains('display-none')) {
        var wrapper=document.getElementById('wrapper');
        wrapper.style.width=foliate.clientWidth+'px';
    }
}
function on_load() {
    if (Object.keys(pg_get_sign()).length) {
        window.history.pushState(null, null, '/');
        pg_advertin();
        pg_advertprt();
    } else if (pg_path()[0]=='login') {
        pg_signin(0);
    } else if (pg_path()[0]=='registration') {
        pg_signup(0);
    } else if (pg_path()[0]=='recovery') {
        pg_resign(0);
    }
}
function pg_path() {
    var result=window.location.pathname.substring(1);
    result=decodeURI(result).split('/');
    return result;
}
function pg_get() {
    var result=window.location.search.substring(1);
    if (result.length) {
        result=decodeURI(result).split('&');
        for(var i=0; i<result.length; i++) {
            result[i]=result[i].split('=');
        }
    } else {
        result=0;
    }
    return result;
}
function pg_foliate(flag) {
    var foliate=document.getElementById('foliate');
    var wrapper=document.getElementById('wrapper');
    if (!flag) {
        foliate.classList.add('display-none');
        document.body.style.overflowY='auto';
        for (var i=0; i<foliate.children.length; i++) {
            if (foliate.children[i].getAttribute('data-id')=='foliate-item') {
                foliate.children[i].classList.add('display-none');
            }
        }
        if (!Object.keys(pg_get()).length) {
            window.history.pushState(null, null, '/');
        }
    } else {
        foliate.classList.remove('display-none');
        wrapper.style.width=foliate.clientWidth+'px';
        document.body.style.overflowY='hidden';
    }
}
function pg_get_sign() {
    var result;
    var xhr=get_xhr();
    var data=new FormData();
    data.append('get_sign', 1);
    xhr.open('post', '/php/signin.php', false);
    xhr.onreadystatechange=function () {
        if (xhr.status==200 && xhr.readyState==4) {
            try {
                result=JSON.parse(xhr.responseText);
            } catch (err) {
                result=0;
            }
        }
    };
    xhr.send(data);
    return result;
}
function pg_btnload(flag, e) {
    if (!flag) {
        e.removeAttribute('disabled');
    } else {
        e.setAttribute('disabled', '');
    }
}