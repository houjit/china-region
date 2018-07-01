<?php
namespace houjit\ChinaArea;

class Area
{
    const DEFAULT_PARENT_ID = 000000;
    private $id;
    private $name;
    private $title;
    private $parentId;

    public function __construct($row)
    {
        if (!count($row) > 4) {
            throw new \Exception('area row error');
        }
        $this->id = $row[AreaTable::COLUMN_ID];
        $this->name = $row[AreaTable::COLUMN_NAME];
        $this->title = $row[AreaTable::COLUMN_TITLE];
        $this->parentId = $row[AreaTable::COLUMN_PARENT_ID];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTitle()
    {
        return $this->title;
    }


    /**
     * 取省份
     * @return $this|bool
     */
    public function getProvince()
    {
        if ($this->parentId == self::DEFAULT_PARENT_ID) {
            return $this;
        }
        $parentArea = AreaUtils::findByCode($this->parentId);
        if ($parentArea) {
            return $parentArea->getProvince();
        }
        return null;
    }


    public function isCity()
    {

    }

}
