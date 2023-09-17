<table>
    <thead>
        <tr style="background-color: #D6EEEE">
            <th>Name</th>
            <th>Course</th>
            <th>Year</th>
            <th>Time In</th>
            <th>Time Out</th>
            <th>Time Spend</th>
            <th>Campus</th>
        </tr>
    </thead>
    <tbody>
        @foreach($collections as $item)
        <tr>
            <td width="50">{{ $item->student?->first_name }} {{ $item->student?->last_name }}</td>
            <td width="50">{{ $item->student?->course?->name }}</td>
            <td width="50">{{ $item->student?->year }}</td>
            <td width="50">{{ $item->created_at->format('g:i A') }}</td>
            <td width="50">
                @if ($item->logout?->status == 'Did Not Logout')
                    No Logout
                @else
                    @if ($item->logout?->status == 'Logged out')
                        {{ $item->logout?->updated_at->format('g:i A') }}
                    @elseif ($item->logout?->status == 'Not Logout')
                        - Currently Inside -
                    @else
                        - Did Not Logout -
                    @endif
                @endif
            </td>
            <td width="50">
                {{
                    \Carbon\CarbonInterval::seconds($item->logout?->updated_at->diffInSeconds($item->created_at))->cascade()->forHumans(['parts' => 2, 'join' => true])
                }}
            </td>
            <td width="50">
                {{$item->student?->course?->campus?->name}}

            </td>
        </tr>
        @endforeach
        <tr>
            <td>
                @if (count($collections) > 0)
                    Total
                @endif
            </td>
            <td>
                @if (count($collections) > 0)
                    {{ count($collections) }}
                @endif
            </td>
            <!-- Add any additional columns you need here -->
        </tr>
    </tbody>
</table>
