<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Notifications extends Component
{

    public $notifications;

    public $newNotifications;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (Auth::check()) {
            $this->notifications = Auth::user()->notifications;
            $this->newNotifications = Auth::user()->unreadNotifications()->count();
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.notifications', [
            //'newNotifications' => $this->newNotifications,
            //'notifications' => $this->notifications,
        ]);
    }
}
