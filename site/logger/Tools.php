<?php
abstract class Tools
{
//==============================================================================
    public static function getSesVar(string $key, mixed $default=NULL) : mixed
    {
        return self::getValueFromArray($key, $_SESSION, $default);
    }    
//==============================================================================
    public static function setSesVar(string $key, mixed $value) : void
    {
        $_SESSION[$key] = $value;
    }    
//==============================================================================
    public static function getValueFromArray(string $key, array $arr, mixed $default=NULL) : mixed
    {
        return (isset($arr[$key])
                ? $arr[$key]
                : $default);
    }        
//==============================================================================
    public static function hex2str(string $str) : string
    {
        $val = array('0'=>0,'1'=>1,'2'=>2,'3'=>3,'4'=>4,'5'=>5,'6'=>6,'7'=>7,'8'=>8,'9'=>9,'A'=>10,'B'=>11,'C'=>12,'D'=>13,'E'=>14,'F'=>15);
        $result = "";
        $l = strlen($str);
        for ($i=0;$i<$l;$i+=2)
        {
            $result .= chr( ($val[$str[$i]]*16) + $val[$str[$i+1]] );
        }
        return $result;
    }        
//==============================================================================
    public static function str2hex(string $str) : string
    {
        $val = array(0=>'0',1=>'1',2=>'2',3=>'3',4=>'4',5=>'5',6=>'6',7=>'7',8=>'8',9=>'9',10=>'A',11=>'B',12=>'C',13=>'D',14=>'E',15=>'F');
        $result = "";
        $l = strlen($str);
        for ($i=0;$i<$l;$i++)
        {
            $result .= $val[ ord($str[$i]) / 16];
            $result .= $val[ ord($str[$i]) % 16];
        }
        return $result;
    }        
//==============================================================================
    public static function garble(string $str, string $key) : string
    {
        $ky = str_replace(chr(32),'',$key); 
        $kl = strlen($ky)<32 ? strlen($ky) : 32; 
        $k = array();
        for($i=0;$i<$kl;$i++)
        { 
                $k[$i] = ord($ky[$i]) & 0x1F;
        } 
        $j=0;
        for($i=0;$i<strlen($str);$i++)
        { 
                $e = ord($str[$i]); 
                $str[$i] = $e & 0xE0 ? chr($e^$k[$j]) : chr($e); 
                $j++;
                $j = $j==$kl ? 0 : $j;
        } 
        return $str; 
    } 
//==============================================================================
    public static function nicePrice(string $price, string $cur  = '&euro;') : string
    {
        return sprintf($cur."&nbsp;%01.2f",$price);
    }    
//==============================================================================
    public static function uniqueFilename() : string 
    { 
        $ipbits = explode(".", self::serverVar("REMOTE_ADDR")); 
        list($usec, $sec) = explode(" ",microtime()); 
        $usec = (integer) ($usec * 65536); 
        $sec = ((integer) $sec) & 0xFFFF; 
        return sprintf("%08x-%04x-%04x",
             ($ipbits[0] << 24) 
            |($ipbits[1] << 16) 
            |($ipbits[2] << 8) 
            |$ipbits[3], $sec, $usec); 
    } 
//==============================================================================
}    