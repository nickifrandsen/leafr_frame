<?php

namespace Leafr\Core\Support;

use Illuminate\Session\Store;

class FlashNotifier
{

    private $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    public function success($message)
    {
        $this->message($message, 'success');

        return $this;
    }

    public function warning($message)
    {
        $this->message($message, 'warning');

        return $this;
    }

    public function error($message)
    {
        $this->message($message, 'danger');

        return $this;
    }

    public function message($message, $level = 'info')
    {
        $this->session->flash('flash_notification.message', $message);
        $this->session->flash('flash_notification.level', $level);

        return $this;
    }
}
