@section('content')
@extends('layout.user')
<div class="max-w-5xl mx-auto px-6 py-12 text-gray-800">

    <!-- PAGE TITLE -->
    <div class="mb-10 text-center">
        <h1 class="text-3xl font-bold">Legal Information</h1>
        <p class="text-gray-500 text-sm mt-2">
            Please review our Privacy Policy and Terms & Conditions carefully.
        </p>
    </div>

    <!-- QUICK NAV -->
    <div class="flex justify-center gap-6 mb-12 text-sm font-semibold">
        <a href="#privacy" class="text-[#8bc905] hover:underline">Privacy Policy</a>
        <a href="#terms" class="text-[#8bc905] hover:underline">Terms & Conditions</a>
    </div>

    <!-- ================= PRIVACY POLICY ================= -->
    <section id="privacy" class="scroll-mt-28 mb-20">
        <h2 class="text-2xl font-bold mb-4 text-[#8bc905]">Privacy Policy</h2>
        <p class="text-sm text-gray-500 mb-6">Effective Date: December 16, 2025</p>

        <div class="space-y-6 leading-relaxed text-sm">

            <p>MarketMind Investment (“we”, “our”, or “us”) is committed to protecting your privacy...</p>

            <div>
                <h3 class="font-semibold">1. Information We Collect</h3>
                <p>Full name, email address, phone number, government-issued ID for verification.</p>
            </div>

            <div>
                <h3 class="font-semibold">2. Purpose of Data Collection</h3>
                <p>Account management, fraud prevention, communication, compliance.</p>
            </div>

            <div>
                <h3 class="font-semibold">3. Use & Protection of Identification Documents</h3>
                <p>Used strictly for verification, stored securely, never sold.</p>
            </div>

            <div>
                <h3 class="font-semibold">4. Information Sharing</h3>
                <p>Only shared with security providers, verification partners, or legal authorities.</p>
            </div>

            <div>
                <h3 class="font-semibold">5. Trading & Regulatory Disclaimer</h3>
                <p>Educational platform only. Not a broker or investment advisor.</p>
            </div>

            <div>
                <h3 class="font-semibold">6. Data Security</h3>
                <p>We implement reasonable protection measures but cannot guarantee absolute security.</p>
            </div>

            <div>
                <h3 class="font-semibold">7. Data Retention</h3>
                <p>Data kept only as long as necessary for legal and operational needs.</p>
            </div>

            <div>
                <h3 class="font-semibold">8. User Rights</h3>
                <p>Access, correction, deletion, restriction, withdrawal of consent.</p>
            </div>

            <div>
                <h3 class="font-semibold">9. Age Requirement</h3>
                <p>Users must be 16+ years old.</p>
            </div>

            <div>
                <h3 class="font-semibold">10. International Use</h3>
                <p>Data may be processed in different jurisdictions.</p>
            </div>

            <div>
                <h3 class="font-semibold">11. Changes to Policy</h3>
                <p>Updates posted on the website.</p>
            </div>

            <div>
                <h3 class="font-semibold">12. Governing Law</h3>
                <p>Subject to international principles and local laws.</p>
            </div>

            <div>
                <h3 class="font-semibold">13. Contact</h3>
                <p>Email: officialmarketmind@gmail.com</p>
            </div>

        </div>
    </section>


    <!-- ================= TERMS ================= -->
    <section id="terms" class="scroll-mt-28">
        <h2 class="text-2xl font-bold mb-4 text-[#8bc905]">Terms & Conditions</h2>
        <p class="text-sm text-gray-500 mb-6">Effective Date: December 16, 2025</p>

        <div class="space-y-6 leading-relaxed text-sm">

            <div>
                <h3 class="font-semibold">1. Nature of the Platform</h3>
                <p>Educational and analytical platform only.</p>
            </div>

            <div>
                <h3 class="font-semibold">2. Eligibility</h3>
                <p>Users must be 16+ and comply with local laws.</p>
            </div>

            <div>
                <h3 class="font-semibold">3. Account Registration</h3>
                <p>Accurate information required for verification.</p>
            </div>

            <div>
                <h3 class="font-semibold">4. Risk Acknowledgment</h3>
                <p>Trading involves risk. No profit guarantees.</p>
            </div>

            <div>
                <h3 class="font-semibold">5. No Investment Advice</h3>
                <p>All content is educational only.</p>
            </div>

            <div>
                <h3 class="font-semibold">6. User Responsibilities</h3>
                <p>Users are responsible for their decisions and compliance.</p>
            </div>

            <div>
                <h3 class="font-semibold">7. Prohibited Conduct</h3>
                <p>No fraud, misrepresentation, or security compromise.</p>
            </div>

            <div>
                <h3 class="font-semibold">8. Platform Availability</h3>
                <p>Service may be interrupted for maintenance or external issues.</p>
            </div>

            <div>
                <h3 class="font-semibold">9. Limitation of Liability</h3>
                <p>Not liable for trading losses or decisions made.</p>
            </div>

            <div>
                <h3 class="font-semibold">10. Intellectual Property</h3>
                <p>All content is protected.</p>
            </div>

            <div>
                <h3 class="font-semibold">11. Suspension & Termination</h3>
                <p>Access may be terminated for violations.</p>
            </div>

            <div>
                <h3 class="font-semibold">12. Changes to Terms</h3>
                <p>Terms may be updated anytime.</p>
            </div>

            <div>
                <h3 class="font-semibold">13. Contact</h3>
                <p>Email: marketmindinvestments@gmail.com</p>
            </div>

        </div>
    </section>

</div>


<style>
html {
    scroll-behavior: smooth;
}
</style>
@endsection