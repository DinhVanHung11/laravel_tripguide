<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontend.head')
</head>
<body class="{{isset($bodyClass) ? $bodyClass : ''}}">
    <div class="page-wrapper">
        <div class="panel wrapper">
            @include('frontend.components.panel')
        </div>
        <header class="sticky top-0 left-0 page-header z-[90]">
            @if (session()->has('error'))
                <div class="page-message p-6 bg-[#FF543D] shadow-lg text-white">
                    {{ session()->get('error')  }}
                </div>
            @endif
            @include('frontend.components.header')
        </header>
        <main class="{{ isset($pageFullWidth) ? 'page-main-full-width' : 'page-main'}}">
            <div class="page-messages">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="columns">
                <div class="column-header">
                    @include('frontend.components.searchbar')
                </div>
                <div class="column main">
                    @yield('frontent.main')
                </div>
            </div>
        </main>
        <footer class="page-footer">
            @include('frontend.components.footer')
        </footer>
    </div>

    @if (!auth()->user())
        @include('frontend.components.modal-auth')
    @endif

    <script src="/js/app.js"></script>
    <script src="/js/checkout.js"></script>
    <script src="/js/payment.js"></script>
    @yield('frontent.js')
</body>
</html>
