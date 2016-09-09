<?php include('inc/header.php'); ?>
<div id="enca">
</div>
<div class="pagination_wrapper">
    <ul class="pagination" id="pagination">
    </ul>
</div>
<?php include('inc/footer.php'); ?>

<script>
GetPages();
GetSelectedPage(<?php if(isset($_GET['page'])){ echo $_GET['page']; }?>);
</script>
