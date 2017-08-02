 <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <!--<img src="../assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">-->          
          <img src="../assets/logos/naro.png" class="" alt="Logo Image" style="margin-right: 90px;">
        </div>
        <div class="pull-left image">
          <img src="../assets/logos/naroforest.png" class="" alt="Logo Image" height="100px">
          <p>
            <?php
                //if(isset($_SESSION['userSession'])):
                //  echo $_SESSION['fullname']. "-Admin";
                //endif;
            ?>
          </p>
          <!--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
        </div>
      </div>

      <ul class="sidebar-menu">
        <li class="header">INSECT COLLECTION APPLICATION</li>
        
        <li class="active"><a href="dashboard.php"><i class="fa fa-dashboard"></i> DASHBOARD </a></li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bug"></i> <span>INSECTS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="add_insect.php"><i class="fa fa-circle-o"></i> Add New Insect</a></li>
            <li><a href="insect_list.php"><i class="fa fa-circle-o"></i> Insect List</a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-first-order" aria-hidden="true"></i> <span>ORDER</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="add_order.php"><i class="fa fa-circle-o"></i> Add New Insect Order</a></li>
            <li><a href="order_list.php"><i class="fa fa-circle-o"></i> Order List</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
              <i class="fa fa-cogs"></i> <span>FAMILY</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="add_family.php"><i class="fa fa-circle-o"></i> Add New Insect Family</a></li>
              <li><a href="family_list.php"><i class="fa fa-circle-o"></i> Family List</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
              <i class="fa fa-group"></i> <span>GENUS</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
              <li><a href="add_genus.php"><i class="fa fa-circle-o"></i> Add New Insect Genus</a></li>
              <li><a href="genus_list.php"><i class="fa fa-circle-o"></i> Genus List</a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-asterisk"></i> <span>SPECIES</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="add_species.php"><i class="fa fa-circle-o"></i> Add New Insect Species</a></li>
            <li><a href="species_list.php"><i class="fa fa-circle-o"></i> Species List</a></li>
          </ul>
        </li>

    </section>
    <!-- /.sidebar -->
  </aside>