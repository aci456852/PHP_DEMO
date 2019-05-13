
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
              我的班级
            </a>
          </li>
          
        </ul>

        
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      
      <h2>作业列表</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>名称</th>
              <th>实验模版</th>
              <th>创建时间</th>
              <th>我的作业</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($my_assignments as $value): ?>
            <tr>
              <td><?php echo $value['id'];?></td>
              <td><?php echo $value['title'];?></td>
              <td><a href="/index.php?r=student/download_template&id=<?php echo $value['id'];?>">下载</a></td>
              <td><?php echo $value['created_at'];?></td>
              <td><a href="/index.php?r=student/my_assignment&course_id=<?php echo $value['id'];?>">上传作业</a></td>
            </tr>
            <?php endforeach; ?>
            
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<?php include('view/layout/footer.php');