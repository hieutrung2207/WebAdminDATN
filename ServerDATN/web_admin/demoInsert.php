<?php
require_once('../services/books-services.php');
require_once('../services/categories-services.php');
require_once('../services/authors-services.php');
require_once('../services/publishers-services.php');
require_once('../services/images-services.php');

$pdo = new DBConfig();
$conn = $pdo->getConnect();

$bookService = new BookServices();
$cateService = new CategoriesService();
$authorService = new AuthorsService();
$publisherService = new PublishersService();
$imageService = new ImagesServices();

$books = $bookService->getAllBooks()->getData();
$cates = $cateService->getAllCategories()->getData();
$authors = $authorService->getAllAuthors()->getData();
$publishers = $publisherService->getAllPublishers()->getData();

$index = count($books);

echo "Số lượng sách: " . $index;
echo "<br>";
echo "<br>";


if (isset($_POST['btnDel'])) {
    
}

?>
<div>
    <table>
        <thead>
            <tr>
                <th>
                    Name
                </th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Hình ảnh</th>
                <th>Tác giả</th>
                <th>Nhà xuất bản</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book) : ?>
                <tr>
                    <td>
                        <?php echo $book->getTitle() ?>
                    </td>
                    <td>
                        <?php echo $book->getPrice() ?>
                    </td>
                    <td>
                        <?php echo $book->getQUANTITY() ?>
                    </td>
                    <td>
                        <?php
                        $images = $bookService->getImagesByBookID($book->getBookid())->getData();
                        foreach ($images as $image) {
                            if ($image->getIsdefault() == 1) {
                                echo $image->getUrl();
                            }
                        }
                        ?>
                    </td>
                    <td>
                        <?php echo $bookService->getAuthorName($book->getauthorid()) ?>
                    </td>
                    <td>
                        <?php echo $bookService->getPublisherName($book->getpublisherid()) ?>
                    </td>
                    <td>
                        <form method="POST">
                            <button type="submit" class="btn-delete-book" name="btnDel" data-book-id="<?php echo $book->getBookid() ?>">Xóa</button>
                            <button type="submit">Sửa</button>
                        </form>

                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>