<!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="home.php" class="nav-link <?php if ($sidebar == "dashboard"){ echo "active";} else{ echo "";} ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="my_account.php" class="nav-link <?php if ($sidebar == "my-account"){ echo "active";} else{ echo "";} ?>">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    My Account
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="my_clients.php" class="nav-link <?php if ($sidebar == "my-clients"){ echo "active";} else{ echo "";} ?>">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    My Clients
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="my_projects.php" class="nav-link <?php if ($sidebar == "my-projects"){ echo "active";} else{ echo "";} ?>">
                                <i class="nav-icon fas fa-tasks"></i>
                                <p>
                                    My Projects
                                </p>
                            </a>
                        </li>
                        
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->