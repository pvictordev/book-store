<?php require base_path('app/views/partials/head.php'); ?>

<?php
require_once base_path('app/Models/BookModel.php');

$bookModel = new BookModel($db);

// user data
$books = $bookModel->getBooks();

?>

<div class="container mx-auto p-4">
    <span onclick="history.back()" class="cursor-pointer text-3xl absolute top-3 left-3" href="">←</span>
    <h1 class="text-2xl font-bold text-center text-gray-900 mb-6">Books List</h1>
    <div id="books-container" class="bg-white flex flex-wrap gap-2 p-4 rounded-lg shadow-lg">
        <?php foreach ($books as $book) : ?>
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm">
                <h2 class="text-xl font-semibold text-gray-900 mb-2"> <?= $book['Title'] ?> </h2>
                <p class="text-gray-700 mb-1"><?= $book['AuthorID'] ?></p>
                <p class="text-gray-700 mb-1">Price: <?= $book['Price'] ?></p>
                <p class="text-gray-700 mb-1">Stock: <?= $book['Stock'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require base_path('app/views/partials/foot.php'); ?>