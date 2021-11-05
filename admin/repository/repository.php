<?php

namespace SmartWeb\Repository;

interface Repository
{
    public static function select($sql, array $values = null);
    public static function delete($sql, array $values = null);
}
