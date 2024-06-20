<?php require base_path('app/views/partials/head.php'); ?>

<?php
require_once base_path('app/Models/BookModel.php');

$bookModel = new BookModel($db);

// user data
$books = $bookModel->getBooks();

?>

<div class="container mx-auto p-4">
    <a class="cursor-pointer text-3xl absolute top-3 left-3" href="/profile">←</a>
    <h1 class="text-2xl font-bold text-center text-gray-900 mb-6">Books List</h1>

    <!-- create a book -->
    <a class="text-center mb-6" href="/books/create">
        <span class="text-3xl rounded-full border border-2 px-2 border-black font-bold text-center text-gray-900">+</span>
    </a>

    <div id="books-container" class="bg-white flex flex-wrap gap-2 p-4 rounded-lg shadow-lg">
        <?php foreach ($books as $book) : ?>
            <div class="bg-white relative p-6 rounded-lg shadow-lg max-w-xs w-64 h-72 flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 mb-2 truncate"> <?= $book['Title'] ?> </h2>
                    <p class="text-gray-700 mb-1 truncate"><?= $book['AuthorID'] ?></p>
                    <p class="text-gray-700 mb-1">Price: <?= $book['Price'] ?></p>
                    <p class="text-gray-700 mb-1">Stock: <?= $book['Stock'] ?></p>
                </div>

                <!-- remove book  -->
                <form method="POST" action="/books/delete" class="absolute cursor-pointer bottom-3 right-3">
                    <input type="hidden" name="_delete" value="<?= $book['BookID'] ?>">
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" viewBox="0 0 24 24" fill="none">
                            <path d="M10 11V17" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M14 11V17" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4 7H20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </form>

                <!-- edit book -->
                <form method="GET" action="/books/edit" class="absolute cursor-pointer bottom-3 left-3">
                    <input type="hidden" name="_edit" value="<?= $book['BookID'] ?>">
                    <button type="submit">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="25px" height="25px" viewBox="0 0 24 24">
                                <title />
                                <g id="Complete">
                                    <g id="edit">
                                        <g>
                                            <path d="M20,16v4a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4H8" fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />

                                            <polygon fill="none" points="12.5 15.8 22 6.2 17.8 2 8.3 11.5 8 16 12.5 15.8" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </span>
                    </button>
                </form>
            </div>

        <?php endforeach; ?>
    </div>
</div>

<?php require base_path('app/views/partials/foot.php'); ?>