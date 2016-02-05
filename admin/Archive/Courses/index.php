<?php include "../../../base.php"; ?>
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


    <!-- Including Header -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script>
        $(function(){
            $("#header").load("/header.php");
        });
        $(function(){
            $("#sidebar").load("/sidebar.php");
        });
    </script>

    <!-- Background Setup -->
    <style>
        body{
            background: url(/Media/gonzagasmalltalk_background.png) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: auto;
        }
    </style>
</head>

<?php
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
{
    if($_SESSION['Role'] != 'admin')
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
            <div id="header"></div>           
            <div id="wrapper">
                <div id="sidebar"></div>
                <div id="page-content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Collapse/Expand</a>
                                <div class="panel panel-primary">
                                    <div class="panel-heading">Documentation</div>
                                    <div class="panel-body">
                                        <p>Provides search interface for looking up courses in the DB. Would then display list of worksheets in the class, or, alternatively (tabs) all worksheets/expressions submitted by the teacher</p>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">Course Listing (sort by most recent)</div>
                                    <div class="panel-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td>Course Number</td>
                                                    <td>Class Name</td>
                                                    <td>Instructor Last Name</td>
                                                    <td>Session ID</td>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            <?php
                                                $params = array();
                                                $options = array( "Scrollable" => SQLSRV_CURSOR_FORWARD );
                                                $query = "SELECT CN.[Course #] as \"Course Number\", CN.[ClassName] as \"Class Name\", A.[Advisor] as \"Instructor Last Name\", TC.[SessionID] as \"Session ID\" FROM [Teachers&Classes] as TC, [Advisor] as A, [Class Names] as CN WHERE TC.[ClassNamesID] = CN.[ClassNamesID] AND TC.[Instructor] = A.[ID] AND TC.[SessionID] > 130 ORDER BY TC.[SessionID] desc";
                                                $stmt = sqlsrv_query($con, $query, $params, $options);
                                                while($row = sqlsrv_fetch_array($stmt))
                                                {?>
                                                    <tr>
                                                        <td><?php echo $row['Course Number']?></td>
                                                        <td><?php echo $row['Class Name']?></td>
                                                        <td><?php echo $row['Instructor Last Name']?></td>
                                                        <td><?php echo $row['Session ID']?></td>
                                                    </tr>
                                                <?php
                                                }?>
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
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <!-- Include all compiled plugins (below), or include individual files as needed -->
            <script src="/js/bootstrap.min.js"></script>
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
