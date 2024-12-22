<?php
const class_version = "1.0.1";
// Warna teks
const n = "\n";          // Baris baru
const d = "\033[0m";     // Reset
const m = "\033[1;31m";  // Merah
const h = "\033[1;32m";  // Hijau
const k = "\033[1;33m";  // Kuning
const b = "\033[1;34m";  // Biru
const u = "\033[1;35m";  // Ungu
const c = "\033[1;36m";  // Cyan
const p = "\033[1;37m";  // Putih
const o = "\033[38;5;214m"; // Warna mendekati orange
const o2 = "\033[01;38;5;208m"; // Warna mendekati orange

// Warna teks tambahan
const r = "\033[38;5;196m";   // Merah terang
const g = "\033[38;5;46m";    // Hijau terang
const y = "\033[38;5;226m";   // Kuning terang
const b1 = "\033[38;5;21m";   // Biru terang
const p1 = "\033[38;5;13m";   // Ungu terang
const c1 = "\033[38;5;51m";   // Cyan terang
const gr = "\033[38;5;240m";  // Abu-abu gelap

// Warna latar belakang
const mp = "\033[101m\033[1;37m";  // Latar belakang merah
const hp = "\033[102m\033[1;30m";  // Latar belakang hijau
const kp = "\033[103m\033[1;37m";  // Latar belakang kuning
const bp = "\033[104m\033[1;37m";  // Latar belakang biru
const up = "\033[105m\033[1;37m";  // Latar belakang ungu
const cp = "\033[106m\033[1;37m";  // Latar belakang cyan
const pm = "\033[107m\033[1;31m";  // Latar belakang putih (merah teks)
const ph = "\033[107m\033[1;32m";  // Latar belakang putih (hijau teks)
const pk = "\033[107m\033[1;33m";  // Latar belakang putih (kuning teks)
const pb = "\033[107m\033[1;34m";  // Latar belakang putih (biru teks)
const pu = "\033[107m\033[1;35m";  // Latar belakang putih (ungu teks)
const pc = "\033[107m\033[1;36m";  // Latar belakang putih (cyan teks)
const yh = d."\033[43;30m"; // Latar belakang kuning (black teks)

// Warna latar belakang tambahan
const bg_r = "\033[48;5;196m";   // Latar belakang merah terang
const bg_g = "\033[48;5;46m";    // Latar belakang hijau terang
const bg_y = "\033[48;5;226m";   // Latar belakang kuning terang
const bg_b1 = "\033[48;5;21m";   // Latar belakang biru terang
const bg_p1 = "\033[48;5;13m";   // Latar belakang ungu terang
const bg_c1 = "\033[48;5;51m";   // Latar belakang cyan terang
const bg_gr = "\033[48;5;240m";  // Latar belakang abu-abu gelap

const p = "\033[1;97m",m = "\033[1;31m",h = "\033[1;32m",k = "\033[1;33m",c = "\033[1;36m",b = "\033[1;34m",mp = "\033[101m\033[1;37m",n = "\n",d = "\033[0m",t = "\t",r = " \r",bp="\033[104m\033[1;37m";
class Requests {
  static function Curl($u, $h = 0, $p = 0,$mode = 0){
    while(true){
      $ch = curl_init();
		  curl_setopt($ch, CURLOPT_URL, $u);
	   	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	   	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	   	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	   	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	   	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		  curl_setopt($ch, CURLOPT_COOKIE,TRUE);
	   	curl_setopt($ch, CURLOPT_COOKIEFILE,"cookie.txt");
	    curl_setopt($ch, CURLOPT_COOKIEJAR,"cookie.txt");
		  if($mode){
		    curl_setopt($ch, CURLOPT_CUSTOMREQUEST,$mode);
		  }
		  if($p) {
		    curl_setopt($ch, CURLOPT_POST, true);
			  curl_setopt($ch, CURLOPT_POSTFIELDS, $p);
		  }
		  if($h) {
		    curl_setopt($ch, CURLOPT_HTTPHEADER, $h);
		  }
		  curl_setopt($ch, CURLOPT_HEADER, true);
      $r = curl_exec($ch);
		  $c = curl_getinfo($ch);
		  if(!$c) return "Curl Error : ".curl_error($ch); else{
		    $hd = substr($r, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
			  $bd = substr($r, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
			  curl_close($ch);
			  return array($hd,$bd);
		  }
    }
  }
}
class Display {
  static function Menu($no,$content){
    print(h.'--['.p.$no.h.'] '.k.$content.n);
  }
  static function Error($except){
	  print(m."--[".p."!".m."] ".p.$except.n);
	}
	static function Sukses($msg){
	  print(h."--[".p."✓".h."] ".p.$msg.n);
	}
	static function Line($len = 44){
	  print b.str_repeat('─',$len).d.n;
	}
	static function Isi($msg){
	  return h.'--['.k.'Input '.$msg.h.']➤ '.k;
	}
	static function ban(){
	  $Api = self::ipApi();
	  echo bp.'     '.$Api->country.' '.$Api->city.' '.$Api->query.'     '.d.n;
	  print r.'┏━┓┏┳┓━┓┏━┓┳━┓ '.k.'┳ ┳┏┳┓   '.r.'➤ '.p.'Script : '.y.name.n.r.'┣━┫┃ ┃ ┃┣━┫┃ ┃ '.k.'┗┳┛ ┃    '.r.'➤ '.p.'Version: '.g.version.n.r.'┻ ┻┻ ┻┗┛┻ ┻┻━┛ '.k.' ┻  ┻    '.r.'➤ '.p.'Status : '.g.'Online'.n;
	  self::line();
	}
	
	static function ipApi(){
		$r = json_decode(file_get_contents("http://ip-api.com/json"));
		if($r->status == "success")return $r;
	}
	static function cetak($nama,$content){
	  print(h.'--['.k.$nama.h.'] '.k.'=> '.h.'['.k.$content.h.']'.n);
	}
}

class Functions {
  static $configFile = "config.json";
  static function Tmr($tmr){
    date_default_timezone_set("UTC");
    $sym = [' ─ ',' / ',' │ ',' \ ',];
    $timr = time()+$tmr;
    $a = 0;
    while(true){
      $a +=1;
      $res=$timr-time();
      if($res < 1) {
        break;
      }print $sym[$a % 4].p.date('H',$res).":".p.date('i',$res).":".p.date('s',$res)."\r";
      usleep(100000);
    }
    print "\r           \r";
  }
  static function setConfig($key){$configFile='config.json';$config=[];if(file_exists($configFile)){$config=json_decode(file_get_contents($configFile),true);}if(isset($config[$key])){return $config[$key];}else{Display::ban();$data = readline(Display::isi($key));$config[$key]=$data;file_put_contents($configFile,json_encode($config,JSON_PRETTY_PRINT));return $data;}}
}

