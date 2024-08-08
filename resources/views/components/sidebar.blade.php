@php
    $segment1 = request()->segment(1);
    $segment2 = request()->segment(2);
    $segment3 = request()->segment(3);
@endphp
<aside id="layout-menu"  class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{route('home')}}" class="app-brand-link">
          <span class="app-brand-logo demo">
            <img height="50px" src="{{asset('assets/logo.svg')}}"/>
          </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <x-menu-item icon="bi bi-grid" :active="!isset($segment1)" :url="route('home')" :name="__('menu.dashboard')"/>
        <x-menu-item icon="bi bi-person-lines-fill" :active="$segment1 == 'contact'" :url="route('contact.index')" :name="__('menu.contact')"/>
        <x-menu-item-dropdown
            bi-icon="bi-quote"
            :visibility="\App\Helper::HasPermissionMenu('testimonial')"
            :name="__('menu.testimonials')"
            :active="$segment1 == 'testimonial'"
            :child="[
                [
                    'url' => route('testimonial.create'),
                    'name' => __('menu.add_new'),
                    'visibility' => \App\Helper::HasPermissionMenu('testimonial', 'create'),
                    'active' => $segment1 == 'testimonial' && $segment2 == 'create'
                ],
                [
                    'visibility' => \App\Helper::HasPermissionMenu('testimonial', 'view'),
                    'url' => route('testimonial.index'),
                    'active' => $segment1 == 'testimonial' && !isset($segment2),
                    'name' => __('menu.all_testimonial')
                ]
            ]
        "/>
        <x-menu-item-dropdown
            bi-icon="bi-view-list"
            :visibility="\App\Helper::HasPermissionMenu('category')"
            :name="__('menu.category_management')"
            :active="$segment1 == 'category'"
            :child="[
                [
                    'url' => route('category.create'),
                    'name' => __('menu.add_new'),
                    'active' => $segment1 == 'category' && $segment2 == 'create',
                    'visibility' => \App\Helper::HasPermissionMenu('category', 'create'),
                ],
                [
                    'visibility' => \App\Helper::HasPermissionMenu('category', 'view'),
                    'url' => route('category.index'),
                    'active' => $segment1 == 'category' && !isset($segment2),
                    'name' => __('menu.categories')
                ]
            ]
        "/>


    <x-menu-item-dropdown
        bi-icon="bi-code"
        :visibility="\App\Helper::HasPermissionMenu('problem')"
        :name="__('menu.problem_management')"
        :active="$segment1 == 'problem'"
        :child="[
            [
                'url' => route('problem.create'),
                'name' => __('menu.add_new'),
                'active' => $segment1 == 'problem' && $segment2 == 'create',
                'visibility' => \App\Helper::HasPermissionMenu('problem', 'create'),
            ],
            [
                'visibility' => \App\Helper::HasPermissionMenu('problem', 'view'),
                'url' => route('problem.index'),
                'active' => $segment1 == 'problem' && !isset($segment2),
                'name' => __('menu.all_problems')
            ]
        ]
    "/>

        <x-menu-item-dropdown
            bi-icon="bi-braces-asterisk"
            :visibility="\App\Helper::HasPermissionMenu('role')"
            :name="__('menu.roles_management')"
            :active="$segment1 == 'roles'"
            :child="[
               /* [
                    'url' => 'd',
                    'name' => __('menu.permission')
                ],*/
                [
                    'visibility' => \App\Helper::HasPermissionMenu('role', 'view'),
                    'url' => route('role.index'),
                    'active' => $segment1 == 'roles',
                    'name' => __('menu.roles')
                ]
            ]
        "/>

        <x-menu-item-dropdown
            bi-icon="bi-people"
            :visibility="\App\Helper::HasPermissionMenu('user')"
            :name="__('menu.users_management')"
            :active="$segment1 == 'users'"
            :child="[
               /* [
                    'url' => 'd',
                    'name' => __('menu.permission')
                ],*/
                [
                    'visibility' => \App\Helper::HasPermissionMenu('user', 'view'),
                    'url' => route('user.index'),
                    'active' => $segment1 == 'users',
                    'name' => __('menu.users')
                ]
            ]
        "/>
        
    </ul>
</aside>
<!-- / Menu -->
