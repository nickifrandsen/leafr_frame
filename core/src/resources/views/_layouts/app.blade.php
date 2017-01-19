<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/assets/css/leafr.core.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            ]); ?>
        </script>

    </head>
    <body>

        <div id="app">

            <div class="main-header">

                @include('leafr.core::_layouts.nav')

            </div> {{--  ends .main-header --}}


            <main class="is-primary">

                @if(!empty(Session::get('flash_notification')))
                    <div class="notification is-{{ Session::get('flash_notification.level') }} has-margin">
                        <button class="close"><i class="material-icons">close</i></button>
                        {{ Session::get('flash_notification.message')  }}
                    </div>
                @endif

                <header id="content-header">
                    @yield('content-header')
                </header>

                @yield('content')

            </main> {{-- ends main area --}}


        </div>

        <!-- Scripts -->
        <script src="/assets/js/leafr.core.js"></script>

        <script>
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        </script>
        @yield('scripts')

    </body>
    </html>
