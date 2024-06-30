<?php require base_path('app/views/partials/head.php'); ?>

<?php
require_once base_path('app/Models/BookModel.php');

$bookModel = new BookModel($db);

// user data
$books = $bookModel->getBooks();

?>

<div class="container mx-auto p-4">
    <a class="cursor-pointer font-bold text-3xl absolute top-3 left-3" href="/profile"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" width="30px" height="30px" viewBox="0 0 32 32" version="1.1">

            <title>arrow-left-circle</title>
            <desc>Created with Sketch Beta.</desc>
            <defs>

            </defs>
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-256.000000, -1087.000000)" fill="#000000">
                    <path d="M279,1102 L268.414,1102 L272.536,1097.88 C272.926,1097.49 272.926,1096.86 272.536,1096.46 C272.145,1096.07 271.512,1096.07 271.121,1096.46 L265.464,1102.12 C265.225,1102.36 265.15,1102.69 265.205,1103 C265.15,1103.31 265.225,1103.64 265.464,1103.88 L271.121,1109.54 C271.512,1109.93 272.145,1109.93 272.536,1109.54 C272.926,1109.15 272.926,1108.51 272.536,1108.12 L268.414,1104 L279,1104 C279.552,1104 280,1103.55 280,1103 C280,1102.45 279.552,1102 279,1102 L279,1102 Z M272,1117 C264.268,1117 258,1110.73 258,1103 C258,1095.27 264.268,1089 272,1089 C279.732,1089 286,1095.27 286,1103 C286,1110.73 279.732,1117 272,1117 L272,1117 Z M272,1087 C263.164,1087 256,1094.16 256,1103 C256,1111.84 263.164,1119 272,1119 C280.836,1119 288,1111.84 288,1103 C288,1094.16 280.836,1087 272,1087 L272,1087 Z" id="arrow-left-circle" sketch:type="MSShapeGroup">

                    </path>
                </g>
            </g>
        </svg>
    </a>

    <h1 class="text-2xl font-bold text-center text-gray-900 mb-6">Books List</h1>

    <!-- create a book -->
    <a class="text-center mb-6" href="/books/create">
        <svg xmlns="http://www.w3.org/2000/svg" width="50px" height="50px" viewBox="0 0 24 24" fill="none">
            <g id="Edit / Add_Plus_Circle">
                <path id="Vector" d="M8 12H12M12 12H16M12 12V16M12 12V8M12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </g>
        </svg>
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