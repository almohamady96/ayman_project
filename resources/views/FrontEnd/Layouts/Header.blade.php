<?php
$setting = \App\Setting::get()->keyBy('key')->all();
if ($setting['logo']->value != '') {
    $logo_path = '/storage/app/Settings/' . $setting['logo']->value;
} else {
    $logo_path = '/SiteAssets/Technomasr/images/logo.png';
}

?>

<!-- start header-->
    <header>
        <div class="top-header container">
            <div class="row">
                <div class="col-md-3">
                    <a href="{{URL::to('/')}}">
                        <img src="{{URL::to($logo_path)}}" class="logo float-right" alt="">
                    </a>
                </div>
                <div class="col-md-9">
                    <ul class="pull-left p-t-15">
                        @if($setting['mobile']->value !='')
                            <a class="m-r-5 m-l-5 prime-color" href="tel:{{$setting['mobile']->value }}"> 
                                <i class="fa fa-phone" aria-hidden="true"></i> 
                                <span class="m-r-5 m-l-5">{{$setting['mobile']->value }}</span>
                            </a>
                        @endif
                        @if($setting['email']->value !='')
                            <a class="m-r-5 m-l-5 prime-color" href="mailto:{{$setting['email']->value}}">
                                <i class="fa fa-envelope" aria-hidden="true"></i> 
                                <span class="m-r-5 m-l-5">{{$setting['email']->value}}</span>
                            </a>
                        @endif
                    </ul>
                    <div class="clearfix"></div>
                    
                        <!-- social icons -->
                    <ul class="social-icons m-t-10 m-b-0 f-s-17  pull-left">
                        @if($setting['facebook']->value != '')
                            <li>
                                <a href="{{$setting['facebook']->value}}" id="facebook"target="_blank">
                                    <i class="fab fa-facebook" id="facebook"></i>
                                </a>
                            </li>
                        @endif
                        @if($setting['twitter']->value != '')
                            <li>
                                <a href="{{$setting['twitter']->value}}" id="twitter" target="_blank">
                                    <i class="fab fa-twitter" id="twitter"></i>
                                </a>
                            </li>
                        @endif
                        @if($setting['youtube']->value != '')
                            <li>
                                <a href="{{$setting['youtube']->value}}" id="youtube" target="_blank">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </li>
                        @endif
                        @if($setting['linkedin']->value != '')
                            <li>
                                <a href="{{$setting['linkedin']->value}}" id="linkedin" target="_blank">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                        @endif
                        @if($setting['google']->value != '')
                            <li>
                                <a href="{{$setting['google']->value}}" id="google" target="_blank">
                                    <i class="fab fa-google-plus"></i>
                                </a>
                            </li>
                        @endif
                        @if($setting['instagram']->value != '')
                            <li>
                                <a href="{{$setting['instagram']->value}}" id="instagram" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                        @endif
                        @if($setting['pinterest']->value != '')
                            <li>
                                <a href="{{$setting['pinterest']->value}}" id="pinterest" target="_blank">
                                    <i class="fab fa-pinterest"></i>
                                </a>
                            </li>
                        @endif
                        @if($setting['skype']->value != '')
                            <li>
                                <a href="{{$setting['skype']->value}}" id="skype" target="_blank">
                                    <i class="fab fa-skype"></i>
                                </a>
                            </li>
                        @endif
                        @if($setting['snapchat']->value != '')
                            <li>
                                <a href="{{$setting['snapchat']->value}}" id="snapchat" target="_blank">
                                    <i class="fab fa-snapchat"></i>
                                </a>
                            </li>
                        @endif
                        @if($setting['mobile']->value !='')
                            <li>
                                <a href="https://api.whatsapp.com/send?phone={{$setting['mobile']->value }}" id="whatsapp" target="_blank">
                                    <i class="fab fa-whatsapp primary-color"></i>
                                </a>
                            </li>
                        @endif
                        {{-- <li>
                            <a href="{{ url('/SwitchLang') }}/{{trans('Site.Lang')}}">
                                {{trans('Site.SetLang')}}
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>
        <div class="menu prime-bg">
            <div class="container">
                <div class="header-menu">
                    <nav class="navbar navbar-expand-lg container p-0">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa fa-bars primary-color"></i>
                        </button>

                        <div class="collapse navbar-collapse " id="navbarSupportedContent">
                            <ul class="navbar-nav p-0">
                                <?php
                                    $headerMenu = \App\Menu::where('position', '=', 'header')
                                        ->latest()->first();
                                ?>
                                @if($headerMenu !='')
                                    <?php
                                        $headerLinks = \App\MenuItem::where('menu_id', '=', $headerMenu->id)
                                            ->where('item_id', '=', null)
                                            ->orderBy('number', 'asc')
                                            ->orderBy('id', 'desc')
                                            ->get();
                                        $firstHLinks = \App\MenuItem::where('menu_id', '=', $headerMenu->id)
                                            ->where('item_id', '=', null)
                                            ->orderBy('number', 'asc')
                                            ->orderBy('id', 'desc')
                                            ->take(7)->get();
                                        $firstHLinks_arr = $firstHLinks->pluck('id')->toArray();

                                        $lastHLinks = \App\MenuItem::where('menu_id', '=', $headerMenu->id)
                                            ->where('item_id', '=', null)
                                            ->orderBy('number', 'asc')
                                            ->orderBy('id', 'desc')
                                            ->whereNotIn('id', $firstHLinks_arr)->get();
                                    ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{url('/')}}">
                                                {{trans('Site.SiteHomePage')}}
                                                @if(isset($Active) && $Active == 'Home')
                                                    <span class="sr-only">(current)</span>
                                                @endif
                                            </a>
                                        </li>
                                        @foreach($firstHLinks as $firstHLink)
                                            <?php
                                                $firstHLinkItems = \App\MenuItem::where('item_id', '=', $firstHLink->id)
                                                    ->orderBy('number', 'asc')
                                                    ->orderBy('id', 'get')
                                                    ->get();
                                                if ($firstHLink->type == 'page') {
                                                    $firstHPage = \App\StaticPage::find($firstHLink->linked_id);
                                                    $firstHBaseLink = url('/Pages/' . $firstHPage->id . '/' . $firstHPage->slug);
                                                } elseif ($firstHLink->type == 'category') {
                                                    $firstHCategory = \App\Category::find($firstHLink->linked_id);

                                                    $firstHBaseLink = url('/Categories/' . $firstHCategory->id . '/' . $firstHCategory->slug);
                                                } elseif ($firstHLink->type == 'article') {
                                                    $firstHArticle = \App\Article::find($firstHLink->linked_id);
                                                    $firstHBaseLink = url('/Articles/' . $firstHArticle->id . '/' . $firstHArticle->slug);
                                                } elseif ($firstHLink->type == 'activities') {
                                                    $firstHBaseLink = url('/Activities');
                                                } elseif ($firstHLink->type == 'photos') {
                                                    $firstHBaseLink = url('/photos');
                                                } elseif ($firstHLink->type == 'videos') {
                                                    $firstHBaseLink = url('/videos');
                                                } elseif ($firstHLink->type == 'career') {
                                                    $firstHBaseLink = url('/career');
                                                } elseif ($firstHLink->type == 'Services') {
                                                    $firstHBaseLink = url('/Cources/الدورات-التدريبية');
                                                } elseif ($firstHLink->type == 'about') {
                                                    $firstHBaseLink = url('/about');
                                                } elseif ($firstHLink->type == 'contact') {
                                                    $firstHBaseLink = url('/contact');
                                                } elseif ($firstHLink->type == 'TeamWork') {
                                                    $firstHBaseLink = url('/Parteners/TeamMember');
                                                } elseif ($firstHLink->type == 'Centers') {
                                                    $firstHBaseLink = url('/Parteners/Center');
                                                } elseif ($firstHLink->type == 'Clients') {
                                                    $firstHBaseLink = url('/Parteners/Clients');
                                                } elseif ($firstHLink->type == 'Certificate') {
                                                    $firstHBaseLink = url('/Parteners/Certificate');
                                                } else {
                                                    $firstHBaseLink = $firstHLink->external_link;
                                                }

                                            ?>

                                            @if(count($firstHLinkItems)  == 0)
                                                <li class="nav-item">
                                                    <a class="nav-link" href="{{$firstHBaseLink}}">{{$firstHLink['name_'.Session::get('Lang')]}}</a>
                                                </li>
                                            @else
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" href="{{$firstHBaseLink}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{$firstHLink['name_'.Session::get('Lang')]}}
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                        @foreach($firstHLinkItems as $firstHLinkItem)
                                                            <?php
                                                                $firstHLinkItems2 = \App\MenuItem::where('item_id', '=', $firstHLinkItem->id)
                                                                    ->orderBy('number', 'asc')
                                                                    ->orderBy('id', 'get')
                                                                    ->get();
                                                                if ($firstHLinkItem->type == 'page') {
                                                                    $firstHPage = \App\StaticPage::find($firstHLinkItem->linked_id);
                                                                    $FHItemBaseLink = url('/Pages/' . $firstHPage->id . '/' . $firstHPage->slug);
                                                                } elseif ($firstHLinkItem->type == 'category') {
                                                                    $firstHCategory = \App\Category::find($firstHLinkItem->linked_id);

                                                                    $FHItemBaseLink = url('/Categories/' . $firstHCategory->id . '/' . $firstHCategory->slug);
                                                                } elseif ($firstHLinkItem->type == 'article') {
                                                                    $firstHArticle = \App\Article::find($firstHLinkItem->linked_id);
                                                                    $FHItemBaseLink = url('/Articles/' . $firstHArticle->id . '/' . $firstHArticle->slug);
                                                                } elseif ($firstHLinkItem->type == 'activities') {
                                                                    $FHItemBaseLink = url('/Activities');
                                                                } elseif ($firstHLinkItem->type == 'photos') {
                                                                    $FHItemBaseLink = url('/photos');
                                                                } elseif ($firstHLinkItem->type == 'videos') {
                                                                    $FHItemBaseLink = url('/videos');
                                                                } elseif ($firstHLinkItem->type == 'career') {
                                                                    $FHItemBaseLink = url('/career');
                                                                } elseif ($firstHLinkItem->type == 'Services') {
                                                                    $FHItemBaseLink = url('/Cources/الدورات-التدريبية');
                                                                } elseif ($firstHLinkItem->type == 'about') {
                                                                    $FHItemBaseLink = url('/about');
                                                                } elseif ($firstHLinkItem->type == 'contact') {
                                                                    $FHItemBaseLink = url('/contact');
                                                                } elseif ($firstHLinkItem->type == 'TeamWork') {
                                                                    $FHItemBaseLink = url('/TeamWork');
                                                                } elseif ($firstHLinkItem->type == 'Centers') {
                                                                    $FHItemBaseLink = url('/Parteners/Center');
                                                                } elseif ($firstHLinkItem->type == 'Clients') {
                                                                    $FHItemBaseLink = url('/Parteners/Clients');
                                                                } elseif ($firstHLinkItem->type == 'Certificate') {
                                                                    $FHItemBaseLink = url('/Parteners/Certificate');
                                                                } else {
                                                                    $FHItemBaseLink = $firstHLinkItem->external_link;
                                                                }

                                                            ?>

                                                            @if(count($firstHLinkItems2)  == 0)
                                                                <a href="{{$FHItemBaseLink}}" class="dropdown-item">{{$firstHLinkItem['name_'.Session::get('Lang')]}}</a>
                                                            @else
                                                                <li class="sub-item">
                                                                    <a class="nav-link" href="{{$firstHBaseLink}}">
                                                                        fff{{$firstHLinkItem['name_'.Session::get('Lang')]}}
                                                                        <i class="fas fa-angle-down m-r-5 f-s-14"></i>
                                                                    </a>
                                                                    <ul class="sub-list">
                                                                        <ul class="p-0 m-b-20">
                                                                            @foreach($firstHLinkItems2 as $firstHLinkItem2)
                                                                                <?php
                                                                                    if ($firstHLinkItem2->type == 'page') {
                                                                                        $FHItemPage = \App\StaticPage::find($firstHLinkItem2->linked_id);
                                                                                        $FHItemBaseLink2 = url('/Pages/' . $FHItemPage->id . '/' . $FHItemPage->slug);
                                                                                    } elseif ($firstHLinkItem2->type == 'category') {
                                                                                        $FHItemCategory = \App\Category::find($firstHLinkItem2->linked_id);

                                                                                        $FHItemBaseLink2 = url('/Categories/' . $FHItemCategory->id . '/' . $FHItemCategory->slug);
                                                                                    } elseif ($firstHLinkItem2->type == 'article') {
                                                                                        $FHItemArticle = \App\Article::find($firstHLinkItem2->linked_id);
                                                                                        $FHItemBaseLink2 = url('/Articles/' . $FHItemArticle->id . '/' . $FHItemArticle->slug);
                                                                                    } elseif ($firstHLinkItem2->type == 'activities') {
                                                                                        $FHItemBaseLink2 = url('/Activities');
                                                                                    } elseif ($firstHLinkItem2->type == 'photos') {
                                                                                        $FHItemBaseLink2 = url('/photos');
                                                                                    } elseif ($firstHLinkItem2->type == 'videos') {
                                                                                        $FHItemBaseLink2 = url('/videos');
                                                                                    } elseif ($firstHLinkItem2->type == 'career') {
                                                                                        $FHItemBaseLink2 = url('/career');
                                                                                    } elseif ($firstHLinkItem2->type == 'consultancies') {
                                                                                        $FHItemBaseLink2 = url('/consultancies');
                                                                                    } elseif ($firstHLinkItem2->type == 'about') {
                                                                                        $FHItemBaseLink2 = url('/about');
                                                                                    } elseif ($firstHLinkItem2->type == 'contact') {
                                                                                        $FHItemBaseLink2 = url('/contact');
                                                                                    } elseif ($firstHLinkItem2->type == 'attend') {
                                                                                        $FHItemBaseLink2 = url('/attend');
                                                                                    } elseif ($firstHLinkItem2->type == 'BookStand') {
                                                                                        $FHItemBaseLink2 = url('/BookStand');
                                                                                    } else {
                                                                                        $FHItemBaseLink2 = $firstHLinkItem2->external_link;
                                                                                    }
                                                                                ?>
                                                                                <li>
                                                                                    <a href="{{$FHItemBaseLink2}}">{{$firstHLinkItem2['name_'.Session::get('Lang')]}}</a>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </ul>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </li>
                                            @endif
                                        @endforeach

                                @else
                                    <li class="nav-item active">
                                        <a class="nav-link" href="{{URL::to('/')}}">
                                            الرئيسية
                                            <span class="sr-only">(current)</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="page.php">عن الشركة</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            الدورات التدريبية
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <a class="dropdown-item" href="archive.php">قسم</a>
                                            <a class="dropdown-item" href="archive.php">قسم</a>
                                            <a class="dropdown-item" href="archive.php">قسم</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            المركز الإعلامي 
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="albums.php">الصور</a>
                                        <a class="dropdown-item" href="videos.php">الفيديو</a>
                                        <a class="dropdown-item" href="blog.php">المقالات</a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            شركاء النجاح
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="#">مراكز صديقة </a>
                                        <a class="dropdown-item" href="#">عملائنا</a>
                                        <a class="dropdown-item" href="#">الإعتمادات</a>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="contact.php">فريق العمل </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="archive-blog.php">التوظيف</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="contact.php">إتصل بنا</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="EN/{{URL::to('/')}}">EN</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="responsive-menu clearfix">
                    <div id="mySidenav" class="sidenav">
                        <a href="javascript:void(0)" class="closebtn font-color" onclick="closeNav()">&times;</a>
                        <ul class="navbar-nav p-0">
                            <?php
                                $headerMenu = \App\Menu::where('position', '=', 'header')
                                    ->latest()->first();
                            ?>
                            @if($headerMenu !='')
                                <?php
                                    $headerLinks = \App\MenuItem::where('menu_id', '=', $headerMenu->id)
                                        ->where('item_id', '=', null)
                                        ->orderBy('number', 'asc')
                                        ->orderBy('id', 'desc')
                                        ->get();
                                    $firstHLinks = \App\MenuItem::where('menu_id', '=', $headerMenu->id)
                                        ->where('item_id', '=', null)
                                        ->orderBy('number', 'asc')
                                        ->orderBy('id', 'desc')
                                        ->take(7)->get();
                                    $firstHLinks_arr = $firstHLinks->pluck('id')->toArray();

                                    $lastHLinks = \App\MenuItem::where('menu_id', '=', $headerMenu->id)
                                        ->where('item_id', '=', null)
                                        ->orderBy('number', 'asc')
                                        ->orderBy('id', 'desc')
                                        ->whereNotIn('id', $firstHLinks_arr)->get();
                                ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{url('/')}}">
                                            {{trans('Site.SiteHomePage')}}
                                            @if(isset($Active) && $Active == 'Home')
                                                <span class="sr-only">(current)</span>
                                            @endif
                                        </a>
                                    </li>
                                    @foreach($firstHLinks as $firstHLink)
                                        <?php
                                            $firstHLinkItems = \App\MenuItem::where('item_id', '=', $firstHLink->id)
                                                ->orderBy('number', 'asc')
                                                ->orderBy('id', 'get')
                                                ->get();
                                            if ($firstHLink->type == 'page') {
                                                $firstHPage = \App\StaticPage::find($firstHLink->linked_id);
                                                $firstHBaseLink = url('/Pages/' . $firstHPage->id . '/' . $firstHPage->slug);
                                            } elseif ($firstHLink->type == 'category') {
                                                $firstHCategory = \App\Category::find($firstHLink->linked_id);

                                                $firstHBaseLink = url('/Categories/' . $firstHCategory->id . '/' . $firstHCategory->slug);
                                            } elseif ($firstHLink->type == 'article') {
                                                $firstHArticle = \App\Article::find($firstHLink->linked_id);
                                                $firstHBaseLink = url('/Articles/' . $firstHArticle->id . '/' . $firstHArticle->slug);
                                            } elseif ($firstHLink->type == 'activities') {
                                                $firstHBaseLink = url('/Activities');
                                            } elseif ($firstHLink->type == 'photos') {
                                                $firstHBaseLink = url('/photos');
                                            } elseif ($firstHLink->type == 'videos') {
                                                $firstHBaseLink = url('/videos');
                                            } elseif ($firstHLink->type == 'career') {
                                                $firstHBaseLink = url('/career');
                                            } elseif ($firstHLink->type == 'Services') {
                                                $firstHBaseLink = url('/Cources/الدورات-التدريبية');
                                            } elseif ($firstHLink->type == 'about') {
                                                $firstHBaseLink = url('/about');
                                            } elseif ($firstHLink->type == 'contact') {
                                                $firstHBaseLink = url('/contact');
                                            } elseif ($firstHLink->type == 'TeamWork') {
                                                $firstHBaseLink = url('/Parteners/TeamMember');
                                            } elseif ($firstHLink->type == 'Centers') {
                                                $firstHBaseLink = url('/Parteners/Center');
                                            } elseif ($firstHLink->type == 'Clients') {
                                                $firstHBaseLink = url('/Parteners/Clients');
                                            } elseif ($firstHLink->type == 'Certificate') {
                                                $firstHBaseLink = url('/Parteners/Certificate');
                                            } else {
                                                $firstHBaseLink = $firstHLink->external_link;
                                            }

                                        ?>

                                        @if(count($firstHLinkItems)  == 0)
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{$firstHBaseLink}}">{{$firstHLink['name_'.Session::get('Lang')]}}</a>
                                            </li>
                                        @else
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="{{$firstHBaseLink}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    {{$firstHLink['name_'.Session::get('Lang')]}}
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                    @foreach($firstHLinkItems as $firstHLinkItem)
                                                        <?php
                                                            $firstHLinkItems2 = \App\MenuItem::where('item_id', '=', $firstHLinkItem->id)
                                                                ->orderBy('number', 'asc')
                                                                ->orderBy('id', 'get')
                                                                ->get();
                                                            if ($firstHLinkItem->type == 'page') {
                                                                $firstHPage = \App\StaticPage::find($firstHLinkItem->linked_id);
                                                                $FHItemBaseLink = url('/Pages/' . $firstHPage->id . '/' . $firstHPage->slug);
                                                            } elseif ($firstHLinkItem->type == 'category') {
                                                                $firstHCategory = \App\Category::find($firstHLinkItem->linked_id);

                                                                $FHItemBaseLink = url('/Categories/' . $firstHCategory->id . '/' . $firstHCategory->slug);
                                                            } elseif ($firstHLinkItem->type == 'article') {
                                                                $firstHArticle = \App\Article::find($firstHLinkItem->linked_id);
                                                                $FHItemBaseLink = url('/Articles/' . $firstHArticle->id . '/' . $firstHArticle->slug);
                                                            } elseif ($firstHLinkItem->type == 'activities') {
                                                                $FHItemBaseLink = url('/Activities');
                                                            } elseif ($firstHLinkItem->type == 'photos') {
                                                                $FHItemBaseLink = url('/photos');
                                                            } elseif ($firstHLinkItem->type == 'videos') {
                                                                $FHItemBaseLink = url('/videos');
                                                            } elseif ($firstHLinkItem->type == 'career') {
                                                                $FHItemBaseLink = url('/career');
                                                            } elseif ($firstHLinkItem->type == 'Services') {
                                                                $FHItemBaseLink = url('/Cources/الدورات-التدريبية');
                                                            } elseif ($firstHLinkItem->type == 'about') {
                                                                $FHItemBaseLink = url('/about');
                                                            } elseif ($firstHLinkItem->type == 'contact') {
                                                                $FHItemBaseLink = url('/contact');
                                                            } elseif ($firstHLinkItem->type == 'TeamWork') {
                                                                $FHItemBaseLink = url('/TeamWork');
                                                            } elseif ($firstHLinkItem->type == 'Centers') {
                                                                $FHItemBaseLink = url('/Parteners/Center');
                                                            } elseif ($firstHLinkItem->type == 'Clients') {
                                                                $FHItemBaseLink = url('/Parteners/Clients');
                                                            } elseif ($firstHLinkItem->type == 'Certificate') {
                                                                $FHItemBaseLink = url('/Parteners/Certificate');
                                                            } else {
                                                                $FHItemBaseLink = $firstHLinkItem->external_link;
                                                            }

                                                        ?>

                                                        @if(count($firstHLinkItems2)  == 0)
                                                            <a href="{{$FHItemBaseLink}}" class="dropdown-item">{{$firstHLinkItem['name_'.Session::get('Lang')]}}</a>
                                                        @else
                                                            <li class="sub-item">
                                                                <a class="nav-link" href="{{$firstHBaseLink}}">
                                                                    fff{{$firstHLinkItem['name_'.Session::get('Lang')]}}
                                                                    <i class="fas fa-angle-down m-r-5 f-s-14"></i>
                                                                </a>
                                                                <ul class="sub-list">
                                                                    <ul class="p-0 m-b-20">
                                                                        @foreach($firstHLinkItems2 as $firstHLinkItem2)
                                                                            <?php
                                                                                if ($firstHLinkItem2->type == 'page') {
                                                                                    $FHItemPage = \App\StaticPage::find($firstHLinkItem2->linked_id);
                                                                                    $FHItemBaseLink2 = url('/Pages/' . $FHItemPage->id . '/' . $FHItemPage->slug);
                                                                                } elseif ($firstHLinkItem2->type == 'category') {
                                                                                    $FHItemCategory = \App\Category::find($firstHLinkItem2->linked_id);

                                                                                    $FHItemBaseLink2 = url('/Categories/' . $FHItemCategory->id . '/' . $FHItemCategory->slug);
                                                                                } elseif ($firstHLinkItem2->type == 'article') {
                                                                                    $FHItemArticle = \App\Article::find($firstHLinkItem2->linked_id);
                                                                                    $FHItemBaseLink2 = url('/Articles/' . $FHItemArticle->id . '/' . $FHItemArticle->slug);
                                                                                } elseif ($firstHLinkItem2->type == 'activities') {
                                                                                    $FHItemBaseLink2 = url('/Activities');
                                                                                } elseif ($firstHLinkItem2->type == 'photos') {
                                                                                    $FHItemBaseLink2 = url('/photos');
                                                                                } elseif ($firstHLinkItem2->type == 'videos') {
                                                                                    $FHItemBaseLink2 = url('/videos');
                                                                                } elseif ($firstHLinkItem2->type == 'career') {
                                                                                    $FHItemBaseLink2 = url('/career');
                                                                                } elseif ($firstHLinkItem2->type == 'consultancies') {
                                                                                    $FHItemBaseLink2 = url('/consultancies');
                                                                                } elseif ($firstHLinkItem2->type == 'about') {
                                                                                    $FHItemBaseLink2 = url('/about');
                                                                                } elseif ($firstHLinkItem2->type == 'contact') {
                                                                                    $FHItemBaseLink2 = url('/contact');
                                                                                } elseif ($firstHLinkItem2->type == 'attend') {
                                                                                    $FHItemBaseLink2 = url('/attend');
                                                                                } elseif ($firstHLinkItem2->type == 'BookStand') {
                                                                                    $FHItemBaseLink2 = url('/BookStand');
                                                                                } else {
                                                                                    $FHItemBaseLink2 = $firstHLinkItem2->external_link;
                                                                                }
                                                                            ?>
                                                                            <li>
                                                                                <a href="{{$FHItemBaseLink2}}">{{$firstHLinkItem2['name_'.Session::get('Lang')]}}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </ul>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach

                            @else
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{URL::to('/')}}">
                                        الرئيسية
                                        <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="page.php">عن الشركة</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        الدورات التدريبية
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="archive.php">قسم</a>
                                        <a class="dropdown-item" href="archive.php">قسم</a>
                                        <a class="dropdown-item" href="archive.php">قسم</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        المركز الإعلامي 
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="albums.php">الصور</a>
                                    <a class="dropdown-item" href="videos.php">الفيديو</a>
                                    <a class="dropdown-item" href="blog.php">المقالات</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        شركاء النجاح
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="#">مراكز صديقة </a>
                                    <a class="dropdown-item" href="#">عملائنا</a>
                                    <a class="dropdown-item" href="#">الإعتمادات</a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.php">فريق العمل </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="archive-blog.php">التوظيف</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.php">إتصل بنا</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="EN/{{URL::to('/')}}">EN</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                
                    <span class="close-btn text-white float-right m-l-15 m-r-15" onclick="openNav()">&#9776;</span>
                    
                    <div class="clearfix"></div>
                   
                </div>
            </div>
            <!-- #END# Menu -->

            </div>
        </div>
    </header>
<!-- #END# header-->
