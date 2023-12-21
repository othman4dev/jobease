<?php
session_start();
include "verifyUser.php";
$results = "No results found";
if (isset($_GET['keywords'])) {
    $results = User::searchByKeywords($connection,$_GET['keywords']);
}
$decoded = json_decode($results);
if (empty($decoded)) {
    echo "<h1>No results found</h1>";
    die();
}
// Output the values of the "id" key using a for loop
for ($i = 0; $i < count($decoded); $i++) {
    $sql = "SELECT * FROM offers WHERE id = ".$decoded[$i]->id."";
    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <article class="postcard light red">
            <a class="postcard__img_link" href="#">
                <img class="postcard__img" src="<?php echo 'dashboard/'. $row['target'] ?>"alt="Image Title" onerror="this.src = 'dashboard/img/default.jpg'"/>
            </a>
            <div class="postcard__text t-dark">
                <h3 class="postcard__title red"><a href="#"><?php echo $row['title']; ?></a></h3>
                <div class="postcard__subtitle small">
                    <time datetime="2020-05-25">
                        <i class="fas fa-calendar-alt mr-2"></i><?php echo date('Y-m-d', strtotime($row['created_at'])); ?>
                    </time>
                </div>
                <div class="postcard__bar"></div>
                <div class="postcard__preview-txt"><?php echo $row['description']; ?></div>
                <ul class="postcard__tagbox">
                    <li class="tag__item"><i class="fas fa-tag mr-2"></i><?php echo $row['location']; ?></li>
                    <li class="tag__item"><i class="fas fa-clock mr-2"></i><?php echo $row['salary']; ?>$</li>
                    <li class="tag__item play red">
                        <?php 
                        $sqlcode2 = "SELECT * FROM postules WHERE user_id = ".$_SESSION['id']." AND offer_id = ".$row['id']."";
                        $result2 = mysqli_query($connection, $sqlcode2);
                        if (mysqli_num_rows($result2) > 0) {
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                echo "<a><i class='fas fa-play mr-2'><span style='color:red'>You already applied for this job</span></i>";
                            }
                        } else {
                            echo "<a href='apply.php?id=".$row['id']."'><i class='fas fa-play mr-2'>Apply now</i>";
                        }
                        ?></a>
                    </li>
                </ul>
            </div>
        </article>
    <?php }
}
?>
