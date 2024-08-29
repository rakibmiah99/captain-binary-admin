@php
    $segment1 = request()->segment(1);
    $segment2 = request()->segment(2);
    $segment3 = request()->segment(3);
@endphp
<aside id="layout-menu"  class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="#" class="app-brand-link sidebar-logo-link">
          <span class="app-brand-logo demo">
            <img height="50px" src="{{asset('assets/logo.svg')}}"/>
          </span>
        </a>

        <script>
            $('.sidebar-logo-link').click(() => window.location.href = getWebURL());
        </script>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <x-menu-item icon="bi bi-grid" :active="!isset($segment1)" :url="route('dashboard')" name="dashboard"/>
        <x-menu-item icon="bi bi-person-lines-fill" :active="$segment1 == 'contacts'" :url="route('contacts')" name="Contact"/>
        <x-menu-item icon="bi bi-quote" :active="$segment1 == 'testimonials'" :url="route('testimonials')" name="Testimonial"/>
        <x-menu-item icon="bi bi-view-list" :active="$segment1 == 'category'" :url="route('category')" name="Category"/>
        <x-menu-item icon="bi bi-code" :active="$segment1 == 'problems'" :url="route('problems')" name="Problems"/>
        <x-menu-item icon="bi bi-people" :active="$segment1 == 'users'" :url="route('users')" name="Admins"/>
        {{--<x-menu-item-dropdown
            bi-icon="bi-quote"
            :visibility="true"
            name="testimonials"
            :active="$segment1 == 'testimonial'"
            :child="[
                [
                    'url' => '',
                    'name' => add_new,
                    'visibility' => true,
                    'active' => $segment1 == 'testimonial' && $segment2 == 'create'
                ],
                [
                    'visibility' => true,
                    'url' => '',
                    'active' => $segment1 == 'testimonial' && !isset($segment2),
                    'name' => __('menu.all_testimonial')
                ]
            ]
        "/>

        "/>--}}
    </ul>
</aside>
<!-- / Menu -->
