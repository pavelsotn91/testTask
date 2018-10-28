<?php

$text = " Пятая ве	phP рсия  
    PHP была	 выпущена разработчиками
13 июля 2004 года. Изменения включают обновление ядра Zend (Zend Engine 2), что существенно увеличило эффективность интерпретатора. Введена поддержка языка разметки XML. Полностью переработаны функции ООП, которые стали во многом схожи с моделью, используемой в Java. В частности, введён деструктор, открытые, закрытые и защищённые члены и методы, окончательные члены и методы, интерфейсы и клонирование объектов. Нововведения, однако, были сделаны с расчётом сохранить наибольшую совместимость с кодом на предыдущих версиях языка. На данный момент последней стабильной веткой является PHP 5.3, которая содержит ряд изменений и дополнений";
$array_of_words = ['php', 'xml', 'ООП', 'интерфейс', 'Zend'];

$count = 1000;
$totalTime = 0;

$charset = mb_detect_encoding($text);
$text = iconv($charset, "UTF-8", $text);

//$text = nl2br($text);
//$textAsArray = preg_split('//u', $text, null, PREG_SPLIT_NO_EMPTY);
//
//echo '<pre>';
//echo implode($textAsArray);
//
//echo '<hr>';
//print_r($textAsArray);
//echo '</pre>';

function highlightKeywords($text, $array_of_words) {
    $textAsArray = preg_split('//u', $text, null, PREG_SPLIT_NO_EMPTY);
    foreach($array_of_words as $word) {
        $lengthWord = mb_strlen($word);
        $pos = mb_stripos($text, $word, 0, 'UTF-8');
        if($pos !== false) {
            if( ( in_array($textAsArray[$pos - 1], [' ', '  ', NULL, '[', '(', '{']) ) && ( in_array($textAsArray[$pos + $lengthWord], [' ', '   ', NULL, ']', ')', '}', '.', ',', '!', '?', '-', ':', ';'])) ) {
                $textAsArray[$pos] = '{{' . $textAsArray[$pos];
                $textAsArray[$pos + $lengthWord -1] = $textAsArray[$pos + $lengthWord -1] . '}}';
            }
        }
    }
    $text = implode($textAsArray);
    return $text;  
}

echo highlightKeywords($text, $array_of_words);

/*do {
 
$start = microtime(true);

$text = substr_replace($text, '{{', 3, 0);



//function highlightKeywords($text, $array_of_words) {
//    foreach($array_of_words as $word) {
//        $lengthWord = strlen($word);
//        $pos = mb_stripos($text, $word, 0, 'UTF-8');
//        if($pos !== false) {
////        if( ( in_array($text[$pos - 1], [' ', '  ', NULL, '[', '(', '{']) ) && ( in_array($text[$pos + $lengthWord], [' ', '   ', NULL, ']', ')', '}', '.', ',', '!', '?', '-', ':', ';'])) ) {
////            $text[$pos-1] = '{{';
////            $text[$pos + $lengthWord] = '}}';
////        }
//            $text = substr_replace($text, '{{', $pos - 1);
//        }
//    }
//    return $text;  
//}

echo '<pre>';
print_r(highlightKeywords($text, $array_of_words));
echo '</pre>';

//echo highlightKeywords($text, $array_of_words);
$totalTime += round(microtime(true) - $start, 4);
$count--;
} while ($count > 0);*/
//$text = substr_replace($text, '{{', 3, 0);

//$pos = mb_stripos($text, 'php', 0, 'UTF-8');
//
////$text = str_replace('ята', '{{', $text);
//echo 'ikghik'. $a[20] . 'jyflj';
//echo '<pre>';
//print_r($textAsArray);
//echo '</pre>';

//echo '<br>Время выполнения скрипта: ' . $totalTime/1000 . ' сек.';