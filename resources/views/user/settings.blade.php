@extends('layouts.app')

@section('content')
    <div class="settings">
        <div class="settings__tabs">
            <div class="tabs">

                <div class="tabs__head">
                    <a href="/settings/general" class="tab
                    @if ($activeTab == 'general')
                        tab_active
                    @endif
                    ">General</a>
                    <a href="/settings/account" class="tab
                    @if ($activeTab == 'account')
                        tab_active
                    @endif
                    ">Account</a>
                    <a href="/settings/notifications" class="tab
                    @if ($activeTab == 'notifications')
                        tab_active
                    @endif
                    ">Notifications</a>
                    <a href="/settings/blacklist" class="tab
                    @if ($activeTab == 'blacklist')
                        tab_active
                    @endif
                    ">Blacklist</a>
                </div>

                @if(session('success'))
                    <div class="alert alert_theme_success">
                        <svg class="alert__icon"><use xlink:href="/images/icon.svg#icon_alert"></use></svg>
                        <div class="alert__msg">{{session('success')}}</div>
                    </div>
                @endif

                <div class="tab-content
                @if ($activeTab == 'general')
                    tab-content_active
                @endif
                ">
                    @include('user.settings.general', ['errors'=>$errors, 'activeTab'=>$activeTab, 'user'=>$user])
                </div>
                <div class="tab-content
                @if ($activeTab == 'account')
                tab-content_active
                @endif">
                    <div class="tab-block">
                        @include('user.settings.account', ['errors'=>$errors, 'activeTab'=>$activeTab, 'user'=>$user, 'countries'=>$countries])
                    </div>
                </div>
                <div class="tab-content
                @if ($activeTab == 'notifications')
                tab-content_active
                @endif">
                    <div class="tab-block">
                        @include('user.settings.notifications', ['errors'=>$errors, 'activeTab'=>$activeTab, 'user'=>$user])
                    </div>
                </div>
                <div class="tab-content
                @if ($activeTab == 'blacklist')
                tab-content_active
                @endif">
                    <div class="tab-block">
                        @include('user.settings.blacklist', ['errors'=>$errors, 'activeTab'=>$activeTab, 'user'=>$user])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
