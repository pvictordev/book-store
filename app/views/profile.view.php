<?php require base_path('app/views/partials/head.php'); ?>

<main class="h-screen flex items-center justify-center">
    <a href="/logout" class="absolute top-3 right-3">Log out</a>
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <nav class="flex justify-between text-sm text-slate-500">
                <a class="hover:underline" href="/books">Books</a>
                <a class="hover:underline" href="/authors">Authors</a>
                <a class="hover:underline" href="/orders">Orders</a>
            </nav>
            <div class="bg-white p-8 rounded-lg shadow-xl max-w-xs">
                <div class="flex flex-col items-center">
                    <img class="w-24 h-24 rounded-full shadow-md object-cover" src="https://via.placeholder.com/150" alt="Profile Picture">
                    <h2 class="mt-4 text-xl font-semibold text-gray-900"><?= $user['username'] ?></h2>
                    <p class="text-gray-600"><?= $user['email'] ?></p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require base_path('app/views/partials/foot.php'); ?>