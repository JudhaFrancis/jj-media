<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <meta name="description" content="<?php echo $pageDescription; ?>">
    <link rel="stylesheet" href="dist/output.css">
</head>
<body class="bg-gray-50 text-gray-900 font-sans">
    <header class="bg-white border-b sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="home" class="text-2xl font-bold text-blue-600"><?php echo $siteName; ?></a>
            <div class="hidden md:flex space-x-8">
                <a href="home" class="hover:text-blue-600 transition">Home</a>
                <a href="about" class="hover:text-blue-600 transition">About</a>
                <a href="contact" class="hover:text-blue-600 transition">Contact</a>
            </div>
            <button class="md:hidden text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </nav>
    </header>