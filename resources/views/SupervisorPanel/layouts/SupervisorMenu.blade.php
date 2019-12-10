<div class="menu">
    <ul class="list">

        <li @if($Active == 'WebSite') class="active" @endif>
            <a href="{{ URL::to('/') }}" target="_blank">
                <i class="material-icons">web</i>
                <span>تصفح الموقع</span>
            </a>
        </li>


        <li @if($Active == 'Index') class="active" @endif>
            <a href="{{ URL::to('/SupervisorPanel') }}">
                <i class="material-icons">home</i>
                <span>الرئيسيه</span>
            </a>
        </li>

        <!-- settings -->
        <li @if($Active == 'Profile') class="active" @endif>
            <a href="{{ URL::to('/SupervisorPanel/UpdateProfile') }}">
                <i class="material-icons">verified_user</i>
                <span>إعدادات الحساب</span>
            </a>
        </li>


        <!-- categories -->
        <li @if($Active == 'Categories' ||$Active == 'Articles'  ) class="active" @endif>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">dashboard</i>
                <span>إداره الأقسام والمقالات</span>
            </a>

            <ul class="ml-menu">

                <li @if($Active == 'Categories') class="active" @endif>
                    <a href="{{ URL::to('/SupervisorPanel/Categories') }}">إداره الأقسام</a>
                </li>

                <li @if($Active == 'Articles') class="active" @endif>
                    <a href="{{ URL::to('/SupervisorPanel/Articles') }}">إداره المقالات</a>
                </li>
            </ul>
        </li>



    </ul>
</div>