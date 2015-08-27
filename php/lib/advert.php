<?php

namespace Panggoo;

class advert_config {
    private $conf=array(
        'db_host'=>'localhost',
        'db_login'=>'root',
        'db_password'=>'',
        'db_name'=>'pg_advert'
    );
    public $mysqli;
    public $url,$title,$picture,$token,$reg_date;
    public function getMysqli() {
        $this->mysqli=new \Mysqli($this->conf['db_host'], $this->conf['db_login'], $this->conf['db_password'], $this->conf['db_name']);
        $this->mysqli->set_charset('utf8');
        return $this->mysqli;
    }
    public function getUrl($url) {
        $parsed=parse_url($url);
        if (!empty($url) && $parsed) {
            if (!@$parsed['scheme'] || $parsed['scheme']=='http' || $parsed['scheme']=='https') {
                $url=((!@$parsed['scheme'])?'http://'.$url:$url);
                $c = curl_init();
                curl_setopt($c, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.157 Safari/537.36');
                curl_setopt($c, CURLOPT_REFERER, $url);
                curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($c, CURLOPT_HEADER, true);
                curl_setopt($c, CURLOPT_NOBODY, false);
                curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 2);
                curl_setopt($c, CURLOPT_URL, $url);
                curl_exec($c);
                $status = curl_getinfo($c, CURLINFO_HTTP_CODE);
                curl_close($c);
                if ($status>=200 && $status<=308) {
                    $this->getMysqli();
                    $url=$this->mysqli->real_escape_string($url);
                    $this->url=$url;
                    return 1;
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
    public function getTitle($title) {
        if (iconv_strlen($title, 'UTF-8')<=35) {
            $this->getMysqli();
            $title=$this->mysqli->real_escape_string($title);
            $this->title=$title;
            return 1;
        } else {
            return 0;
        }
    }
    public function getPicture($picture) {
        $type=new \finfo();
        if (substr_count($type->file($picture['tmp_name']),'JPEG') ||
            substr_count($type->file($picture['tmp_name']),'PNG') ||
            substr_count($type->file($picture['tmp_name']),'GIF')) {
            if (substr_count($type->file($picture['tmp_name']),'JPEG')) {
                $source=imagecreatefromjpeg($picture['tmp_name']);
            } else if (substr_count($type->file($picture['tmp_name']),'PNG')) {
                $source=imagecreatefrompng($picture['tmp_name']);
            } else if (substr_count($type->file($picture['tmp_name']),'GIF')) {
                $source=imagecreatefromgif($picture['tmp_name']);
            }
            $img_res=['w'=>imagesx($source), 'h'=>imagesy($source)];
            $k=$img_res['w']/$img_res['h'];
            $needle_res=['w'=>(($k<=556/316)?(314*$k):(556)),'h'=>314];

            $shift=floor(($k>556/314)?(($k*$needle_res['h'])-$needle_res['w'])/2:0);
            $source_resize=imagecreatetruecolor($needle_res['w'], $needle_res['h']);
            imagecopyresized($source_resize, $source, $shift*(-1), 0, 0, 0, $k*$needle_res['h'], $needle_res['h'], $img_res['w'], $img_res['h']);
            imagejpeg($source_resize, $picture['tmp_name']);
            $this->picture='data:'.$picture['type'].';base64,'.base64_encode(file_get_contents($picture['tmp_name']));
            return 1;
        } else {
            return 0;
        }
    }
    public function getToken() {
        $token='';
        $length=40;
        $code_alphabet='ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code_alphabet.='abcdefghijklmnopqrstuvwxyz';
        $code_alphabet.='0123456789';
        $max=iconv_strlen($code_alphabet, 'UTF-8')-1;
        for ($i=0; $i<$length; $i++) {
            $token.=$code_alphabet[rand(0, $max)];
        }
        $this->token=sha1($token);
        $advert=new advert();
        if (!$advert->getAdvert(null, $this->token)[0]) {
            return 1;
        } else {
            return 0;
        }
    }
    public function getRegDate() {
        $this->reg_date=date('Y-m-d H:i:s');
        return 1;
    }
}
class advert {
    public $advert, $err_log;

    public function getAdvert($num=null, $token=null) {
        $conf=new advert_config();
        $conf->getMysqli();
        if ($token) {
            $request=$conf->mysqli->query("SELECT * FROM `advert` WHERE `token`={$token}");
            if ($request && $request->num_rows) {
                $this->advert=$request->fetch_assoc();
                return [1, 'Success'];
            } else {
                $this->err_log="That's advertisement doesn't exist";
                return [0, $this->err_log];
            }
        } else {
            if ((int)$num) {$num="LIMIT 0, {$num}";} else {$num='';}
            $sign=@$_SESSION['sign'];
            $request=$conf->mysqli->query("SELECT * FROM `advert` WHERE `owner`={$sign['Id']} ORDER BY `Id` DESC {$num}");
            if ($request && $request->num_rows) {
                $this->advert=array();
                while ($r=$request->fetch_assoc()) {
                    array_push($this->advert, $r);
                }
                return [1, 'Success'];
            }
        }
    }
    public function putAdvert($owner, $url, $title, $picture) {
        if (!empty($url) && !empty($title) && !empty($picture)) {
            $conf=new advert_config();
            if ((int)$owner && $conf->getToken() && $conf->getUrl($url) && $conf->getTitle($title) && $conf->getPicture($picture) && $conf->getRegDate()) {
                if ($conf->getMysqli() && $conf->mysqli->query("INSERT INTO `advert` (`owner`, `token`, `url`, `title`, `picture`, `reg_date`) VALUES ({$owner}, '{$conf->token}', '{$conf->url}', '{$conf->title}', '{$conf->picture}', '{$conf->reg_date}')")) {
                    return [1, 'Success'];
                } else {
                    $this->err_log='System error, sorry';
                    return [0, $this->err_log];
                }
            } else if (!$conf->getPicture($picture)) {
                $this->err_log='Invalid picture';
                return [0, $this->err_log];
            } else if (!$conf->getTitle($title)) {
                $this->err_log='Invalid title';
                return [0, $this->err_log];
            } else if (!$conf->getUrl($url)) {
                $this->err_log='Invalid URL, please check out the URL format or try to get access to this site';
//                return [0, $this->err_log];
                return [0, $conf->url];
            } else {
                $this->err_log='Just unlucky day, try to click the button again';
                return [0, $this->err_log];
            }
        } else {
            $this->err_log='Some field is empty';
            return [0, $this->err_log];
        }
    }
    public function extAdvert($count) {
        if ((int)$count) {
            $conf= new advert_config();
            $conf->getMysqli();
            $request=$conf->mysqli->query("SELECT * FROM `advert` LIMIT 0,{$count}");
            if ($request) {
                $response=[];
                while ($ad=$request->fetch_assoc()) {
                    array_push($response, $ad);
                }
                return [1, $response];
            } else {
                return [0, 'Trouble-bla-bla..'];
            }
        }
    }
}
?>



















