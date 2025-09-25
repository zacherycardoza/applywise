@extends('layouts.app')

@section('content')
<!-- Hero -->
<section class="relative bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-gray-800 dark:to-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-6 py-20 text-center">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-6">
            Land Your Next Job Faster with <span class="text-yellow-300">AI</span>
        </h1>
        <p class="text-lg md:text-xl max-w-2xl mx-auto mb-8 text-gray-100 dark:text-gray-300">
            Upload your resume, paste a job description, and let our AI give you a match score,
            strengths, weaknesses, and a tailored resume rewrite in seconds.
        </p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('register.index') }}"
               class="px-6 py-3 bg-yellow-400 text-gray-900 rounded-xl font-semibold hover:bg-yellow-300">
               Get Started Free
            </a>
            <a href="#features"
               class="px-6 py-3 border border-white rounded-xl font-semibold hover:bg-white hover:text-indigo-600">
               Learn More
            </a>
        </div>
    </div>
</section>

<!-- Features -->
<section id="features" class="max-w-7xl mx-auto px-6 py-20">
    <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Why Use Our Platform?</h2>
    <div class="grid md:grid-cols-3 gap-10">
        <div class="p-6 bg-gray-50 dark:bg-gray-800 rounded-2xl shadow hover:shadow-md">
            <h3 class="text-xl font-semibold mb-4">AI-Powered Match Score</h3>
            <p class="text-gray-600 dark:text-gray-300">See instantly how well your resume matches the job posting, scored from 0–100.</p>
        </div>
        <div class="p-6 bg-gray-50 dark:bg-gray-800 rounded-2xl shadow hover:shadow-md">
            <h3 class="text-xl font-semibold mb-4">Strengths & Weaknesses</h3>
            <p class="text-gray-600 dark:text-gray-300">Get clear insights on what recruiters will love and what’s holding you back.</p>
        </div>
        <div class="p-6 bg-gray-50 dark:bg-gray-800 rounded-2xl shadow hover:shadow-md">
            <h3 class="text-xl font-semibold mb-4">Resume & Cover Letter Rewrite</h3>
            <p class="text-gray-600 dark:text-gray-300">Generate improved resumes and tailored cover letters instantly with AI.</p>
        </div>
    </div>
</section>

<!-- Pricing -->
<section id="pricing" class="bg-gray-100 dark:bg-gray-800 py-20">
    <div class="max-w-5xl mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-12">Simple, Affordable Pricing</h2>
        <div class="grid md:grid-cols-3 gap-8">

            <!-- Free -->
            <div class="p-8 bg-white dark:bg-gray-900 rounded-2xl shadow hover:shadow-lg">
                <h3 class="text-xl font-bold mb-4">Free</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">Perfect to try it out</p>
                <p class="text-4xl font-extrabold mb-6">$0</p>
                <ul class="mb-6 space-y-2 text-gray-600 dark:text-gray-300">
                    <li>✔ 3 Resume Scans</li>
                    <li>✔ Basic Match Score</li>
                    <li>✘ No AI Rewrite</li>
                </ul>
                <a href="{{ route('register.index') }}"
                   class="block px-6 py-3 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-500">
                   Start Free
                </a>
            </div>

            <!-- Pro -->
            <div class="p-8 bg-white dark:bg-gray-900 rounded-2xl shadow-lg border-2 border-blue-600">
                <h3 class="text-xl font-bold mb-4">Pro</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">Best for job seekers</p>
                <p class="text-4xl font-extrabold mb-6">$19<span class="text-lg">/mo</span></p>
                <ul class="mb-6 space-y-2 text-gray-600 dark:text-gray-300">
                    <li>✔ Unlimited Scans</li>
                    <li>✔ AI Resume Rewrite</li>
                    <li>✔ Cover Letter Generator</li>
                    <li>✔ Priority Support</li>
                </ul>
                <a href="{{ route('register.index') }}"
                   class="block px-6 py-3 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-500">
                   Go Pro
                </a>
            </div>

            <!-- Business -->
            <div class="p-8 bg-white dark:bg-gray-900 rounded-2xl shadow hover:shadow-lg">
                <h3 class="text-xl font-bold mb-4">Business</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">For recruiters & career coaches</p>
                <p class="text-4xl font-extrabold mb-6">$49<span class="text-lg">/mo</span></p>
                <ul class="mb-6 space-y-2 text-gray-600 dark:text-gray-300">
                    <li>✔ Team Access</li>
                    <li>✔ Bulk Resume Analysis</li>
                    <li>✔ White-label Reports</li>
                    <li>✔ Dedicated Support</li>
                </ul>
                <a href="{{ route('register.index') }}"
                   class="block px-6 py-3 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-500">
                   Contact Sales
                </a>
            </div>

        </div>
    </div>
</section>
@endsection
