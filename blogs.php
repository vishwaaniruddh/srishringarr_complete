<?php  
include('header.php');

// Function to remove empty paragraphs
function removeEmptyParagraphs($content) {
    // Remove empty paragraphs
    $content = preg_replace('/<p>(&nbsp;|\s)*<\/p>/', '', $content);
    return $content;
}

$query = "SELECT * FROM blogs where isPublished=1 and status=1 ORDER BY created_at DESC";


if(mysqli_num_rows($result = mysqli_query($con, $query)) > 0 ){ ?>



<style>
    .card {
        box-shadow: 7px 23px 8px rgba(146, 115, 120, 0.4);
    }

    p:empty {
        display: none;
    }
</style>

<div class="container mt-5">
    <h2>Latest Blogs</h2>
    <hr />
    <div class="row">

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="/yn/Admin/shringarr/<?php echo $row["image"]; ?>" class="card-img-top" alt="Blog Image" style="max-height: 300px;object-fit: cover;" />
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row["title"]; ?></h5>
                        <?php
                        // Apply function to remove empty paragraphs
                        // $content = removeEmptyParagraphs($row["content"]);
                        $content = filter_var($row['content'], FILTER_SANITIZE_STRING);

                        ?>
                        <p class="card-text"><?php echo substr(htmlspecialchars_decode($content), 0, 150) . '...'; ?></p>
                        
                        <hr />
                        <a href="blog_detail.php?blog_id=<?php echo $row["id"]; ?>" target="_blank" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>

    <? } else{
    echo '<h2 style="margin:5%; text-align:center; ">No Blogs Found !</h2>' ; 
    }
    ?>



<script>
    var image = document.querySelector('.card-body img');

// Hide the image
image.style.display = 'none';
</script>
<?php include('footer.php'); ?>
