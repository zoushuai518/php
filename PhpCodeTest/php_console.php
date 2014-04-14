<?php



class Console{
    public static function logjs($var)
    {
        self::scriptHead();
        self::format($var);
        self::scriptFoot();
    }

    private static function format($var)
    {
        $tmp = json_encode($var);
        echo 'var v = eval("(" +\'' .$tmp. '\'+ ")");';
        echo 'console.log(v);';
    }

    private static function scriptHead()
    {
        echo '<script type="text/javascript">';
    }

    private static function scriptFoot()
    {
        echo '</script>';
    }
}


//变量
$i = 'I am a wenmaoquan';

console::logjs($i);

//数组
$arr = array(1,2,3,4,5);

Console::logjs($arr);

//对象
$obj1 = array(
    'key1' => 'value99',
    'key2' => 'value98',
    'key3' => 'value97'
);
$obj2 = array(
    'key4' => 'value96',
    'key5' => 'value95',
    'key6' => 'value94'
);
$obj3 = array(
    'key7' => 'value93',
    'key8' => 'value92',
    'key9' => 'value91'
);


Console::logjs($obj1);


//对象数组
$objArr1 = array($obj1,$obj2,$obj3);
$objArr2 = array(
    array($obj1),
    array($obj2),
    array($obj3)
);

//
Console::logjs($objArr1);
Console::logjs($objArr2);
?>