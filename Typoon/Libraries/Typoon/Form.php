<?php

class Form
{
    /**
     * 確認画面の為のデータ・キャッシュ
     */

    public static function cacheReset()
    {
        $_SESSION["TyCache"] = array();
    }

    public static function cacheSave($array)
    {
        $_SESSION["TyCache"] = $array;
    }

    public static function cacheLoad()
    {
        return $_SESSION["TyCache"];
    }

    /**
     * Command Pattern.
     * 
     * オートマトンな状態偏移でアプリケーションを動かす時、利用できる
     */

    public static function mode($mode)
    {
        if (isset($_POST['TyMode']) && trim($_POST['TyMode']) === $mode) {
            return true;
        }
        return false;
    }

    public static function modeGet()
    {
        if (empty($_POST['TyMode'])) $_POST['TyMode'] = "";

        return $_POST['TyMode'];
    } // case, switch

    /**
     * ディレクトリのソースリストを読み込み
     */

    public static function sourceAutoLoader()
    {
        //
        $exec = Res::$EXEC;
        $path = tyDirDocument . "../Exec/{$exec}/";

        if ($dh = opendir($path)) {
            while ($filename = readdir($dh)) {
                // .phpかどうか
                if (pathinfo($filename, PATHINFO_EXTENSION) !== "php" || $filename === "index.php") continue;

                // ファイルかどうか
                if (! is_file($path . $filename)) continue;

                // ファイル読み込み
                if (file_exists($path . $filename)) {
                    require_once($path . $filename);
                }
            }

            closedir($dh);
        } else {
            //
        }
    } // 仮組み

    /**
     * $_POST["TyMode"]で関数実行  
     */

    public static function modeSwitch($array = [])
    {
        //
        if (function_exists($array[$_POST['TyMode']])) {
            $array[$_POST['TyMode']]();
            // 普通は、HTML表示へ移行して戻って来る事は無い処理

            return true;
        }

        return false;
    }

    /**
     * Is set $_POST.
     * 
     * $_POST変数があるかどうか確かめる
     */

    public static function issetPost($id)
    {
        if (isset($_POST[$id])) {
            return true;
        }

        return false;
    }

    /*

    */

    public static function domainCheck()
    {
        $url = parse_url($_SERVER['HTTP_REFERER']);

        if ($url['host'] !== typoon::$DomainName) {
            Std::errorPage(503);
            exit;
        }
    }

    /**
     * CSRF検証
     */

    //
    public static function start($flag = true)
    {
        if ($flag === true) {
            $_SESSION['TyUdidToken'] = Token::udidToken();
        }

        $_SESSION['TyFormToken'] = Token::formToken();

        return $_SESSION['TyFormToken'];
    }

    //
    public static function Check($flag = true)
    {

        //
        if ($flag === true) {
            if (empty($_SESSION['TyIpToken'])) {
                return false;
            }

            $ipcheck = $_SESSION['TyIpToken'];
            unset($_SESSION['TyIpToken']);
        }

        //
        if (empty($_SESSION['TyFormToken'])) {
            return false;
        }

        $check = $_SESSION['TyFormToken'];
        unset($_SESSION['TyFormToken']);

        //
        if (empty($_POST['TyToken'])) {
            return false;
        }

        if ($flag === true) {
            if ($check === $_POST['TyToken'] && $ipcheck === Token::udidToken()) {
                return true;
            }
        } else {
            if ($check === $_POST['TyToken']) {
                return true;
            }
        }
        return false;
    }
}
