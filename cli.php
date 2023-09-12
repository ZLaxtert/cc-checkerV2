<?php
/*==========> INFO 
 * CODE     : BY ZLAXTERT
 * SCRIPT   : CC CHECKER
 * VERSION  : DEMO
 * TELEGRAM : t.me/zlaxtert
 * BY       : DARKXCODE
 */

require_once "function/function.php";
require_once "function/settings.php";

echo banner();
echo banner2();
enterlist:
echo "\n\n [$BL+$WH]$BL Enter your list $WH($DEF eg:$YL list.txt$WH )$GR >> $WH";
$listname = trim(fgets(STDIN));
if(empty($listname) || !file_exists($listname)) {
 echo " [!] Your Fucking list not found [!]".PHP_EOL;
 goto enterlist;
}
$lists = array_unique(explode("\n",str_replace("\r","",file_get_contents($listname))));

echo " [$BL+$WH]$BL Enter your apikey $GR >> $WH";
$apikey = trim(fgets(STDIN));


$total = count($lists);
$live = 0;
$die = 0;
$unknown = 0;
$no = 0;
echo PHP_EOL.PHP_EOL;
foreach ($lists as $list) {
    $no++;

    $api = "https://darkxcode.com/checker/cc_checker/test/?apikey=$apikey&cc=$list&proxy=$Proxies&proxyPWD=$proxy_pwd";
    // CURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "CURL/COMMAND LINE");
    $x = curl_exec($ch);
    curl_close($ch);
    $js  = json_decode($x, TRUE);
    $msg           = $js['data']['info']['msg'];
    $CRE           = $js['data']['info']['credit_ball'];
    $bin           = $js['data']['info']['bin'];
    $scheme        = $js['data']['info']['scheme'];
    $country       = $js['data']['info']['country'];
    $bank_name     = $js['data']['info']['bank_name'];
    $bank_brand    = $js['data']['info']['bank_brand'];

    if(strpos($x, '"status":"success"')){
        $live++;
        save_file("result/live.txt","$list");
        echo "[$RD$no$DEF/$GR$total$DEF]$GR LIVE$DEF =>$BL $list$DEF | [$YL CRE$DEF: $MG$CRE$DEF ] | [$YL BIN$DEF: $MG$bin$DEF ] | [$YL COUNTRY$DEF: $MG$country$DEF ] | [$YL SCHEME$DEF: $MG$scheme$DEF ] | [$YL BANK NAME$DEF: $MG$bank_name$DEF ] | [$YL BANK BRAND$DEF: $MG$bank_brand$DEF ] | [$YL MSG$DEF: $MG$msg$DEF ] | BY$CY DARKXCODE$DEF (DEMO)".PHP_EOL;
    }else if (strpos($x, '"status":"failed"')){
        $die++;
        save_file("result/die.txt","$list");
        echo "[$RD$no$DEF/$GR$total$DEF]$RD DIE$DEF =>$BL $list$DEF |  [$YL CRE$DEF: $MG$CRE$DEF ] | [$YL MSG$DEF: $MG$msg$DEF ] | BY$CY DARKXCODE$DEF (DEMO)".PHP_EOL;
    }else{
        $unknown++;
        save_file("result/unknown.txt","$list");
        echo "[$RD$no$DEF/$GR$total$DEF]$YL UNKNOWN$DEF =>$BL $list$DEF | BY$CY DARKXCODE$DEF (DEMO)".PHP_EOL;
    }

}
//============> END

echo PHP_EOL;
echo "================[DONE]================".PHP_EOL;
echo " DATE          : ".$date.PHP_EOL;
echo " LIVE          : ".$live.PHP_EOL;
echo " DIE           : ".$die.PHP_EOL;
echo " UNKNOWN       : ".$unknown.PHP_EOL;
echo " TOTAL         : ".$total.PHP_EOL;
echo "======================================".PHP_EOL;
echo "[+] RATIO LIVE => $GR".round(RatioCheck($live, $total))."%$DEF".PHP_EOL.PHP_EOL;
echo "[!] NOTE : CHECK AGAIN FILE 'unknown.txt' [!]".PHP_EOL;
echo "This file '".$listname."'".PHP_EOL;
echo "File saved in folder 'result/' ".PHP_EOL.PHP_EOL;


// ==========> FUNCTION

function collorLine($col){
    $data = array(
        "GR" => "\e[32;1m",
        "RD" => "\e[31;1m",
        "BL" => "\e[34;1m",
        "YL" => "\e[33;1m",
        "CY" => "\e[36;1m",
        "MG" => "\e[35;1m",
        "WH" => "\e[37;1m",
        "DEF" => "\e[0m"
    );
    $collor = $data[$col];
    return $collor;
}
?>
