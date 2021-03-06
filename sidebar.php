<?php include "base.php"; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
        <!-- Bootstrap -->
        <link href="/css/bootstrap.min.css.css" rel="stylesheet">
        <link href="/css/SidebarPractice.css" rel="stylesheet">
        <style>
            a{
                display:inline-block;
                padding:2px;
            }
            
        </style>
    </head>
    
    <?php
    if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
    {
        $params = array($_SESSION['Username']);
        $options = array( "Scrollable" => SQLSRV_CURSOR_KEYSET);
        $ListRolesQuery = "SELECT DISTINCT R.Role, R.Designation, R.RoleID, R.Type FROM Roles as R, RoleInstances as RI WHERE RI.SiteUsername = ? AND RI.RoleID = R.RoleID ORDER BY R.RoleID, R.Designation, R.Type";
        $stmt = sqlsrv_query($con, $ListRolesQuery, $params, $options);
        if( $stmt === false ) {
             die( print_r( sqlsrv_errors(), true));
        }

        // Make the first (and in this case, only) row of the result set available for reading.
        $RolesList = [];
        $Designations = [];
        $AccessPriv = [];
        $NumRoles = 0;
        while( sqlsrv_fetch( $stmt ) === true) {
            $RolesList[] = sqlsrv_get_field( $stmt, 0);
            $Designations[] = sqlsrv_get_field( $stmt, 1);
            $AccessPriv[] = sqlsrv_get_field( $stmt, 3);
            $NumRoles += 1;
        }
        if($_SESSION['Role'] == 'Admin')
        {
            $params = array($_SESSION['Institution']);
            $options = array( "Scrollable" => 'static' );
            $instIDQuery = "SELECT InstitutionID FROM Institutions WHERE InstitutionName = ?";
            $stmt = sqlsrv_query ( $con, $instIDQuery, $params, $options );
            if ( $stmt === false )
                die (print_r(sqlsrv_errors(), true));
            if ( sqlsrv_fetch ($stmt) === true)
                $institutionID = sqlsrv_get_field( $stmt, 0);
            
            
            ?>
            <body>
                <div id="wrapper">
                    <div class="overlay"></div>

                    <!-- Sidebar -->
                    <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
                        <ul class="nav sidebar-nav">
                            <li class="sidebar-brand">
                                <a href="/Admin/Home/">Smalltalk</a>
                            </li>
                            <li>
                                <a class="dropdown-toggle" data-toggle="dropdown"><?=$_SESSION['Username']?><span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">

                                    <li>
        <?php   
            $count = 0;
            foreach($RolesList as $ListedRole)
            {
                if ($ListedRole == $_SESSION['Role'])
                {
        ?>
                                        <a style="text-decoration:underline"><?=$ListedRole?> <small class="text-muted"><?=$Designations[$count]?></small></a>
        <?php
                }
                else
                {
        ?>
                                        <a href="/ChangeRole.php?q=<?=$ListedRole?>&t=<?=$AccessPriv[$count]?>"><?=$ListedRole?> <small class="text-muted"><?=$Designations[$count]?></small></a>
        <?php
                }
                $count++;
            }
        ?>
                
                                    </li>
                              </ul>
                            </li>
                            <li class="nav-divider"></li>
                            <li><a href="/Admin/SiteUsers/">Site Users</a></li>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown">Site Activity<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                  <li>
                                    <?php
            if ($_SESSION['AccessType'] == 'Super')
            {
                ?>
                <a href="/Admin/ManageInstitutions/">Institutions <small class="text-muted">Superuser</small></a>
                <?php
            }
            else
            {
                if ( ($_SESSION['Designation'] == 'Primary') || ($_SESSION['Designation'] == 'Developer'))
                {
                    ?>
                                    <a href="/Admin/ManageInstitutions/ViewInstitution/?in=<?=$institutionID?>"><?=$_SESSION['Institution']?></a>
                                    <?php
                }
            }
            ?>
                                    <a href="/Admin/ManageCorpus/">Corpus</a>
                                    <a href="/Admin/ManageCourses/">Courses</a>
                                </li>
                            </ul>
            <?php
            
                
                                    ?>
                                    
                                    
                            
                            <li>
                                <a href="/corpus/Search/">Corpus</a>
                            </li>
                            <li>
                                <a class="dropdown-toggle" data-toggle="dropdown">Archive<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="/Admin/Archive/Courses/" >Courses</a>
                                        <a href="/Admin/Archive/Students/">Students</a>
                                        <a href="/admin/Archive/Teachers/">Teachers</a>
                                    </li>
                              </ul>
                            </li>
                            
                            <li class="nav-divider"></li>
                            <li>
                                <a href="#">Change Password</a>
                            </li>
                            <li>
                                <a href="/Logout.php">Logout</a>
                            </li>
                            
                        </ul>
                    </nav>
                    <!-- /#sidebar-wrapper -->

                    <!-- Page Content -->
                    <!--<div id="page-content-wrapper">
                        <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                            <span class="hamb-top"></span>
                            <span class="hamb-middle"></span>
                            <span class="hamb-bottom"></span>
                        </button>
                    </div>-->
                    <!-- /#page-content-wrapper -->
                </div>
                <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
                <!-- Include all compiled plugins (below), or include individual files as needed -->
                <script src="js/bootstrap.min.js"></script>
                <script src="js/SidebarPractice.js"></script>
                <script>
                $("#menu-toggle").click(function(e) {
                    e.preventDefault();
                    $("#wrapper").toggleClass("toggled");
                });
                </script>
            </body>
        <?php
        }
        elseif($_SESSION['Role'] == 'Teacher')
        {
            $params = array($_SESSION['Username']);
            $options = array( "Scrollable" => 'static' );
            $getInstitutionsQuery = "
            SELECT I.InstitutionName, I.InstitutionID 
            FROM Institutions as I, TeachingInstance as TI
            WHERE TI.SiteUsername = ? AND
	              I.InstitutionID = TI.InstitutionID";
            $stmt = sqlsrv_query($con, $getInstitutionsQuery, $params, $options);
    
            if( $stmt === false ) {
                die( print_r( sqlsrv_errors(), true));
            }
            
            $institutions = [];
            $institution_ids = [];
            $num_institutions = sqlsrv_num_rows($stmt);
            while( sqlsrv_fetch( $stmt ) === true) {
                $institutions[] = sqlsrv_get_field( $stmt, 0);
                $institution_ids[] = sqlsrv_get_field( $stmt, 1);
            }
            
            ?>
            <body>
                <div id="wrapper">
                    <div class="overlay"></div>

                    <!-- Sidebar -->
                    <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
                        <ul class="nav sidebar-nav">
                            <li class="sidebar-brand">
                                <a href="/teacher/Home/">Home</a>
                            </li>
                            <li>
                                <a class="dropdown-toggle" data-toggle="dropdown"><?=$_SESSION['Username']?><span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
<!--
                                    <li class="dropdown-header">My Roles</li>
-->
                                    <li>
                                         <?php      
                $count = 0;
        foreach($RolesList as $ListedRole)
        {
            if ($ListedRole == $_SESSION['Role'])
            {
            ?>
                        <strong><a><?=$ListedRole?> <small class="text-muted"><?=$Designations[$count]?></small></a></strong>
                                
            <?php
            }
            else
            {
                ?>
                                        <a href="/ChangeRole.php?q=<?=$ListedRole?>&t=<?=$AccessPriv[$count]?>"><?=$ListedRole?> <small class="text-muted"><?=$Designations[$count]?></small></a>
                                        <?php
                    
            }
            $count++;
        }
        ?>
                
                                    </li>
                              </ul>
                            </li>
                            <li class="nav-divider"></li>
                            <?php
            for($i = 0; $i < $num_institutions; $i++)
            {
                ?>
                            <li class="dropdown">
                              <a href="/teacher/MyInstitutions/" class="dropdown-toggle" data-toggle="dropdown"><?=$institutions[$i]?><span class="caret"></span></a>
                              <ul class="dropdown-menu" role="menu">
                                  <li>
                                      <?php
                    echo "<form method=\"POST\" action=\"/Teacher/MyCourses/\" name=\"courses{$i}\" id=\"courses{$i}\"><input hidden name=\"institutionid\" id=\"institutionid\" value=\"$institution_ids[$i]\"><a href=\"#\" onClick=\"document.courses{$i}.submit();return false\">Courses</a></form>";
                ?>
                                  <?php
                    echo "<form method=\"POST\" action=\"/Teacher/MyStudents/\" name=\"students{$i}\" id=\"students{$i}\">
                    <input hidden name=\"institutionid\" id=\"institutionid\" value=\"$institution_ids[$i]\"><a href=\"#\" onClick=\"document.students{$i}.submit();return false\">Students</a></form>";
                ?>
                                      
                                  </li>
                              </ul>
                            </li>
                            <?php
                $i += 1;
            }
                            ?>
                            <li>
                                <a href="/teacher/Archive/Students/">Archive</a>
                                
                            </li>
                            <li>
                                <a href="/corpus/" class="dropdown-toggle" data-toggle="dropdown">Corpus<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">About</a>
                                        <a href="/Corpus/Search/">Search</a></li>
                                </ul>
                            </li>
                            <li class="nav-divider"></li>
                            <li>
                                <a href="#">Change Password</a>
                            </li>
                            <li>
                                <a href="/Logout.php">Logout</a>
                            </li>
                            
                        </ul>
                    </nav>
                    <!-- /#page-content-wrapper -->
                </div>
                <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
                <!-- Include all compiled plugins (below), or include individual files as needed -->
                <script src="js/bootstrap.min.js"></script>
                <script src="js/SidebarPractice.js"></script>
                <script>
                $("#menu-toggle").click(function(e) {
                    e.preventDefault();
                    $("#wrapper").toggleClass("toggled");
                });
                </script>
            </body>
            <?php            
        }
        elseif($_SESSION['Role'] == 'Student')
        {
            /* DB interaction: retrieve student's ID using SiteUsername; lookup all courses in [Enrollment]; print the active ones (with links) and provide a link to "...more" */
            
            
            
            ?>
            <body>
                <div id="wrapper">
                    <div class="overlay"></div>

                    <!-- Sidebar -->
                    <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
                        <ul class="nav sidebar-nav">
                            <li class="sidebar-brand">
                                <a href="/student/home/">Home</a>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown"><?=$_SESSION['Username']?><span class="caret"></span></a>
                                <?php
                if ($NumRoles == 1)
                {
                    ?>
                                <ul class="dropdown-menu" role="menu">
                                    
                                    <li><a>Role: Student</a>
                                    <a>School: Gonzaga</a></li>
                                </ul>
                                <?php
                }
                else
                {
                    ?>
                                <ul class="dropdown-menu" role="menu">
<!--
                                    <li class="dropdown-header">My Roles:</li>
-->
                                    <li>
                                    <?php
                    $count=0;
                    foreach($RolesList as $ListedRole)
                    {
                        if ($ListedRole == $_SESSION['Role'])
                        {
                            ?>
                                        <strong><a><?=$ListedRole?> <small class="text-muted"><?=$Designations[$count]?></small></a></strong>
                                        <?php
                        }
                        else
                        {
                            ?>
                                        <a href="/ChangeRole.php?q=<?=$ListedRole?>&t=<?=$AccessPriv[$count]?>"><?=$ListedRole?> <small class="text-muted"><?=$Designations[$count]?></small></a>
                                        <?php
                        }
                         $count++;   
                        
                    }?>
                                    
                                    </li>
                                </ul>
                    <?php
                }?>
                                
                                
                            
                            </li>
                            <!--<li class="nav-divider"></li>
                            <li class="dropdown">
                                <a href="/student/MyCourses/" class="dropdown-toggle" data-toggle="dropdown">My Courses<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="/Student/MyCourses/">Courses Home</a>
                                        <div class="nav-divider"></div>
                                        <a href="/Student/MyCourses/ViewCourse/?cid=">Course 1</a>
                                        <a href="/Student/MyCourses/ViewCourse/?cid=">Course 2</a>
                                        <a href="/Student/MyCourses/ViewCourse/?cid=">Course 3</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="/student/MyTeachers/" class="dropdown-toggle" data-toggle="dropdown">My Teachers<span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="/student/MyTeachers/">Teachers Home</a>
                                        <div class="nav-divider"></div>
                                        <a href="/student/MyTeachers/ViewTeacherProfile/">   Teacher 1</a>
                                    <a href="/student/MyTeachers/ViewTeacherProfile/">Teacher 2</a>
                                    <a href="/student/MyTeachers/ViewTeacherProfile/">Teacher 3</a></li>
                                </ul>
                            </li>-->
<!--
                            <li><a href="#">Practice!</a></li>
-->
                            <li class="nav-divider"></li>
                            <li><a href="#">Change Password</a></li>
                            <li><a href="/Logout.php">Logout</a></li>
                        </ul>
                    </nav>
                    <!-- /#sidebar-wrapper -->

                </div>
                <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
                <!-- Include all compiled plugins (below), or include individual files as needed -->
                <script src="js/bootstrap.min.js"></script>
                <script src="js/SidebarPractice.js"></script>
                <script>
                $("#menu-toggle").click(function(e) {
                    e.preventDefault();
                    $("#wrapper").toggleClass("toggled");
                });
                </script>
            </body>
            <?php
        }                 
    }
    else
    {
        ?>
        <!-- Reroute to log-in page if there is no session detected -->
        <meta http-equiv='refresh' content='0;index.php' />
        <?php
    }
    ?>    
</html>