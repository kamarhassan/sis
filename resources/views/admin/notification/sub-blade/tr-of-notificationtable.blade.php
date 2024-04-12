<tr class="Row{{ $id }}" id="Row{{ $id }}">
    <td><input type="checkbox" name="ids[]" value="{{ $id }}"></td>
    <td>{{ $type }}</td>
    <td>
        <a href="#"
            @isset($route_name) 
              
           @switch($route_name)
              @case('admin.notification.get.user.info')
                  onclick="get_notification_details('{{ $route }}','{{ csrf_token() }}','modal-center');"
                 @break
              @case('admin.notification.contact.us')
                  onclick="get_notification_details('{{ $route }}','{{ csrf_token() }}','modal-center');"
                 @break
              @default
           @endswitch
           
      @endisset
            class="mailbox-name hover-primary">
            {{ $name }}
        </a>
    </td>

    <td>{{ $subject }}</td>

    <td>
        <div class="box-body ribbon-box">




     
            @if (is_null($status))
                <div class="ribbon ribbon-warning rounded20" id="pending"> {{$status_message_pending}}</div>
            @elseif ($status == 1)
                <div class="ribbon ribbon-success rounded20" id="approved">
                  {{$status_message_approved}}
               </div>
            @elseif($status == 0)
                <div class="ribbon ribbon-danger rounded20" id="deny">
                  {{$status_message_deny}}
                </div>
            @else
            @endif
        </div>
    </td>



    <td>
        <div class="box-body ribbon-box">
            @if ($is_read == 0)
                <div class="ribbon ribbon-success rounded20" id="read"> @lang('site.read')</div>
            @else
                <div class="ribbon ribbon-warning  rounded20" id="unread">
                    @lang('site.unread')</div>
            @endif
        </div>
    </td>


</tr>
