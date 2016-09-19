<?php
	require_once("api.php");
  $date = '';
  $imgsrc='';
  $title='';
  $content = '';
  $id='';
  $btn = '<button type="button" id="btn-upload-news" name="btn-upload-news">UPLOAD</button>';
  if(isset($_GET['edit']) && isset($_GET['id'])){
      if($_GET['edit']=="news" && $_GET['id']!=''){

          $qry = "SELECT `id`,`title`,`content`,`dateadded`,`imagepath` FROM tblnews WHERE `id`=".$_GET['id'];
          $con = new ConnectionDB();
          $api = new Api($con);
          $result = $api->ExecuteReader($qry);
          $row = mysqli_fetch_assoc($result);

          $title = $row['title'];
          $imgsrc = $row['imagepath'];
          $content = $row['content'];
          $date = new DateTime($row['dateadded']);
          $date = $date->format('Y-m-d');
          $btn = '<button type="button" id="btn-update-news" name="btn-update-news" value="'.$row['id'].'">UPDATE</button>
            <button type="button" id="btn-cancel-news" name="btn-cancel-news" value="'.$row['id'].'">CANCEL</button>';
      }
  }
?>
<div class="admin-header dark">
    <h3><span class="btn-back glyphicon glyphicon-chevron-left"></span> NEWS</h3>
</div>
<div class="admin-news">
    <h3>Add News</h3>
    <form class="news-form" onsubmit="return false;">
        <img src="<?php echo $imgsrc; ?>" id="newsimg" />
        <div class="hidden"><input type="file" id="upload-news" name="upload-news" onchange="readURL(this,'newsimg')"></div>
        <button type="button" id="btn-browse-news" name="btn-browse-news">BROWSE</button>
        <input type="text" id="news-title" name="title" placeholder="Title..." value="<?php echo $title; ?>">
        <input type="date" id="news-date" name="date"  placeholder="Date..." value="<?php echo $date; ?>">
        <textarea id="news-description" name="description"  ><?php echo $content; ?></textarea>
        <?php echo $btn; ?>
    </form>
    <?php

        $qry = "SELECT `id`,`title`,`content`,`dateadded`,`imagepath` FROM tblnews ORDER BY `dateadded` DESC ";
        $con = new ConnectionDB();
        $api = new Api($con);
        $result = $api->ExecuteReader($qry);
        $arr = array();
        while($row = mysqli_fetch_assoc($result)){
        ?>
        <div class="article_wrapper">
            <span data-id="<?php echo $row["id"]; ?>" class="btn-remove-news glyphicon glyphicon-remove" style="cursor:pointer;"></span>
            <h3><?php echo $row['title']; ?></h3>
            <h5><?php $now = new DateTime($row['dateadded']); print_r($now->format('jS F Y')); ?></h5>
            <p>
                <img id="news<?php echo $row["id"]; ?>" src="<?php echo substr($row['imagepath'],3); ?>" alt="news1" />
                <?php echo $row['content']; ?>
            </p>
            <button type="button" id="btn_news_edit" value="<?php echo $row['id']; ?>" onclick="editNews(<?php echo $row['id']; ?>)">EDIT</button>
            <hr>
        </div>
        <?php
        }

    ?>


</div>
