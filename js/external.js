function pg_get_xhr() {
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
function pg_ext_prt() {
    var e=[document.getElementById('ext_prt_ads'), document.getElementById('ext_prt_box'), document.getElementById('ext_prt_item')];
    var count=Math.floor((e[0].parentNode.clientWidth-78)/173);
    if (count) {
//        set_properties_start
        var css=document.createElement('LINK');
        css.rel='stylesheet';
        css.type='text/css';
        css.href='//babbage.ru/css/external.css';
        e[0].appendChild(css);
//        set_properties_end
        var xhr=pg_get_xhr();
        var data=new FormData();
        data.append('get_ads', 1);
        data.append('count', count);
        xhr.open('post', '//babbage.ru/php/external.php', true);
        xhr.onreadystatechange=function () {
            if (xhr.status==200 && xhr.readyState==4) {
                try {
                    var r=JSON.parse(xhr.responseText);
                    if (r[0]) {
                        for (var i=0; i<Object.keys(r[1]).length; i++) {
                            var ad_clone=e[2].cloneNode(true);
                            ad_clone.removeAttribute('id');
                            ad_clone.classList.remove('display-none');
                            ad_clone.href=r[1][i]['url'];
                            for (var n=0; n<ad_clone.children.length; n++) {
                                if (ad_clone.children[n].getAttribute('data-id')=='title') {
                                    ad_clone.children[n].innerHTML=r[1][i]['title'];
                                } else if (ad_clone.children[n].getAttribute('data-id')=='picture') {
                                    var ad_img=document.createElement('IMG');
                                    ad_img.src=r[1][i]['picture'];
                                    ad_clone.children[n].appendChild(ad_img);
                                }
                            }
                            e[1].appendChild(ad_clone);
                        }
                    } else {console.log(r[1]);}
                } catch (err) {
                    console.log(err);
                    console.log(xhr.responseText);
                }
            }
        };
        xhr.send(data);
    }
}






















