<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"></h3>
    </div>

    <div class="box-body">
        <div class="table-responsive">
            <table id="example1" class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('site.grade') # @lang('site.level') </th>
                        <th>@lang('site.teacher') </th>
                        <th>@lang('site.remainig') </th>
                        <th>@lang('site.start date') </th>
                        <th>@lang('site.end date') </th>
                        <th>@lang('site.total days attendance')% </th>
                        <th>@lang('site.total marks') %</th>

                    </tr>
                </thead>
                <tbody>
                    @isset($std['cours'])
                        {{--                    {{dd(1)}} --}}
                        @foreach ($std['cours'] as $key => $stdcours)
                        @php
                           $stdcours['pivot']['remaining']==0?$class='text-success': $class='text-danger';
                        @endphp
                            <tr id="Row{{ $stdcours->id }}" class="hover-success hoverable">
                                <td>{{ $stdcours->id }}</td>
                                <td>{{ $stdcours['categorty_name'] }} : [ {{ $stdcours['grade_'] }} # {{ $stdcours['level_'] }} ]</td>
                                <td>{{ $stdcours['tacher_'] }}</td>
                                <td><span class="{{$class}}">{{ $stdcours['pivot']['remaining'] }}</span></td>
                                <td>{{ $stdcours['act_StartDa'] }}</td>
                                <td>{{ $stdcours['act_EndDa'] }}</td>
                                <td>{{ $stdcours['attendance_percent'] }} @isset($stdcours['attendance_percent'])
                                   %
                                @endisset</td>
                                <td>{{ $stdcours['marks_percent'] }} @isset($stdcours['marks_percent'])
                                   %
                                @endisset</td>



                                {{-- <td><a href="{{ route('admin.students.profile', $stduents->id) }}"
                                        class="btn text-primary glyphicon glyphicon-info-sign hover-warning"
                                        title="@lang('site.info')" onclick="">
                                    </a>
                                </td> --}}
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
                <tfoot>

                </tfoot>
            </table>

        </div>
    </div>

</div>
