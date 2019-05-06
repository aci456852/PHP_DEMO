
<?php include('view/layout/header.php'); ?>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link " href="#">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="/index.php?r=teacher/home">
              <span data-feather="file"></span>
              班级管理
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/index.php?r=teacher/add_course">
              <span data-feather="file"></span>
              新增班级
            </a>
          </li>
          
        </ul>

        
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      
      <h2>新建作业</h2>
      
      <form action='/index.php?r=assignment/do_create_assignment' method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="exampleInputEmail1">作业标题</label>
          <input name="title" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
        </div>
        <div class="form-group">
          <label for="exampleFormControlFile1">请选择实验报告模版</label>
          <input type="file" name="template" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <input type="hidden" name="course_id" value="<?php echo $courseId; ?> ">
        <button type="submit" class="btn btn-primary">提交</button>
      </form>
    </main>
  </div>
</div>

<?php include('view/layout/footer.php');