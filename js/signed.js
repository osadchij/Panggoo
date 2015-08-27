function pg_signout() {
    var xhr=get_xhr();
    var data=new FormData();
    data.append('signout', 1);
    xhr.open('post', '/php/signin.php', true);
    xhr.onreadystatechange=function () {
        if (xhr.status==200 && xhr.readyState==4) {
            if (parseInt(xhr.responseText)) {
                window.location.href='/';
            }
        }
    };
    xhr.send(data);
}
function pg_prflswitch() {
    var e=[document.getElementById('prfl_wm'), document.getElementById('prfl_ad')];
    for (var i=0; i<e.length; i++) {
        if (e[i].classList.contains('display-none')) {
            e[i].classList.remove('display-none');
        } else {
            e[i].classList.add('display-none');
        }
    }
}
function pg_advertup(flag) {
    var foliate_advertup=document.getElementById('foliate_advertup');
    var advertup_picinput=document.getElementById('advertup_picinput');
    var advertup_picboard=document.getElementById('advertup_picboard');
    if (!flag) {
        pg_foliate(0);
        pg_foliate(1);
    } else if (flag===1) {
        advertup_picinput.click();
    } else if (flag===2) {
        if (advertup_picinput.files.length) {
            var pic_reader=new FileReader();
            pic_reader.onload=function (e) {
                advertup_picboard.innerHTML='<img src="'+e.target.result+'">';
            };
            pic_reader.readAsDataURL(advertup_picinput.files[0]);
        } else {
            advertup_picboard.innerHTML='Click to upload a picture PNG, GIF or JPEG';
        }
    } else if (flag===3) {
        var advertup_ttldesc=document.getElementById('advertup_ttldesc');
        var advertup_ttlinput=document.getElementById('advertup_ttlinput');
        advertup_ttldesc.innerHTML='Characters remaining: '+(35-advertup_ttlinput.value.length);
    } else if (flag===4) {
        var advertup_log=document.getElementById('advertup_log');
        pg_btnload(1, foliate_advertup.getElementsByTagName('button')[0]);
        advertup_log.classList.add('display-none');
        var data=new FormData();
        for (var i=0; i<foliate_advertup.getElementsByTagName('input').length; i++) {
            if (foliate_advertup.getElementsByTagName('input')[i].type=='file') {
                data.append(foliate_advertup.getElementsByTagName('input')[i].name, foliate_advertup.getElementsByTagName('input')[i].files[0]);
            } else {
                data.append(foliate_advertup.getElementsByTagName('input')[i].name, foliate_advertup.getElementsByTagName('input')[i].value);
            }
        }
        var xhr=get_xhr();
        xhr.open('post', '/php/advertup.php', true);
        xhr.upload.onprogress=function (e) {
            if (advertup_log.classList.contains('display-none')) {
                advertup_log.classList.remove('display-none');
            }
            advertup_log.innerHTML='Loading '+(Math.ceil(e.loaded/e.total)*100)+'%, please wait';
        };
        xhr.onreadystatechange=function () {
            if (xhr.status==200 && xhr.readyState==4) {
                try {
                    var response=JSON.parse(xhr.responseText);
                    if (response[0]) {
                        advertup_log.classList.add('display-none');
                    } else {
                        advertup_log.classList.remove('display-none');
                        advertup_log.innerHTML=response[1];
                    }
                } catch (err) {
                    console.log(xhr.responseText);
                }
                pg_btnload(0, foliate_advertup.getElementsByTagName('button')[0]);
            }
        };
        xhr.send(data);
    }
}
function pg_get_advert(num) {
    var xhr=get_xhr();
    var data=new FormData();
    data.append('num', num);
    var result;
    if (pg_get_sign()) {
        xhr.open('post', '/php/advertin.php', false);
        xhr.onreadystatechange=function() {
            if (xhr.status==200 && xhr.readyState==4) {
                try {
                    result=JSON.parse(xhr.responseText);
                } catch (err) {
                    console.log(xhr.responseText);
                }
            }
        }
        xhr.send(data);
        return result;
    }
}
function pg_advertin() {
    var advert_box=document.getElementById('advert_box');
    var advert_item=document.getElementById('advert_item');
    try {
        var response=pg_get_advert();
        if (response[0]) {
            for (var i=0; i<Object.keys(response[1]).length; i++) {
                var advert_clone=advert_item.cloneNode(true);
                advert_clone.removeAttribute('id');
                advert_clone.classList.remove('display-none');
                for (var n=0; n<advert_clone.children.length; n++) {
                    if (advert_clone.children[n].getAttribute('data-id')=='title') {
                        advert_clone.children[n].innerHTML=response[1][i]['title'];
                    } else if (advert_clone.children[n].getAttribute('data-id')=='picture') {
                        advert_clone.children[n].innerHTML='<img src="'+response[1][i]['picture']+'">';
                    }
                }
                advert_box.appendChild(advert_clone);
            }
        }
    } catch (err) {
        console.log(err);
    }
}
function pg_advertprt() {
    var advertprt_box=document.getElementById('advertprt_box');
    var advertprt_item=document.getElementById('advertprt_item');
    var num=Math.floor((advertprt_box.clientWidth-78)/173);
    console.log(advertprt_box.clientWidth);
    var response=pg_get_advert(num);
    if (response[0]) {
        for (var i=0; i<Object.keys(response[1]).length; i++) {
            var advertprt_clone=advertprt_item.cloneNode(true);
            advertprt_clone.removeAttribute('id');
            advertprt_clone.classList.remove('display-none');
            advertprt_clone.href=response[1][i]['url'];
            for (var n=0; n<advertprt_clone.children.length; n++) {
                if (advertprt_clone.children[n].getAttribute('data-id')=='picture') {
                    advertprt_clone.children[n].innerHTML='<img src="'+response[1][i]['picture']+'">'
                } else if (advertprt_clone.children[n].getAttribute('data-id')=='title') {
                    advertprt_clone.children[n].innerHTML=response[1][i]['title'];
                }
            }
            advertprt_box.appendChild(advertprt_clone);
        }
        var clear_both=document.createElement('DIV');
        clear_both.classList.add('clear-both');
        advertprt_box.appendChild(clear_both);
    } else {
        console.log(response[1]);
    }

}











