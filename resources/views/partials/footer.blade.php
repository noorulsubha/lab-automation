{{-- =========================================
     FOOTER
========================================= --}}
<footer class="footer">

    <div class="footer-grid">

        {{-- ABOUT --}}
        <div>
            <h4>SRS LabAuto</h4>
            <p>
                Electrical product testing system<br>
                for SRS Electrical Appliances.
            </p>
        </div>

        {{-- LINKS --}}
        <div>
            <h4>Quick Links</h4>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
        </div>

        {{-- CONTACT --}}
        <div>
            <h4>Contact</h4>
            <p>info@srselectrical.com</p>
            <p>+92 322-2510688</p>
        </div>

    </div>

    <div class="footer-bottom">
        © {{ date('Y') }} SRS Electrical Appliances
    </div>

</footer>