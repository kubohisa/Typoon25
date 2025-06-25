<?php

/**
 * PDOライブラリ（仮組み）
 */

use PDO;

class Sqlite
{
    private $d;

    // mysql
    public function connect($database)
    {
        if (isset($this->d)) {
            return $this->d;
        }

        try {
            $this->d = new PDO("sqlite:../data/{$database}.sql");
            $this->d->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->d->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            return;
        } catch (Exception $e) {
            echo mb_convert_encoding($e->getMessage() . PHP_EOL, 'UTF-8', 'auto');
            die;
        }
    }

    public function get()
    {
        return $this->d;
    }

    public function close()
    {
        $this->d = null;
    }

    /**
     * 
     */

    public function prepare($sql)
    {
        return $this->d->prepare($sql);
    }

    public function bindValue($st, $key, $value, $type = null)
    {
        return $st->bindValue($key, $value, $type);
    }

    /**
     * 
     */

    public function execute($st, $array = null)
    {
        return $st->execute($array);
    }

    public function fetch($st, $array = null)
    {
        if (! $st->execute($array)) return false;
        return $st->fetch();
    }

    public function fetchAll($st, $array = null)
    {
        if (! $st->execute($array)) return false;
        return $st->fetchAll();
    }

    /**
     * エラーが出たら知らべて対応するgolang likeな実装
     */

    public function errorInfo()
    {
        return $this->d->errorInfo();
    }

    public function errorInfoPrepare($pre)
    {
        return $pre->errorInfo();
    }

    /**
     * トランザクション処理
     */

    public function transactionStart()
    {
        $this->d->beginTransaction();
    }

    public function transactionCommit()
    {
        $this->d->commit();
    }

    public function transactionRollback()
    {
        $this->d->rollBack();
    }
}
