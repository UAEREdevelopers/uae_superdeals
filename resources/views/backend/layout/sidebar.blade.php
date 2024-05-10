	<!-- partial:partials/_sidebar.html -->
		<nav class="sidebar">
      <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
          <img src="{{asset('img/logo.png')}}" alt="" width="30%">
        </a>
        <div class="sidebar-toggler not-active">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
      <div class="sidebar-body">
        <ul class="nav">
          <li class="nav-item nav-category">Main</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Dashboard</span>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin_settings')}}" class="nav-link">
              <i class="link-icon" data-feather="gear"></i>
              <span class="link-title">Settings</span>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('admin_categories')}}" class="nav-link">
              <span class="link-title">Categories</span>
            </a>
          </li>

          <li class="nav-item nav-category">Expo2020 Deals</li>
          <li class="nav-item">
              <a href="{{route('expodeals_bookings')}}" class="nav-link">
              <i class="link-icon" data-feather="calendar"></i>
              <span class="link-title"> Bookings</span>
            </a>             
          </li>


          <li class="nav-item nav-category">Interests</li>
          <li class="nav-item">
              <a href="{{route('room_inquiry')}}" class="nav-link">
              <i class="link-icon" data-feather="calendar"></i>
              <span class="link-title">By Hotel</span>
            </a>             
          </li>
          <li class="nav-item">
              <a href="{{route('room_inquiry_by_city')}}" class="nav-link">
              <i class="link-icon" data-feather="calendar"></i>
              <span class="link-title">By Cities</span>
            </a>
          </li>
          {{-- <li class="nav-item nav-category">HotelRack</li>
          <li class="nav-item">
              <a href="#" class="nav-link">
              <i class="link-icon" data-feather="calendar"></i>
              <span class="link-title">Countries</span>
            </a>             
          </li>
          <li class="nav-item">
              <a href="#" class="nav-link">
              <i class="link-icon" data-feather="calendar"></i>
              <span class="link-title">Cities</span>
            </a>             
          </li>
          <li class="nav-item">
              <a href="{{route('list_hotels_view')}}" class="nav-link">
              <i class="link-icon" data-feather="calendar"></i>
              <span class="link-title">Hotels</span>
            </a>             
          </li> --}}
          <li class="nav-item nav-category">TBO</li>
          <li class="nav-item">
              <a href="{{route('tbo_hotel_bookings')}}" class="nav-link">
              <i class="link-icon" data-feather="calendar"></i>
              <span class="link-title">Bookings</span>
            </a>             
          </li>


           <li class="nav-item nav-category">Packages</li>
          <li class="nav-item">
              <a href="{{route('list_all_packages')}}" class="nav-link">
              <i class="link-icon" data-feather="calendar"></i>
              <span class="link-title">List All</span>
            </a>             
          </li>
          <li class="nav-item">
              <a href="{{route('create_package')}}" class="nav-link">
              <i class="link-icon" data-feather="calendar"></i>
              <span class="link-title">Create Package</span>
            </a>             
          </li>

          <li class="nav-item">
              <a href="{{route('list_package_interests')}}" class="nav-link">
              <i class="link-icon" data-feather="calendar"></i>
              <span class="link-title">Interests</span>
            </a>             
          </li>

            <li class="nav-item nav-category">Blogs</li>
          <li class="nav-item">
              <a href="{{route('list_all_blogs')}}" class="nav-link">
              <i class="link-icon" data-feather="calendar"></i>
              <span class="link-title">List All</span>
            </a>             
          </li>
          <li class="nav-item">
              <a href="{{route('create_blog')}}" class="nav-link">
              <i class="link-icon" data-feather="calendar"></i>
              <span class="link-title">Create Blog</span>
            </a>             
          </li> 
        </ul>
      </div>
    </nav>
    <nav class="settings-sidebar">
     <!--side gear icon to change theme color -->
    </nav>
		<!-- partial -->