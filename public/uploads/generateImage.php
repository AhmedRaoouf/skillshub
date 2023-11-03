<?php


$path = __DIR__ .'/exams';
$ext = "png";

for ($i = 1; $i < 41; $i++) {
    copy("$path/exam.png", "$path/$i.$ext");
    echo "image $i.$ext created <br/> ";
}
