<?php require base_path('app/views/partials/head.php'); ?>

<div class="container mx-auto p-4">
    <span onclick="history.back()" class="cursor-pointer text-3xl absolute top-3 left-3" href="">←</span>
    <h1 class="text-2xl font-bold text-center text-gray-900 mb-6">Authors List</h1>
    <div id="books-container" class="bg-white flex flex-wrap gap-2 p-4 rounded-lg shadow-lg">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm">
            <h2 class="text-xl font-semibold text-gray-900 mb-2">William Shakespeare</h2>
            <p class="text-gray-700 mb-1">William Shakespeare was an English poet, playwright, and actor of the Renaissance era. He was an important member of the King’s Men theatrical company from roughly 1594 onward. Known throughout the world, Shakespeare’s works—at least 37 plays, 154 sonnets, and 2 narrative poems—capture the range of human emotion and conflict and have been celebrated for more than 400 years. Details about his personal life are limited, though some believe he was born and died on the same day, April 23, 52 years apart.</p>
        </div>
    </div>
</div>

<?php require base_path('app/views/partials/foot.php'); ?>