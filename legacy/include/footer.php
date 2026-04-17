    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center md:text-left">
                <div>
                    <h3 class="text-xl font-bold mb-4"><?php echo $siteName; ?></h3>
                    <p class="text-gray-400">Building something amazing with PHP and Tailwind CSS.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="home" class="hover:text-white transition">Home</a></li>
                        <li><a href="about" class="hover:text-white transition">About</a></li>
                        <li><a href="contact" class="hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Connect</h4>
                    <p class="text-gray-400">Email: info@example.com</p>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-500">
                &copy; <?php echo date('Y'); ?> <?php echo $siteName; ?>. All rights reserved.
            </div>
        </div>
    </footer>
    <script src="assets/js/main.js"></script>
</body>
</html>