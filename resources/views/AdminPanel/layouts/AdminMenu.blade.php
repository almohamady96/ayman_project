<div class="menu">
    <ul class="list">

        <li @if($Active == 'WebSite') class="active" @endif>
            <a href="{{ URL::to('/') }}" target="_blank">
                <i class="material-icons">web</i>
                <span>تصفح الموقع</span>
            </a>
        </li>


        <li @if($Active == 'Index') class="active" @endif>
            <a href="{{ URL::to('/AdminPanel') }}">
                <i class="material-icons">home</i>
                <span>الرئيسيه</span>
            </a>
        </li>

        <!-- settings -->
        <li @if($Active == 'Profile') class="active" @endif>
            <a href="{{ URL::to('/AdminPanel/UpdateProfile') }}">
                <i class="material-icons">verified_user</i>
                <span>إعدادات الحساب</span>
            </a>
        </li>


        <!-- settings -->
        <li @if($Active == 'Settings') class="active" @endif>
            <a href="{{ URL::to('/AdminPanel/General/Settings') }}">
                <i class="material-icons">settings</i>
                <span>إعدادات الموقع</span>
            </a>
        </li>


        <!-- users -->
        <li @if($Active == 'Users' ||$Active == 'NoPermissions' ||$Active == 'Sellers' || $Active == 'SuperAdmins' ||$Active == 'Admins' || $Active == 'DefaultUsers') class="active" @endif>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">group</i>
                <span>إدارة الأعضاء</span>
            </a>

            <ul class="ml-menu">

                <li @if($Active == 'Users') class="active" @endif>
                    <a href="{{ URL::to('/AdminPanel/Users') }}">كل الأعضاء </a>
                </li>

                {{--<li @if($Active == 'SuperAdmins') class="active" @endif>
                    <a href="{{ URL::to('/AdminPanel/Users/SuperAdmins') }}">أعضاء بصلاحيه مدير الموقع </a>
                </li>

                <li @if($Active == 'Admins') class="active" @endif>
                    <a href="{{ URL::to('/AdminPanel/Users/Admins') }}">أعضاء بصلاحيه مشرف </a>
                </li>
                <li @if($Active == 'NoPermissions') class="active" @endif>
                    <a href="{{ URL::to('/AdminPanel/Users/NoPermissions') }}">أعضاء بدون صلاحيات </a>
                </li>--}}


            </ul>
        </li>
        
        <!-- categories -->
        <li @if($Active == 'Categories' ||$Active == 'Articles'  ) class="active" @endif>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">dashboard</i>
                <span>إداره أقسام المدونة والمقالات</span>
            </a>

            <ul class="ml-menu">
                {{--
                <li @if($Active == 'Categories') class="active" @endif>
                    <a href="{{ URL::to('/AdminPanel/Categories') }}">إداره الأقسام</a>
                </li>
                --}}

                <li @if($Active == 'Articles') class="active" @endif>
                    <a href="{{ URL::to('/AdminPanel/Articles') }}">إداره المقالات</a>
                </li>
            </ul>
        </li>

        <!-- appearence -->
        <li @if($Active == 'DynamicPages' ||$Active == 'Menus' ||$Active == 'HomeSettings'||$Active == 'Widgets'  ) class="active" @endif>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">lock_open</i>
                <span>الصفحات الثابته و إعدادت الظهور</span>
            </a>

            <ul class="ml-menu">
                <li @if($Active == 'DynamicPages') class="active" @endif>
                    <a href="{{ URL::to('/AdminPanel/Pages') }}"> الصفحات الثابته</a>
                </li>

                <li @if($Active == 'HomeSettings') class="active" @endif>
                    <a href="{{ URL::to('/AdminPanel/HomeSettings') }}"> الصفحه الرئيسيه / هيدر الموقع</a>
                </li>

               {{-- <li @if($Active == 'AboutSettings') class="active" @endif>
                    <a href="{{ URL::to('/AdminPanel/AboutSettings') }}"> صفحة من نحن</a>
                </li>

                <li @if($Active == 'Menus') class="active" @endif>
                    <a href="{{ URL::to('/AdminPanel/Menus') }}">إداره القوائم</a>
                </li>

                <li @if($Active == 'Widgets') class="active" @endif>
                    <a href="{{ URL::to('/AdminPanel/Widgets') }}">إداره الودجات</a>
                </li>--}}

            </ul>
        </li>


        {{--<!-- Questionnaire -->
        <li @if($Active == 'Questionnaire') class="active" @endif>
            <a href="{{ URL::to('/AdminPanel/Questionnaires') }}">
                <i class="material-icons">insert_chart</i>
                <span>إداره الإستفتاءات</span>
            </a>
        </li>


        <!-- Ads -->

        <li @if($Active == 'AllAds' ||$Active == 'InactiveAds'||$Active == 'ActiveAds') class="active" @endif>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">attach_money</i>
                <span>إدارة المساحات الإعلانيه </span>
            </a>

            <ul class="ml-menu">
                <li @if($Active == 'AllAds') class="active" @endif>
                    <a href="{{ URL::to('/AdminPanel/Ads/') }}"> كل الإعلانات</a>
                </li>
                <li @if($Active == 'ActiveAds') class="active" @endif>
                    <a href="{{ URL::to('/AdminPanel/Ads/Active') }}"> الإعلانات النشطه</a>
                </li>
                <li @if($Active == 'InactiveAds') class="active" @endif>
                    <a href="{{ URL::to('/AdminPanel/Ads/InActive') }}"> الإعلانات الغير نشطه</a>
                </li>
            </ul>
        </li>

        <!-- users -->
        <li @if($Active == 'Users') class="active" @endif>
            <a href="{{ URL::to('/AdminPanel/Users') }}" >
                <i class="material-icons">group</i>
                <span>إدارة الأعضاء</span>
            </a>
        </li>--}}


        {{--
        <!-- educational subjects -->
        <li @if( $Active == 'EducationalSubjects' ) class="active" @endif>
            <a href="{{ URL::to('/AdminPanel/EducationalSubjects') }}" >
                <i class="material-icons">library_books</i>
                <span>إداره المناهج التعليميه</span>
            </a>
        </li>
        --}}

        <!-- team member -->
        <li @if($Active == 'TeamMembers') class="active" @endif>
            <a href="{{ URL::to('/AdminPanel/TeamMembers') }}">
                <i class="material-icons">group_work</i>
                <span>إداره فريق العمل</span>
            </a>
        </li>


        <!-- gallery -->
        <li @if($Active == 'Gallery') class="active" @endif>
            <a href="{{ URL::to('/AdminPanel/Gallery') }}">
                <i class="material-icons">photo_library</i>
                <span>إداره مكتبه الصور</span>
            </a>
        </li>
        <li class="{{ $Active == 'Videos' ? 'active' : '' }}">
            <a href="{{URL::to('AdminPanel/Videos')}}">
                <i class="material-icons">video_library</i>
                <span>إدارة الفيديوهات</span>
            </a>
        </li>

        <!-- partners -->
        <li @if($Active == 'Partners') class="active" @endif>
            <a href="{{ URL::to('/AdminPanel/Partners') }}">
                <i class="material-icons">donut_large</i>
                <span>إداره عملاؤنا</span>
            </a>
        </li>

        <!-- Certificates -->
        <li @if($Active == 'Certificates') class="active" @endif>
            <a href="{{ URL::to('/AdminPanel/Certificates') }}">
                <i class="material-icons">donut_large</i>
                <span>إداره الإعتمادات</span>
            </a>
        </li>
        
        <!-- Centers -->
        <li @if($Active == 'Centers') class="active" @endif>
            <a href="{{ URL::to('/AdminPanel/Centers') }}">
                <i class="material-icons">donut_large</i>
                <span>إداره مراكز التدريب</span>
            </a>
        </li>
        
        {{--
        <!-- Organizer1Types -->
        <li @if($Active == 'Organizer1Types') class="active" @endif>
            <a href="{{ URL::to('/AdminPanel/Organizer1Types') }}">
                <i class="material-icons">donut_large</i>
                <span>إداره شركاء صين</span>
            </a>
        </li>
        <!-- Organizer2Types -->
        <li @if($Active == 'Organizer2Types') class="active" @endif>
            <a href="{{ URL::to('/AdminPanel/Organizer2Types') }}">
                <i class="material-icons">donut_large</i>
                <span>إداره شركاء آخرين</span>
            </a>
        </li>
        --}}
        
        <li class="{{ $Active == 'Services' ? 'active' : '' }}">
            <a href="{{URL::to('AdminPanel/Services')}}">
                <i class="material-icons">shop</i>
                <span>إدارة الدورات التدريبية</span>
            </a>
        </li>

        <!-- quotes -->
        <li @if($Active == 'Quotes') class="active" @endif>
            <a href="{{ URL::to('/AdminPanel/Quotes') }}">
                <i class="material-icons">format_quote</i>
                <span>آراء الأعضاء في الأكاديميه</span>
            </a>
        </li>

        <!-- contact us -->
        <li @if($Active == 'ContactForm') class="active" @endif>
            <a href="{{ URL::to('/AdminPanel/Contacts') }}">
                <i class="material-icons">chat</i>
                <span>إداره نماذج إتصل بنا</span>
            </a>
        </li>

        <!-- PersonalTraining us -->
        <li @if($Active == 'PersonalTrainingForm') class="active" @endif>
            <a href="{{ URL::to('/AdminPanel/PersonalTrainings') }}">
                <i class="material-icons">list</i>
                <span>إداره نماذج تسجيل فردى</span>
            </a>
        </li>

        <!-- CompaniesTraining us -->
        <li @if($Active == 'CompaniesTrainingForm') class="active" @endif>
            <a href="{{ URL::to('/AdminPanel/CompaniesTrainings') }}">
                <i class="material-icons">list</i>
                <span>إداره نماذج تسجيل شركات</span>
            </a>
        </li>

        <!-- RegisterTrainer us -->
        <li @if($Active == 'RegisterTrainerForm') class="active" @endif>
            <a href="{{ URL::to('/AdminPanel/RegisterTrainers') }}">
                <i class="material-icons">list</i>
                <span>إداره نماذج تسجيل المدربين</span>
            </a>
        </li>

        {{--
                <!-- translation -->
                <li @if($Active == 'TranslationRequests') class="active" @endif>
                    <a href="{{ URL::to('/AdminPanel/TranslationRequests') }}">
                        <i class="material-icons">language</i>
                        <span>إداره طلبات الترجمه</span>
                    </a>
                </li>
        --}}

        {{--
                <li @if($Active == 'Emails') class="active" @endif>
                    <a href="{{ URL::to('/AdminPanel/Emails/All') }}">
                        <i class="material-icons">mail_outline</i>
                        <span>إدارة الرسائل</span>
                    </a>
                </li>
        --}}


    </ul>
</div>