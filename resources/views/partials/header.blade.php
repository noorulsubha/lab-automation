<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Character Encoding --}}
    <meta charset="UTF-8">

    {{-- Responsive Layout --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- =========================================
         SEO META TAGS
         Improve search engine visibility
    ========================================= --}}
    <meta name="description" content="SRS Lab Automation System for electrical product testing and management">
    <meta name="keywords" content="lab automation, testing system, SRS electrical, product testing, CPRI lab">

    {{-- =========================================
         PAGE TITLE
    ========================================= --}}
    <title>SRS LabAuto — @yield('title', 'www.srselectrical.com')</title>
   
    {{-- =========================================
         FAVICON (Browser Tab Icon)
    ========================================= --}}
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}">

    {{-- =========================================
         THIRD-PARTY FONTS & ICONS (CDNs)
    ========================================= --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    {{-- =========================================
         GLOBAL CSS LAYOUTS
    ========================================= --}}
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

    {{-- =========================================
         PAGE SPECIFIC CSS
         (Used in child pages via @push('styles'))
    ========================================= --}}
    @stack('styles')
</head>

<body>

    {{-- =========================================
         HEADER SECTION
    ========================================= --}}
    @include('partials.header')

    {{-- =========================================
         MAIN CONTENT AREA
         All page content loads here
    ========================================= --}}
    <main>
        @yield('content')
    </main>

    {{-- =========================================
         FOOTER SECTION
    ========================================= --}}
    @include('partials.footer')

    {{-- =========================================
         PAGE SPECIFIC SCRIPTS
         (Used in child pages via @push('scripts'))
    ========================================= --}}
    @stack('scripts')

</body>
</html>