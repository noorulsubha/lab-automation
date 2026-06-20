<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - AB Automation</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 font-sans antialiased">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="text-center mb-12">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">
                Get in Touch
            </h1>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                Have questions about our automation services? Fill out the form below or reach us directly.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <div class="bg-blue-900 text-white p-8 rounded-2xl shadow-lg lg:col-span-1 space-y-6">
                <div>
                    <h3 class="text-xl font-bold mb-2">Contact Information</h3>
                    <p class="text-blue-200 text-sm">Reach out to us directly for urgent inquiries.</p>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <span class="text-xl">📧</span>
                        <div>
                            <p class="text-xs text-blue-300">Email Us</p>
                            <p class="font-medium">info@ab-automation.com</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="text-xl">📞</span>
                        <div>
                            <p class="text-xs text-blue-300">Call Us</p>
                            <p class="font-medium">+1 (555) 019-2834</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-md lg:col-span-2">
                
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 rounded-lg text-sm">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ url('/contact') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-150">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-150">
                        </div>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Your Message</label>
                        <textarea name="message" id="message" rows="5" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-150">{{ old('message') }}</textarea>
                    </div>

                    <div>
                        <button type="submit" 
                            class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition duration-200 cursor-pointer text-center">
                            Send Message
                        </button>
                    </div>
                </form>
                </div>
        </div>

    </div>

</body>
</html>