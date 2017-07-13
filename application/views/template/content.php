 <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php
    if(@$content!=''){
      $this->load->view("page/".@$content);
    }
    ?>
  </div>
  <!-- /.content-wrapper -->