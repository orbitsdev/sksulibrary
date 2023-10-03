<table>
    <thead>
        <tr>
            <th width="20">Name</th>
            <th width="10">Year</th>
            <th width="25">Course</th>
            <th width="25">Campus</th>
            <th width="15">Time In</th>
            <th width="15">Time Out</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($collections as $item)
            <tr class="">
                <td>
                    {{ !empty($item) ? $item->first_name . ' ' . $item->last_name : '' }}
                </td>
                <td>
                    {{ !empty($item) ? $item->year : '' }}
                </td>
                <td>
                    {{ !empty($item) && !empty($item->course) ? $item->course->name : 'No Course Assigned' }}
                </td>
                <td>
                    {{ !empty($item) && !empty($item->course) && !empty($item->course->campus) ? $item->course->campus->name : 'No Campus Assigned' }}
                </td>

                <td></td>

            </tr>

            @forelse ($item->logins as $login)
                <tr class="">
                    <td colspan="4" width="20"></td>
                    <td width="10">
                        {{ !empty($login->created_at) ? $login->created_at->format('g:i A') : '' }}
                    </td>
                    @if (!empty($login->logout) && $login->logout->status == 'Did Not Logout')
                        <td width="20">No Logout</td>
                    @else
                        <td width="20">
                            @if (!empty($login->logout))
                                @if ($login->logout->status == 'Logged out')
                                    {{ $login->logout->updated_at->format('g:i A') }}
                                @elseif ($login->logout->status == 'Not Logout')
                                    - Currently Inside -
                                @else
                                    - Did Not Logout -
                                @endif
                            @endif
                        </td>
                    @endif
                </tr>
                
              
            @empty
            @endforelse

        @empty

        @endforelse
        <tr>
            <td colspan="5">Total Visitors</td>
            <td>
                @if (count($collections) > 0)
                    {{ count($collections) }}
                @endif
            </td>
        </tr>

    </tbody>
</table>
