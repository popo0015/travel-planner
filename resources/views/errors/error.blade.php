<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    @vite('resources/css/app.css')
    <style>
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(86, 77, 54, 0.8);
            pointer-events: none;
        }
    </style>
</head>
<body class="bg-[#564D36] flex items-center justify-center min-h-screen bg-cover" style="font-family: 'Roboto', sans-serif; background-image: url('{{ asset('/images/texture.jpg') }}'); background-size: cover;">
<div class="overlay"></div>
<div class="relative z-10 text-center bg-ticket-right p-10 rounded-lg shadow-lg">
    <img src="https://img.icons8.com/ios-filled/100/airport.png" alt="airplane" class="mx-auto mb-4">
    <h1 class="text-6xl font-bold text-[#40392B]">{{$error}}</h1>
    <p class="text-2xl mt-4 text-black">{{$issue}}</p>
    <p class="text-xl mt-2 text-gray-600">{{$joke}}</p>
    <a href="{{ url('/') }}" class="mt-6 inline-block px-4 py-2 text-lg text-white bg-[#40392B] rounded-md hover:bg-[#E6B800]">Return Home</a>
</div>
</body>
</html>
