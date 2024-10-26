<?php
include("header.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function removeEmptyParagraphs($content) {
    // Remove empty paragraphs
    $content = preg_replace('/<p>(&nbsp;|\s)*<\/p>/', '', $content);
    return $content;
}

if (isset($_GET['blog_id'])) {
    $blogId = $_GET['blog_id'];
    $query = "SELECT * FROM blogs WHERE id = $blogId";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $blog = mysqli_fetch_assoc($result);
        $blog["content"] = removeEmptyParagraphs(htmlspecialchars_decode($blog["content"]));
    } else {
        header("Location: blogs.php");
        exit();
    }
} else {
    header("Location: blogs.php");
    exit();
}
?>
<style>
    p:empty {
        display: none;
    }
</style>

<div class="container mt-5">
    <div class="">
        <img src="/yn/Admin/shringarr/<?php echo $blog["image"]; ?>" class="card-img-top" alt="Blog Image" style="max-height: 500px;object-fit: contain;">
        <div class="card-body">
            <h2 class="card-title"><?php echo $blog["title"]; ?></h2>
            <p class="card-text"><?php echo ($blog["content"]); ?></p>
        </div>
    </div>
</div>

<?php
include("footer.php");
?>
