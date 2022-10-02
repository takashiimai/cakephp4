<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Post extends Entity
{
    /**
     * 
     */
    protected function _getImageUrl()
    {
        return '/' . $this->image;
    }

    protected function _getUpdatedAtLabel()
    {
        return date("Y/m/d H:i", strtotime($this->updated_at));
    }

}