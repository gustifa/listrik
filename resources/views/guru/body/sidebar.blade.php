@php
  $id = Auth::user()->id;
  $guruId = App\Models\User::find($id);
  $status = $guruId->status;
@endphp

<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Guru</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
     </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{url('/guru/dashboard')}}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        @if ($status === '1') 
        <li class="menu-label">Kelola</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Pembelajaran</div>
            </a>
            <ul>
                <li> <a href="{{route('lihat.jadwal.guru')}}"><i class='bx bx-radio-circle'></i>Jadwal</a>
                <li> <a href="{{route('lihat.jurnal.guru')}}"><i class='bx bx-radio-circle'></i>Jurnal</a>
                </li>
                
            </ul>
        </li>
        @else

        @endif
        
        <li>
            <a href="{{route('index')}}" target="_blank">
                <div class="parent-icon"><i class="bx bx-planet"></i>
                </div>
                <div class="menu-title">Frontend</div>
            </a>
        </li>
        <li>
            <a href="{{route('staff.logout')}}">
                <div class="parent-icon"><i class="bx bx-log-out"></i>
                </div>
                <div class="menu-title">Logout</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
