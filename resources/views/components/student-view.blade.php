

<div class="grid grid-cols-2 ">
    <div class="col-span-1 text-center">
        <div class="mb-14">

            <div class="flex justify-center">
                
                <div style="width: 220px; height:220px">
                    <img src="{{asset('images/girl.jpg')}}" alt="" class="w-full h-full">
                    
                </div>
            </div>
            <p class="mt-2  text-center"> 2x2 Picture</p>
        </div>
        <div class="" style="margin-top: 40px">

            <div class="flex justify-center">
                
                <div style="width:auto; height:300px">
                    <img src="{{asset('images/girl.jpg')}}" alt="" class="w-full h-full">
                    
                </div>
            </div>
            <p class="mt-2  text-center"> School Id Picture</p>
        </div>
        <div class="" style="margin-top: 40px">

            <div class="flex justify-center">
                
                <div style="width:auto; height:300px; ">
                    <img src="{{asset('images/girl.jpg')}}" alt="" class="w-full h-full">
                    
                </div>
            </div>
            <p class="mt-2  text-center"> Profile Picture </p>
        </div>
        
        
    </div>
 
   
    <div class="col-span-1 p-4">
        

        <div class="" >

            <x-list-tile :title="'ID NO'" :body="$record->id_number ?? ''"/>
            <x-list-tile :title="'Barcode'" :body="$record->barcode ?? '' "/>
            <x-list-tile :title="'Name'" :body="$record->first_name.' '.$record->last_name "/>
            <x-list-tile :title="'Campus '" :body="$record->campus->name ?? ''"/>
            <x-list-tile :title="'Course '" :body="$record->course->name ?? ''"/>
            <x-list-tile :title="'Year '" :body="$record->year ?? ''"/>
            <x-list-tile :title="'Sex'" :body="$record->sex ?? ''"/>
            <x-list-tile :title="'Phone number'" :body="$record->contact_number??''"/>
            <x-list-tile :title="'Street'" :body="$record->street_address ?? ''"/>
            <x-list-tile :title="'City'" :body="$record->city ?? ''"/>
            <x-list-tile :title="'Country'" :body="$record->country ?? ''"/>
            <x-list-tile :title="'State'" :body="$record->state ?? ''"/>
            <x-list-tile :title="'Postal Code'" :body="$record->postal_code ?? ''"/>
          
            
          </div>
    </div>
</div>
