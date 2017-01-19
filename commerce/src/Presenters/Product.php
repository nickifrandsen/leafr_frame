<?php 

namespace Leafr\Commerce\Presenters;

use Leafr\Core\Presenters\Presenter;
use Leafr\Core\Setting;


class Product extends Presenter
{

    public function price()
    {
        if ($this->entity->sale_price) {
            return money($this->entity->sale_price);
        }

        return money($this->entity->unit_price);
    }


    public function on_sale()
    {
        if ($this->entity->sale_price) {
            return true;
        }

        return false;
    }

    public function media()
    {
        return $this->entity->medias()->orderBy('order')->get();
    }
}
