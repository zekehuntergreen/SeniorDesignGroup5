<?php include "../../base.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> Gonzaga Small Talk</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/simple-sidebar.css" rel="stylesheet">
    <link href="/css/SidebarPractice.css" rel="stylesheet">
    <link href="/FlatUI/css/theme.css" rel="stylesheet" media="screen">

    <!-- Including Header -->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="/js/SidebarPractice.js"></script>
    <script>
        $(function(){
            $("#header").load("/header.php");
        });
        $(function(){
            $("#sidebar").load("/sidebar.php");
        });
    </script>

</head>

<?php
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
{
    if($_SESSION['Role'] != 'Admin')
    {
        ?>
        <p>You do not have permission to view this page.  Redirecting in 5 seconds</p>
        <p>Click <a href="/">here</a> if you don't want to wait</p>
        <meta http-equiv='refresh' content='5;/' />
        <?php
    }
    else
    {
        ?>
        <body>
            <div id="wrapper">
                <div id="sidebar"></div>
                <div id="page-content-wrapper">
                    <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                                    <span class="hamb-top"></span>
                                    <span class="hamb-middle"></span>
                                    <span class="hamb-bottom"></span>
                    </button>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-10 col-xs-10">
                                <h1>Smalltalk Site Users</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-8">
                                
                                <div class="panel panel-primary">
                                    <div class="panel-heading">Add New User</div>
                                    <div class="panel-body">
                                         <form method="POST" id="filterActivityQueue" action="">
                                            <div class="form-group row">
                                                
                                                
                                                <div class="col-lg-4">
                                                    <input class="form-control" type="text" name="fname" id="fname" placeholder="First Name" /><br />
                                                    <input class="form-control" type="text" name="Email" id="Email" placeholder="School Email" /><br />
                                                    
                                                </div>
                                                <div class="col-lg-4">
                                                    <input class="form-control" type="text" name="lname" id="lame" placeholder="Last Name" /><br />
                                                    
                                                    
                                                </div>
                                                <div class="col-lg-4">
                                                    
                                                <select class="form-control" name="Designation" id="Section">
                                                    <option selected="selected">--Designation--</option>
                                                    <option>Primary</option>
                                                    <option>Other</option>
                                                </select>
                                                </div>
                                                
                                                
                                            </div>
                                             <button type="submit" class="btn btn-primary pull-right">Add Teacher</button>
                                        </form>
                                    </div>
                                </div>
                                
                                    
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-4">
                                
                                
                                <div class="panel panel-primary" style="min-height: 225px;max-height: 225px;">
                                    <div class="panel-heading">Add New Teacher (By File)</div>
                                    <div class="panel-body">
                                        <form>
                                             <div class="form-group">
                                                <input type="file" id="studentListFile">
                                                <p class="help-block">File format: .csv</p>
                                                <p class="help-block">Columns (no headers): First Name, Last Name, Email, Alternate Email, Designation</p>
                                            </div>
                                            <button type="submit" class="btn btn-primary pull-right">Add Teacher</button>
                                        </form>
                                    </div>
                                </div>
                                
                                    
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9 col-md-9">

                                <div class="panel panel-primary" style="min-height: 400px; max-height: 400px; ">
                                    <div class="panel-heading">Site Users</div>
                                    <div class="panel-body">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <td>Username</td>
                                                    <td>Name</td>
                                                    <td>Date Added</td>
                                                    <td>Alter</td>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php
        $params = array();
        $options = array( "Scrollable" => 'static' );
        $siteusersSQL = "SELECT SU.username, SU.firstname, SU.lastname, SU.date_added, R.Role
                         FROM SiteUsers SU, RoleInstances RI, Roles R
                         WHERE RI.SiteUsername = SU.username AND
                               R.RoleID = RI.RoleID";
        $siteusers = sqlsrv_query($con, $siteusersSQL, $params, $options);
        if ($siteusers === false)
            die(print_r(sqlsrv_errors(), true));
        $num_users = sqlsrv_num_rows($siteusers);
        $usernames = [];
        $firstnames = [];
        $lastnames = [];
        $dates = [];
        $roles = [];
                                                <tr>
                                                    
                                                    <td>Gonzaga University</td>
                                                    <td>T. Cher</td>
                                                    <td>3/3/2016</td>
                                                    <td><a href="ViewTeacherProfile/">View Teacher</a>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="/js/bootstrap.min.js"></script>
            <script src="/js/bootstrap-datepicker.js"></script>
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
    <p>Oops! You are not logged in.  Redirecting to log-in in 5 seconds</p>
    <p>Click <a href="/">here</a> if you don't want to wait</p>
    <meta http-equiv='refresh' content='5;/' />
    <?php
}
?>

</html>