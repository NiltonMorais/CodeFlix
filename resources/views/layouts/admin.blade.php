<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CodeFlix') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <?php
    $navbar = Navbar::withBrand(config('app.name', 'CodeFlix'), url('/'))->inverse();
    if (Auth::check()) {
        $arrayLinks = [
            ['link' => route('admin.users.index'), 'title' => 'Usuários'],
            ['link' => route('admin.categories.index'), 'title' => 'Categorias'],
        ];
        $arrayLinksRight = [
            [
                Auth::user()->name,
                [
                    [
                        'link' => route('admin.logout'),
                        'title' => 'Logout',
                        'linkAttributes' => [
                            'onclick'=>"event.preventDefault();document.getElementById(\"form-logout\").submit();"
                        ]
                    ],
                ]
            ],
        ];

        $menus = Navigation::links($arrayLinks);
        $menusRight = Navigation::links($arrayLinksRight)->right();

        $navbar->withContent($menus)->withContent($menusRight);
    }
    ?>

    {!! $navbar !!}

    <?php $formLogout = FormBuilder::plain([
        'id' => 'form-logout',
        'method' => 'POST',
        'style' => 'display:none',
        'route' => ['admin.logout']
    ]);?>
    {!! form($formLogout) !!}

    @if(Session::has('message'))
        <div class="container">
            {!! Alert::success(Session::get('message'))->close() !!}
        </div>
    @endif

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
