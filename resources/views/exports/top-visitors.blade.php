<table>
    <thead>
        <tr style="background-color: #5bd188">
            <th style="background-color: #5bd188">Name</th>
            <th style="background-color: #5bd188">Year</th>
            <th style="background-color: #5bd188">Course</th>
            <th style="background-color: #5bd188">Campus</th>
            <th style="background-color: #5bd188">Total Visit</th>
 
        </tr>
    </thead>
    <tbody>
        @foreach($collections as $item)
        <tr>    

            <td align="left" width="50">
                {{ !empty($item) ? $item->last_name . ', ' . $item->last_name . ' '.$item->middle_name : '' }}

            </td>
            <td align="left" width="50">
                {{ !empty($item) ? $item->year : '' }}
            </td>
            <td align="left" width="50">
                {{ !empty($item) && !empty($item->course) ? $item->course->name : '   No Course Assigned' }}

            
            </td>
            <td align="left" width="50">
                {{ !empty($student) && !empty($student->course) && !empty($item->course->campus) ? $item->course->campus->name : 'No Campus Assigned' }}

            </td>
            <td align="left" width="50">
                {{count($item->logins)}}
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
