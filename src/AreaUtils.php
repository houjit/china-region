<?php
namespace houjit\ChinaArea;

class AreaUtils
{


    public static function findByCode($areaCode)
    {
        return self::findFirst(intval(trim($areaCode)), AreaTable::COLUMN_ID);
    }

    public static function findByTitle($areaName)
    {
        return self::findFirst(trim($areaName), AreaTable::COLUMN_TITLE);
    }

    public static function listSubNode($areaCode){
        return self::find(intval(trim($areaCode)), AreaTable::COLUMN_PARENT_ID);
    }

    /**
     * @param $value
     * @param string $column
     * @return bool|Region
     */
    protected static function findFirst($value, $column = AreaTable::COLUMN_ID)
    {
        $row = array_search($value, array_column(AreaTable::$table, $column));
        if ($row) {
            return new Region(AreaTable::$table[$row]);
        }
        return false;
    }

    /**
     * @param $value
     * @param string $column
     * @return bool|Region[]
     */
    protected static function find($value, $column = AreaTable::COLUMN_ID)
    {
        $ids = array_keys(array_column(AreaTable::$table, $column), $value);
        $rows = false;
        if (is_array($ids)) {
            foreach ($ids as $id) {
                $rows[$id] = new Region(AreaTable::$table[$id]);
            }
        }
        return $rows;
    }
}
