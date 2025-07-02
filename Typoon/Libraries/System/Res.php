<?php

/**
 * ブラウザからのデータ置き場
 * 
 * $_GETを削除しているため。ブラウザーからのデータをクラスで持ってフラットで扱う
 */
class Res
{
    public static $POST = array();
    public static $GET = array();
    public static $COOKIE = array();
}
