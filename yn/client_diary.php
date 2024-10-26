<?php include('header.php'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

<style>
    /* Add the following styles to your existing styles or in a new style tag */
    .row a {
        display: block;
        text-decoration: none;
    }

    .row img {
        max-width: 100%;
        max-height: 200px; /* Adjust the height as needed */
        width: auto;
        height: auto;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .row p {
        margin: 0;
        text-align: center;
    }
</style>

<main class="mainContent" role="main">
    <section id="pageContent">
        <div class="container">
            <div class="row">
                <?php
                $sql = mysqli_query($con, "select distinct(a.image_url) as image, a.id,a.banner,b.sku from client_diary_details a INNER JOIN client_diary b ON a.clientid = b.id where a.status=1 and b.site='YN'");
                while ($sql_result = mysqli_fetch_assoc($sql)) {
                    $id = $sql_result['id'];
                    $title = $sql_result['sku'];

                        $sourcePath = $sql_result['image'];

                    ?>
                    <div class="col-sm-4">
                        <a href="<?= $sourcePath; ?>" data-lightbox="<?= $id; ?>" data-title="<?= $title; ?>">
                            <img src="<?= $sourcePath; ?>" alt="<?= $title; ?>" />
                            <p><?= $title; ?></p>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
</main>

<script>
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true
    });
</script>

<?php include('footer.php'); ?>
