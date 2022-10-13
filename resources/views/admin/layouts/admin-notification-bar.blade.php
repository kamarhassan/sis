{{-- {{dd(get_count_notification())}} --}}
@can ('see notification') 
    
    <li class="dropdown user notifications-menu">
        <a href="#" class="waves-effect waves-light rounded dropdown-toggle" data-toggle="dropdown" title="Notifications">
            <i class="ti-bell">
                {{-- <div class="pulse nbmarker pulseWarningIns"></div> --}}
                @if (get_count_notification() > 0)
                    <div class="pulse  marker pulseWarningIns">
                        {{ get_count_notification() }}
                    </div>
                @endif
            </i>
        </a>
        @if (get_count_notification() > 0)
            <ul class="dropdown-menu animated bounceIn">
                <li class="header">
                    <div class="p-20">
                        <div class="flexbox">
                            <div>
                                <h4 class="mb-0 mt-0">Notifications</h4>
                            </div>
                            {{-- <div>
                                <a href="#" class="text-danger">Clear All</a>
                            </div> --}}
                        </div>
                    </div>
                </li>
                <li>
                    <ul class="menu sm-scrol">
                        @foreach (get_type_notification() as $notifcation)
                            <li>
                                <a href="#">
                                    <i class="fa fa-users text-info"></i> @lang('site.' . $notifcation['description'])
    
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="footer">
                    <a href="{{ route('admin.new.register.order') }}">View all</a>
                </li>
            </ul>
        @else
            <ul class="dropdown-menu animated bounceIn">
                <li class="header">
                    <ul class="menu sm-scrol">
                        <li>
                            <a href="#">
                                <i class="fa fa-users text-info"></i>
                                @lang('site.you dont have any notification')
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        @endif
    </li>
    
@endcan