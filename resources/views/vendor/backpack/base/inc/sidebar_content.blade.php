<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-title">{!! getSetting('menu_title', 'Demo Entities') !!}</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i>
        {{ trans('backpack::base.dashboard') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('iso') }}'><i class='nav-icon la la-cubes'></i>
        Isos</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('sic') }}'><i class='nav-icon la la-folder'></i>
        Sics</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('account') }}'><i class='nav-icon la la-user'></i>
        Accounts</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('deal') }}'><i class='nav-icon la la-handshake'></i>
        Deals</a></li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-key"></i> Authentication</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('user') }}">
                <i class="nav-icon la la-user"></i> Users
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('role') }}">
                <i class="nav-icon la la-group"></i> Roles
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ backpack_url('permission') }}">
                <i class="nav-icon la la-lock"></i> Permissions
            </a>
        </li>
    </ul>
</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('setting') }}'><i class='nav-icon la la-cog'></i> <span>Settings</span></a></li>