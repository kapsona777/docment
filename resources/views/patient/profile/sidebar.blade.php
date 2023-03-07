@php
    $user_image=App\BannerImage::first();
@endphp
<div class="dashboard-widget">
    <div class="dashboard-account-info">
            @if ($user->image)
            <img src="{{ url($user->image) }}" alt="user image">
            @else
            <img src="{{ $user_image->default_profile ? url($user_image->default_profile) : '' }}" alt="user image">

            @endif

            <h3>{{ ucfirst($user->name) }}</h3>
            <p>{{ $text->patient_id }}: {{ $user->patient_id }}</p>
    </div>
     <ul>
         <li class="{{ request()->routeIs('patient.dashboard')?'active':'' }}"><a href="{{ route('patient.dashboard') }}"><i class="fas fa-chevron-right"></i> {{ $text->dashboard }}</a></li>
         <li class="{{ request()->routeIs('patient.message')?'active':'' }}"><a href="{{ route('patient.message') }}"><i class="fas fa-chevron-right"></i> {{ $text->message }}</a></li>

         <li class="{{ request()->routeIs('patient.meeting-history')?'active':'' }}"><a href="{{ route('patient.meeting-history') }}"><i class="fas fa-chevron-right"></i> {{ $text->meeting_history }}</a></li>

         <li class="{{ request()->routeIs('patient.upcomming-meeting')?'active':'' }}"><a href="{{ route('patient.upcomming-meeting') }}"><i class="fas fa-chevron-right"></i> {{ $text->upcoming_meeting }} </a></li>


         <li class="{{ request()->routeIs('patient.account')?'active':'' }}"><a href="{{ route('patient.account') }}"><i class="fas fa-chevron-right"></i> {{ $text->account_info }}</a></li>
         <li class="{{ request()->routeIs('patient.appointment')?'active':'' }}"><a href="{{ route('patient.appointment') }}"><i class="fas fa-chevron-right"></i> {{ $text->appointment_list }}</a></li>
         <li class="{{ request()->routeIs('patient.order')?'active':'' }}"><a href="{{ route('patient.order') }}"><i class="fas fa-chevron-right"></i> {{ $text->order_list }}</a></li>



         <li class="{{ request()->routeIs('patient.change.password')?'active':'' }}"><a href="{{ route('patient.change.password') }}"><i class="fas fa-chevron-right"></i> {{ $text->change_password }}</a></li>


         <li><a href="{{ route('logout') }}"><i class="fas fa-chevron-right"></i> {{ $text->logout }}</a></li>
     </ul>
 </div>
