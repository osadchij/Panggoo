<?php

namespace Panggoo;

class sign_config {
    private $conf=array(
        'db_host'=>'localhost',
        'db_login'=>'root',
        'db_password'=>'',
        'db_name'=>'pg_sign'
    );
    public $mysqli;
    public $username,$password,$email,$token,$reg_date;
    public function getMysqli() {
        $this->mysqli=new \Mysqli($this->conf['db_host'], $this->conf['db_login'], $this->conf['db_password'], $this->conf['db_name']);
        $this->mysqli->set_charset('utf8');
        return $this->mysqli;
    }
    public function getUsername($username) {
        if (!empty($username) && iconv_strlen($username, 'UTF-8')<=40) {
            $this->getMysqli();
            $username=$this->mysqli->real_escape_string($username);
            $this->username=$username;
            return 1;
        } else {
            return 0;
        }
    }
    public function getPassword($password) {
        if (!empty($password)) {
            $this->password=sha1($password);
            return 1;
        } else {
            return 0;
        }
    }
    public function getEmail($email) {
        if (empty($email) || (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL))) {
            $this->getMysqli();
            $email=$this->mysqli->real_escape_string($email);
            $this->email=$email;
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
        $sign=new sign();
        if (!$sign->getSign(null, null, null, $this->token)[0]) {
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
class sign {
    public $user, $err_log;

    public function getSign($username=null, $password=null, $email=null, $token=null) {
        $conf=new sign_config();
        $conf->getMysqli();
        if ($conf->getUsername($username)) {
            $username=$conf->username;
            $request="SELECT * FROM `account` WHERE `username`='{$username}'";
        } else if (@$email && $conf->getEmail($email)) {
            $email=$conf->email;
            $request="SELECT * FROM `account` WHERE `email`='{$email}'";
        } else if (@$token && iconv_strlen($token, 'UTF-8')===40) {
            $token=$conf->mysqli->real_escape_string($token);
            $request="SELECT * FROM `account` WHERE `token`='{$token}'";
        }
        if (!empty($password)) {
            $conf->getPassword($password);
            $password=$conf->password;
            $request.=" and `password`='{$password}'";
        }
        if ($conf->mysqli->query($request)->num_rows) {
            $this->user=$conf->mysqli->query($request)->fetch_assoc();
            return [1, 'Success'];
        } else {
            return [0, 'The combination is not found'];
        }
    }
    public function putSign($username, $password, $email) {
        if (!empty($username) && !empty($password)) {
            $conf=new sign_config();
            if (
                $conf->getUsername($username) &&
                $conf->getPassword($password) &&
                $conf->getEmail($email)
            ) {
                if ($conf->getToken()) {
                    $conf->getRegDate();
                    $account=[$conf->username, $conf->password, $conf->email, $conf->token, $conf->reg_date];
                    $conf->getMysqli();
                    if (!$this->getSign($username)[0]) {
                        if ($conf->mysqli->query("INSERT INTO `account` (`username`, `password`, `email`, `token`, `reg_date`)
                                                                VALUES  ('{$account[0]}', '{$account[1]}', '{$account[2]}', '{$account[3]}', '{$account[4]}')")) {
                            return [1, 'Success'];
                        } else {
                            $this->err_log=$conf->mysqli->error;
                            return [0, $this->err_log];
                        }
                    } else {
                        $this->err_log='Username already exist';
                        return [0, $this->err_log];
                    }
                } else {
                    $this->err_log='Sorry error of system, please click the button again, if you see this message not first time email us - support@panggoo.com';
                    return [0, $this->err_log];
                }
            } else {
                $this->err_log='Some field has an issue';
                return [0, $this->err_log];
            }
        } else {
            $this->err_log='Some field is empty';
            return [0, $this->err_log];
        }
    }
    public function getRecovery($owner=null, $token=null) {
        if (!empty($owner) || !empty($token)) {
            $conf=new sign_config();
            $conf->getMysqli();
            if ((int)$owner) {
                $owner=(int)$owner;
                $request="SELECT * FROM `recovery` WHERE `owner`='{$owner}'";
            } else if (!empty($token)) {
                $token=$conf->mysqli->real_escape_string($token);
                $request="SELECT * FROM `recovery` WHERE `token`='{$token}'";
            }
            if (@$request && $conf->mysqli->query($request)->num_rows) {
                $this->user=$conf->mysqli->query($request)->fetch_assoc();
                $this->user=$conf->mysqli->query("SELECT * FROM `account` WHERE `Id`='{$this->user['owner']}'")->fetch_assoc();
                return 1;
            } else {
                return 0;
            }
        }
    }
}
?>