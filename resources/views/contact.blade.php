<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Lab Automation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans min-h-screen flex items-center justify-center p-4">

    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg md:max-w-xl transition-all duration-300">
        
        <div class="text-center mb-6">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Switchgear Service Request</h2>
            <p class="text-gray-600 text-sm md:text-base mt-2">Submit your requirements directly to our team.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm text-center" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Your Name (Optional)</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full p-2.5 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm" placeholder="e.g., John Doe">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Company Name / Location (Optional)</label>
                <input type="text" name="company_or_location" value="{{ old('company_or_location') }}" class="w-full p-2.5 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm" placeholder="e.g., Karachi Facility">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Contact Number <span class="text-red-500">*</span></label>
                <input type="text" name="contact_number" value="{{ old('contact_number') }}" required class="w-full p-2.5 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm" placeholder="e.g., +923000000000">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Service Details <span class="text-red-500">*</span></label>
                <textarea name="message" rows="4" required class="w-full p-2.5 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm resize-none">{{ old('message', 'We need to get routine servicing and preventive maintenance done for the Switchgear panels and breakers at our facility. Please share your availability and a quotation for this service.') }}</textarea>
            </div>

            <div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded transition duration-200 text-sm md:text-base focus:outline-none shadow-md">
                    Send Message
                </button>
            </div>
        </form>

    </div>
</body>
</html>