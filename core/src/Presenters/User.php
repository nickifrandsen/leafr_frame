<?php 

namespace Leafr\Core\Presenters;

class User extends Presenter
{

    public function name()
    {
        return $this->entity->first_name . ' ' . $this->entity->last_name;
    }

}
    
