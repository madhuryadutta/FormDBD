@extends('layouts.business')

@section('title', 'YourSaaSStartup')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-blue-500 to-indigo-500 py-24 text-white">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-center">
            <div class="max-w-3xl text-center">
                <h1 class="text-4xl font-bold mb-4">Streamline Your Form Submissions</h1>
                <p class="text-lg mb-6">Effortlessly manage form submissions with our hosted solutions, self-hosted options, API integrations, and powerful analytics.</p>
                <a href="#pricing" class="bg-white text-indigo-500 hover:bg-indigo-500 hover:text-white py-2 px-6 rounded-full shadow-lg">Get Started</a>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-20">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8 text-center text-gray-200">Features</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Feature Item 1 -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4 text-gray-200">Hosted Form Submissions</h3>
                <p class="text-gray-400">Easily manage and host your form submissions on our secure servers, ensuring reliability and ease of use.</p>
            </div>
            <!-- Feature Item 2 -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4 text-gray-200">Self-Hosted Solutions</h3>
                <p class="text-gray-400">Prefer to manage everything yourself? Our self-hosted solutions give you full control over your data and infrastructure.</p>
            </div>
            <!-- Feature Item 3 -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4 text-gray-200">API Hit Submissions</h3>
                <p class="text-gray-400">Integrate with our robust API to submit and manage form data programmatically, enhancing your workflow automation.</p>
            </div>
            <!-- Feature Item 4 -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4 text-gray-200">Advanced Analytics</h3>
                <p class="text-gray-400">Leverage powerful analytics to gain insights into your form submissions, helping you make data-driven decisions.</p>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section id="pricing" class="bg-gray-800 py-20">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8 text-center text-gray-200">Pricing</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Pricing Plan 1 -->
            <div class="bg-gray-900 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4 text-gray-200">Starter</h3>
                <p class="text-4xl font-bold text-indigo-600 mb-4">$99<span class="text-lg font-normal text-gray-400">/mo</span></p>
                <ul class="text-gray-400 mb-4">
                    <li class="mb-2">Basic Form Hosting</li>
                    <li class="mb-2">Email Support</li>
                    <li>Single User</li>
                </ul>
                <a href="#" class="block bg-indigo-600 text-white py-2 px-6 rounded-full text-center hover:bg-indigo-700">Get Started</a>
            </div>
            <!-- Pricing Plan 2 -->
            <div class="bg-gray-900 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4 text-gray-200">Professional</h3>
                <p class="text-4xl font-bold text-indigo-600 mb-4">$199<span class="text-lg font-normal text-gray-400">/mo</span></p>
                <ul class="text-gray-400 mb-4">
                    <li class="mb-2">Advanced Form Hosting</li>
                    <li class="mb-2">Priority Support</li>
                    <li class="mb-2">Multiple Users</li>
                    <li>API Access</li>
                </ul>
                <a href="#" class="block bg-indigo-600 text-white py-2 px-6 rounded-full text-center hover:bg-indigo-700">Get Started</a>
            </div>
            <!-- Pricing Plan 3 -->
            <div class="bg-gray-900 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4 text-gray-200">Enterprise</h3>
                <p class="text-4xl font-bold text-indigo-600 mb-4">$399<span class="text-lg font-normal text-gray-400">/mo</span></p>
                <ul class="text-gray-400 mb-4">
                    <li class="mb-2">Full Suite of Tools</li>
                    <li class="mb-2">Dedicated Support</li>
                    <li class="mb-2">Unlimited Users</li>
                    <li class="mb-2">Custom Integrations</li>
                    <li>Data Migration Assistance</li>
                </ul>
                <a href="#" class="block bg-indigo-600 text-white py-2 px-6 rounded-full text-center hover:bg-indigo-700">Get Started</a>
            </div>
        </div>
    </div>
</section>

<!-- Data Security Section -->
<section class="py-20">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8 text-center text-gray-200">Data Security</h2>
        <div class="flex items-center justify-center">
            <div class="max-w-3xl text-center">
                <p class="text-lg text-gray-400">We prioritize data security with state-of-the-art encryption and secure protocols. Your data is safe with us.</p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="bg-gray-800 py-20">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8 text-center text-gray-200">Our Team</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Team Member 1 -->
            <div class="bg-gray-900 p-6 rounded-lg shadow-md">
                <div class="flex items-center justify-center mb-4">
                    <img src="https://via.placeholder.com/150" alt="John Doe" class="w-20 h-20 rounded-full">
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-200">John Doe</h3>
                <p class="text-gray-400">CEO & Co-founder</p>
            </div>
            <!-- Team Member 2 -->
            <div class="bg-gray-900 p-6 rounded-lg shadow-md">
                <div class="flex items-center justify-center mb-4">
                    <img src="https://via.placeholder.com/150" alt="Jane Smith" class="w-20 h-20 rounded-full">
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-200">Jane Smith</h3>
                <p class="text-gray-400">CTO</p>
            </div>
            <!-- Team Member 3 -->
            <div class="bg-gray-900 p-6 rounded-lg shadow-md">
                <div class="flex items-center justify-center mb-4">
                    <img src="https://via.placeholder.com/150" alt="Alex Johnson" class="w-20 h-20 rounded-full">
                </div>
                <h3 class="text-xl font-semibold mb-2 text-gray-200">Alex Johnson</h3>
                <p class="text-gray-400">Head of Marketing</p>
            </div>
        </div>
    </div>
</section>

<!-- About Us Section -->
<section id="about" class="py-20">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8 text-center text-gray-200">About Us</h2>
        <div class="flex items-center justify-center">
            <div class="max-w-3xl text-center">
                <p class="text-lg text-gray-400">We are a team of passionate professionals committed to revolutionizing the SaaS industry with innovative AI solutions. Our mission is to empower businesses by providing them with the tools they need to succeed in a competitive market.</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="bg-gray-800 py-20">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8 text-center text-gray-200">Contact Us</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-gray-900 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4 text-gray-200">Support</h3>
                <p class="text-gray-400">Have questions? Reach out to our support team at <a href="mailto:support@example.com" class="text-indigo-600 hover:underline">support@example.com</a>.</p>
            </div>
            <div class="bg-gray-900 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4 text-gray-200">Sales</h3>
                <p class="text-gray-400">Interested in our services? Contact our sales team at <a href="mailto:sales@example.com" class="text-indigo-600 hover:underline">sales@example.com</a>.</p>
            </div>
        </div>
    </div>
</section>
@endsection