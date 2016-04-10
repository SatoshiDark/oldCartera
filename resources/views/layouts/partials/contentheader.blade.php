<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @yield('contentheader_title', 'Page Header here')
        <small>@yield('contentheader_description')</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> @yield('level_title', 'SIca')</a></li>
        <li class="active">@yield('here_title', 'Home')</li>
    </ol>
</section>