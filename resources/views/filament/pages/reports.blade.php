<x-filament::page>



{{ $this->form }}


<table class="min-w-full divide-y divide-gray-300">
    <thead>
      <tr>
        <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold  sm:pl-6 lg:pl-8">Student Name</th>
        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold ">Course</th>
        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold ">Year </th>
        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold ">Time In</th>
        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold ">Time Out</th>
        
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-200 ">
        @forelse ($logins as $item)

        <tr>
            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium  sm:pl-6 lg:pl-8"> {{$item->student->first_name}}  {{$item->student->last_name}} </td>
            <td class="whitespace-nowrap px-3 py-4 text-sm ">{{$item->student->course->name }}</td>
            <td class="whitespace-nowrap px-3 py-4 text-sm ">{{$item->student->year }}</td>
            <td class="whitespace-nowrap px-3 py-4 text-sm ">{{$item->created_at->format('h:i:s A l')}}</td>
            <td class="whitespace-nowrap px-3 py-4 text-sm ">{{$item->logout->updated_at->format('h:i:s A l')}}</td>
           
          </tr>
      @empty
          {{$this->table}}
      @endforelse
    
    

      <!-- More people... -->
    </tbody>
  </table>
 
</x-filament::page>
