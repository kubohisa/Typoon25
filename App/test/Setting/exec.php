<?php

class urlFunc
{
    public static $list = [
        ["/", "adminIndex"],
        ["/menu", "adminMenu"],
        ["/test/:id", "test"],
        ["/wildcard/*id", "test"]
    ];
}
