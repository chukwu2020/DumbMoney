@extends('layout.app')

@section('content')

<div class="max-w-5xl mx-auto px-6 py-16 text-gray-800">

    <!-- PAGE HEADER -->
    <div class="text-center mb-14">
        <h1 class="text-3xl font-bold">Legal Information</h1>
        <p class="text-gray-500 text-sm mt-2">
            Please review our Privacy Policy and Terms & Conditions carefully.
        </p>
    </div>

    <!-- QUICK NAV LINKS -->
    <div class="flex justify-center gap-8 mb-16 text-sm font-semibold">
        <a href="#privacy" class="text-[#8bc905] hover:underline">Privacy Policy</a>
        <a href="#terms" class="text-[#8bc905] hover:underline">Terms & Conditions</a>
    </div>

    <!-- ================= PRIVACY POLICY ================= -->
    <section id="privacy" class="scroll-mt-28 mb-24">
        <h2 class="text-2xl font-bold text-[#8bc905] mb-3">Privacy Policy</h2>
        <p class="text-sm text-gray-500 mb-8">Effective Date: December 16, 2025</p>

        <div class="space-y-8 text-sm leading-relaxed">

            <p>
                MarketMind Investment (“we”, “our”, or “us”) is committed to protecting your privacy...
            </p>

            <div>
                <h3 class="font-semibold mb-2">1. Information We Collect</h3>
                <ul class="list-disc ml-6 space-y-1">
                    <li>Full name</li>
                    <li>Email address</li>
                    <li>Phone number</li>
                    <li>Government-issued identification</li>
                </ul>
                <p class="mt-2">We do not collect trading logins or private wallet keys.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">2. Purpose of Data Collection</h3>
                <p>Account management, fraud prevention, communication, platform improvement, and compliance.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">3. Use & Protection of Identification Documents</h3>
                <p>Used strictly for verification, stored securely, never sold.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">4. Information Sharing</h3>
                <p>Shared only with trusted service providers, verification partners, or legal authorities when required.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">5. Trading & Regulatory Disclaimer</h3>
                <p>Educational platform only. Not a broker, advisor, or fund manager.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">6. Data Security</h3>
                <p>We use reasonable security measures but cannot guarantee absolute protection.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">7. Data Retention</h3>
                <p>Data retained only as long as necessary for legal and operational reasons.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">8. User Rights</h3>
                <p>You may request access, correction, deletion, restriction, or withdrawal of consent.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">9. Age Requirement</h3>
                <p>Users must be 16 years or older.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">10. International Use</h3>
                <p>Your data may be processed in different jurisdictions.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">11. Changes to Policy</h3>
                <p>Updates will be posted on this page.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">12. Governing Law</h3>
                <p>Subject to international principles and applicable local laws.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">13. Contact</h3>
                <p>Email: officialmarketmind@gmail.com</p>
            </div>

        </div>
    </section>


    <!-- ================= TERMS ================= -->
    <section id="terms" class="scroll-mt-28">
        <h2 class="text-2xl font-bold text-[#8bc905] mb-3">Terms & Conditions</h2>
        <p class="text-sm text-gray-500 mb-8">Effective Date: December 16, 2025</p>

        <div class="space-y-8 text-sm leading-relaxed">

            <div>
                <h3 class="font-semibold mb-2">1. Nature of the Platform</h3>
                <p>Educational and analytical platform only.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">2. Eligibility</h3>
                <p>Users must be 16+ and comply with local laws.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">3. Account Registration & Verification</h3>
                <p>Accurate information required for verification.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">4. Risk Acknowledgment</h3>
                <p>Trading involves risk. No profit guarantees.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">5. No Investment Advice</h3>
                <p>All content is educational only.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">6. User Responsibilities</h3>
                <p>Users are responsible for their decisions and legal compliance.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">7. Prohibited Conduct</h3>
                <p>No fraud, misrepresentation, or security breaches.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">8. Platform Availability</h3>
                <p>Service interruptions may occur.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">9. Limitation of Liability</h3>
                <p>We are not liable for trading losses or user decisions.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">10. Intellectual Property</h3>
                <p>All content is protected by international IP laws.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">11. Suspension & Termination</h3>
                <p>Access may be terminated for violations or legal reasons.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">12. Changes to Terms</h3>
                <p>Terms may be updated at any time.</p>
            </div>

            <div>
                <h3 class="font-semibold mb-2">13. Contact</h3>
                <p>Email: officialmarketmind@gmail.com</p>
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
