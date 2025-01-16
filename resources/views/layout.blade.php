<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Project 2 - {{ $title }}</title>
        <meta name="description" content="Web Technologies Project 2">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous">
        <style>
            body {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
                margin: 0;
            }
            main.container {
                flex: 1;
            }
            footer {
                flex-shrink: 0;
            }
        </style>
    </head>

    <body>

    <nav class="navbar navbar-expand-lg text-bg-dark mb-3" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="40"
                    height="40"
                    viewBox="0 0 24 24"
                    style="fill: rgb(255, 255, 255, 1); margin-right: 8px;">
                    <path d="M13.4 2.096a10.08 10.08 0 0 0-8.937 3.331A10.054 10.054 0 0 0 2.096 13.4c.53 3.894 3.458 7.207 7.285 8.246a9.982 9.982 0 0 0 2.618.354l.142-.001a3.001 3.001 0 0 0 2.516-1.426 2.989 2.989 0 0 0 .153-2.879l-.199-.416a1.919 1.919 0 0 1 .094-1.912 2.004 2.004 0 0 1 2.576-.755l.412.197c.412.198.85.299 1.301.299A3.022 3.022 0 0 0 22 12.14a9.935 9.935 0 0 0-.353-2.76c-1.04-3.826-4.353-6.754-8.247-7.284zm5.158 10.909-.412-.197c-1.828-.878-4.07-.198-5.135 1.494-.738 1.176-.813 2.576-.204 3.842l.199.416a.983.983 0 0 1-.051.961.992.992 0 0 1-.844.479h-.112a8.061 8.061 0 0 1-2.095-.283c-3.063-.831-5.403-3.479-5.826-6.586-.321-2.355.352-4.623 1.893-6.389a8.002 8.002 0 0 1 7.16-2.664c3.107.423 5.755 2.764 6.586 5.826.198.73.293 1.474.282 2.207-.012.807-.845 1.183-1.441.894z"></path>
                    <circle cx="7.5" cy="14.5" r="1.5"></circle>
                    <circle cx="7.5" cy="10.5" r="1.5"></circle>
                    <circle cx="10.5" cy="7.5" r="1.5"></circle>
                    <circle cx="14.5" cy="7.5" r="1.5"></circle>
                </svg>
                Painting Catalog
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                   <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                   </li>

                    @if(Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" href="/paintings">Paintings</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/artists">Artists</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/styles">Styles</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/locations">Locations</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/logout">Log out</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Authentication</a>
                        </li>
                    @endif

                </ul>

            </div>
        </div>
    </nav>

    <main class="container">
        <div class="row">
            <div class="col">
                @yield('content')
            </div>
        </div>
    </main>
    <footer class="text-bg-dark mt-3">
        <div class="container">
            <div class="row py-5">
                <div class="col">
                    V. Cirša, 2025
                </div>
            </div>
        </div>
    </footer>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous">
    </script>
    <script src="/js/admin.js"></script>
    </body>


</html>
