@auth
                        <div class="dropdown dropright cart-dropdown">
                            <a href="#" data-toggle="dropdown" class="porto-icon dropdown-toggle">
                                <i class="icon icon-heart"></i>
                                <span class="cart-count">{{ $newNotifications }}</span>
                            </a>
                            <div class="dropdown-menu" style="min-width:250px">
                                <div class="dropdownmenu-wrapper">
                                    @foreach($notifications as $notification)
                                    <a href="{{ route('notifications.read', $notification->id) }}">
                                    <h5>{{ $notification->data['title'] }}
                                        @if($notification->unread()) * @endif
                                    </h5>    
                                    <p>{{ $notification->data['body'] }}</p>
                                    <small>{{ $notification->created_at->diffForHumans() }}</small></a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endauth