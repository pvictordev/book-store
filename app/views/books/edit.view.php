<?php require base_path('app/views/partials/head.php'); ?>

<?php
require base_path('app/Models/BookModel.php');

$book_id = $_GET['_edit'];

$bookModel = new BookModel($db);

$book = $bookModel->getBook($book_id);
?>

<main class="h-screen flex items-center justify-center">
    <form method="POST" action="/books/edit" class="p-6 bg-white rounded-lg shadow-lg w-80">
        <input type="hidden" name="_edit" value="<?= $book_id ?>">

        <div class="space-y-4">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" value="<?= $book['title'] ?>" id="title" name="title" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Book Title">
            </div>

            <div>
                <label for="author_id" class="block text-sm font-medium text-gray-700">Author</label>
                <input type="text" value="<?= $book['authorId'] ?>" id="author_id" name="author_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="author_id">
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                <input type="text" value="<?= $book['price'] ?>" id="price" name="price" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Price">
            </div>

            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                <input type="number" value="<?= $book['stock'] ?>" id="stock" name="stock" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Stock">
            </div>
        </div>

        <button type="submit" class="mt-6 w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Update
        </button>
    </form>
</main>

<?php require base_path('app/views/partials/foot.php'); ?>