<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

  <!-- ! Hide app brand if navbar-full -->
  <div class="app-brand demo">
    <a href="{{url('/')}}" class="app-brand-link">
      {{-- <span class="app-brand-logo demo" style="margin-bottom: 10px;">
        <svg height="64px" width="64px" style="width:38px!important" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#000000;} </style> <g> <path class="st0" d="M115.661,133.014l38.064-10.084c1.112-0.214,1.902-1.208,1.902-2.35c0-1.141-0.79-2.136-1.902-2.351 l-38.064-10.083c-0.995-0.225-1.804-1.025-2.018-2.028l-10.046-38.055c-0.264-1.112-1.248-1.902-2.389-1.902 c-1.141,0-2.126,0.79-2.39,1.902l-10.036,38.055c-0.224,1.004-1.034,1.804-2.028,2.028l-38.064,10.083 c-1.113,0.215-1.903,1.21-1.903,2.351c0,1.142,0.79,2.136,1.903,2.35l38.064,10.084c0.995,0.215,1.805,1.024,2.028,2.028 l10.036,38.055c0.264,1.112,1.248,1.902,2.39,1.902c1.14,0,2.125-0.79,2.389-1.902l10.046-38.055 C113.857,134.038,114.666,133.229,115.661,133.014z"></path> <path class="st0" d="M462.695,68.785l-50.283-13.322c-1.317-0.292-2.39-1.346-2.672-2.672L396.476,2.507 C396.125,1.044,394.827,0,393.316,0c-1.512,0-2.809,1.044-3.16,2.507L376.902,52.79c-0.302,1.326-1.365,2.38-2.682,2.672 l-50.284,13.322c-1.473,0.292-2.516,1.599-2.516,3.111s1.044,2.818,2.516,3.101l50.284,13.332c1.317,0.273,2.38,1.346,2.682,2.672 l13.254,50.274c0.35,1.472,1.648,2.516,3.16,2.516c1.511,0,2.808-1.044,3.16-2.516l13.263-50.274 c0.282-1.326,1.355-2.4,2.672-2.672l50.283-13.332c1.473-0.283,2.517-1.589,2.517-3.101S464.168,69.077,462.695,68.785z"></path> <path class="st0" d="M369.529,173.448c-44.842-34.651-80.517-8.153-113.149-8.153c-32.612,0-68.296-26.498-113.139,8.153 C98.399,208.1,98.029,278.152,124.897,360.99c24.459,75.427,41.819,110.634,44.852,126.793 c6.115,32.622,44.843,32.622,52.996-2.038c4.427-18.822,3.072-86.026,33.636-86.026c30.584,0,29.219,67.205,33.647,86.026 c8.153,34.66,46.88,34.66,52.995,2.038c3.033-16.159,20.393-51.366,44.852-126.793C414.743,278.152,414.372,208.1,369.529,173.448z M252.43,258.89l-36.318,9.626c-0.946,0.194-1.726,0.974-1.93,1.93l-9.587,36.309c-0.244,1.062-1.18,1.814-2.272,1.814 c-1.092,0-2.029-0.751-2.273-1.814l-9.586-36.309c-0.214-0.956-0.986-1.736-1.931-1.93l-36.318-9.626 c-1.064-0.204-1.814-1.16-1.814-2.243c0-1.092,0.751-2.038,1.814-2.243l36.318-9.626c0.946-0.205,1.717-0.975,1.931-1.93 l9.586-36.309c0.244-1.062,1.18-1.814,2.273-1.814c1.092,0,2.028,0.751,2.272,1.814l9.587,36.309 c0.205,0.956,0.984,1.726,1.93,1.93l36.318,9.626c1.064,0.205,1.815,1.151,1.815,2.243 C254.245,257.73,253.494,258.686,252.43,258.89z"></path> </g> </g></svg>
      </span> --}}
      {{-- <span class="app-brand-text demo menu-text fw-bold ms-2">{{config('variables.templateName')}}</span> --}}
      
      <img src="{{ public_path_image($horizontalLogo) }}" class="img img-fluid">
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    @php
    $menu = $menuData[0]->menu;

    $filters = [];

    if (!Auth::user()->is_admin) {
      $filters[] = 'admin';
    }

    if (!Auth::user()->is_admin && Auth::user()->status != "Doctor") {
      $filters[] = 'doctor';
    }

    if (Auth::user()->status != "Patient") {
      $filters[] = 'patient';
    }
    if (!empty($filters)) {
      $filter = function($item) use ($filters) {
        return !(isset($item->allow) && in_array($item->allow, $filters));
      };
      foreach ($menu as &$item) {
        if (isset($item->submenu)) {
          $item->submenu = array_filter($item->submenu, $filter);
        }
      }
      $menuData[0]->menu = array_values(array_filter($menu, $filter));
    }
    @endphp

    @foreach ($menuData[0]->menu as $menu)

    {{-- Adding active and open class if child is active --}}

    {{-- Menu headers --}}
    @if (isset($menu->menuHeader))
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">{{ __($menu->menuHeader) }}</span>
    </li>
    @else

    {{-- Active menu method --}}
    @php
    $activeClass = null;
    $currentRouteName = Route::currentRouteName();

    // Check if the current route matches the menu slug
    if ($currentRouteName === $menu->slug) {
      $activeClass = 'active';
    }
    elseif (isset($menu->submenu)) {
      $submenuActive = false;

    // Check if any submenu slug matches the current route
      foreach($menu->submenu as $submenu) {
        if (gettype($submenu->slug) === 'array') {
          foreach($submenu->slug as $slug) {
            if (str_contains($currentRouteName, $slug) && strpos($currentRouteName, $slug) === 0) {
              $submenuActive = true;
              break;
            }
          }
        }
        else {
          if (str_contains($currentRouteName, $submenu->slug) && strpos($currentRouteName, $submenu->slug) === 0) {
            $submenuActive = true;
            break;
          }
        }
      }

      if ($submenuActive) {
        $activeClass = 'active open';
      }
    }
    @endphp

    {{-- Main menu --}}
    <li class="menu-item {{$activeClass}}">
      <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0);' }}" class="{{ isset($menu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}" @if (isset($menu->target) and !empty($menu->target)) target="_blank" @endif>
        @isset($menu->icon)
        <i class="{{ $menu->icon }}"></i>
        @endisset
        <div>{{ isset($menu->name) ? __($menu->name) : '' }}</div>
        @isset($menu->badge)
        <div class="badge rounded-pill bg-{{ $menu->badge[0] }} text-uppercase ms-auto">{{ $menu->badge[1] }}</div>
        @endisset
      </a>

      {{-- Submenu --}}
      @isset($menu->submenu)
      @include('layouts.sections.menu.submenu', ['menu' => $menu->submenu])
      @endisset
    </li>
    @endif
    @endforeach
  </ul>

</aside>
