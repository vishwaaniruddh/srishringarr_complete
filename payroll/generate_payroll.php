<?php require_once(dirname(__FILE__) . '/config.php');
if (!isset($_SESSION['Admin_ID']) || $_SESSION['Login_Type'] != 'admin') {
    header('location:' . BASE_URL);
}
date_default_timezone_set('Asia/Kolkata');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" type="image/png" href="https://srishringarr.com/static/images/icons/favicon.png" />
    <title>Generate Payroll - Payroll</title>

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/datatables/jquery.dataTables_themeroller.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/skins/_all-skins.min.css">

    <!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php require_once(dirname(__FILE__) . '/partials/topnav.php'); ?>

        <?php require_once(dirname(__FILE__) . '/partials/sidenav.php'); ?>

        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Attendance
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo BASE_URL; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Attendance</li>
                </ol>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body">
                                <div class="card" id="filter">
                                    <div class="card-block">
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <label>Activity</label>
                                                    <select name="activity" class="form-control" id="month">
                                                        <option value=""> Select Month</option>
                                                        <option value="NOVEMBER 2020" <?php if ($my == 'NOVEMBER 2020') echo "selected"; ?>>NOVEMBER 2020</option>
                                                        <option value="OCTOBER 2020" <?php if ($my == 'OCTOBER 2020') echo "selected"; ?>>OCTOBER 2020</option>
                                                        <option value="SEPTEMBER 2020" <?php if ($my == 'SEPTEMBER 2020') echo "selected"; ?>>SEPTEMBER 2020</option>
                                                        <option value="AUGUST 2020" <?php if ($my == 'AUGUST 2020') echo "selected"; ?>>AUGUST 2020</option>
                                                        <option value="MARCH 2020" <?php if ($my == 'MARCH 2020') echo "selected"; ?>>MARCH 2020</option>
                                                        <option value="FEBRUARY 2020" <?php if ($my == 'FEBRUARY 2020') echo "selected"; ?>>FEBRUARY 2020</option>
                                                        <option value="JANUARY 2020" <?php if ($my == 'JANUARY 2020') echo "selected"; ?>>JANUARY 2020</option>
                                                        <option value="DECEMBER 2019" <?php if ($my == 'DECEMBER 2019') echo "selected"; ?>>DECEMBER 2019</option>
                                                        <option value="NOVEMBER 2019" <?php if ($my == 'NOVEMBER 2019') echo "selected"; ?>>NOVEMBER 2019</option>
                                                        <option value="OCTOBER 2019" <?php if ($my == 'OCTOBER 2019') echo "selected"; ?>>OCTOBER 2019</option>
                                                        <option value="SEPTEMBER 2019" <?php if ($my == 'SEPTEMBER 2019') echo "selected"; ?>>SEPTEMBER 2019</option>
                                                        <option value="AUGUST 2019" <?php if ($my == 'AUGUST 2019') echo "selected"; ?>>AUGUST 2019</option>
                                                        <option value="july 2019" <?php if ($my == 'july 2019') echo "selected"; ?>>july 2019</option>
                                                        <option value="june 2019" <?php if ($my == 'june 2019') echo "selected"; ?>>june 2019</option>
                                                        <option value="MAY 2019" <?php if ($my == 'may 2019') echo "selected"; ?>>may 2019</option>
                                                        <option value="APRIL 2019" <?php if ($my == 'APRIL 2019') echo "selected"; ?>>APRIL 2019</option>
                                                        <option value="MARCH 2019" <?php if ($my == 'MARCH 2019') echo "selected"; ?>>MARCH 2019</option>
                                                        <option value="FEBRUARY 2019" <?php if ($my == 'FEBRUARY 2019') echo "selected"; ?>>FEBRUARY 2019</option>
                                                        <option value="JANUARY 2019" <?php if ($my == 'JANUARY 2019') echo "selected"; ?>>JANUARY 2019</option>
                                                        <option value="DECEMBER 2018" <?php if ($my == 'DECEMBER 2018') echo "selected"; ?>>DECEMBER 2018</option>
                                                        <option value="NOVEMBER_2018" <?php if ($my == 'NOVEMBER_2018') echo "selected"; ?>>NOVEMBER 2018</option>
                                                        <option value="OCTOBER 2018" <?php if ($my == 'OCTOBER 2018') echo "selected"; ?>>OCTOBER 2018</option>
                                                        <option value="SEPTEMBER 2018" <?php if ($my == 'SEPTEMBER 2018') echo "selected"; ?>>SEPTEMBER 2018</option>
                                                        <option value="AUGUST 2018" <?php if ($my == 'AUGUST 2018') echo "selected"; ?>>AUGUST 2018</option>
                                                        <option value="july 2018" <?php if ($my == 'july 2018') echo "selected"; ?>>july 2018</option>
                                                        <option value="june 2018" <?php if ($my == 'june 2018') echo "selected"; ?>>june 2018</option>
                                                        <option value="may 2018" <?php if ($my == 'may 2018') echo "selected"; ?>>may 2018</option>
                                                        <option value="APRIL 2018" <?php if ($my == 'APRIL 2018') echo "selected"; ?>>APRIL 2018</option>
                                                        <option value="MARCH 2018" <?php if ($my == 'MARCH 2018') echo "selected"; ?>>MARCH 2018</option>
                                                        <option value="FEBRUARY 2018" <?php if ($my == 'FEBRUARY 2018') echo "selected"; ?>>FEBRUARY 2018</option>
                                                        <option value="JANUARY 2018" <?php if ($my == 'JANUARY 2018') echo "selected"; ?>>JANUARY 2018</option>
                                                        <option value="DECEMBER 2017" <?php if ($my == 'DECEMBER 2017') echo "selected"; ?>>DECEMBER 2017</option>
                                                        <option value="NOVEMBER 2017" <?php if ($my == 'NOVEMBER 2017') echo "selected"; ?>>NOVEMBER 2017</option>
                                                        <option value="OCTOBER 2017" <?php if ($my == 'OCTOBER 2017') echo "selected"; ?>>OCTOBER 2017</option>
                                                        <option value="SEPTEMBER 2017" <?php if ($my == 'SEPTEMBER 2017') echo "selected"; ?>>SEPTEMBER 2017</option>
                                                        <option value="AUGUST 2017" <?php if ($my == 'AUGUST 2017') echo "selected"; ?>>AUGUST 2017</option>
                                                        <option value="JULY 2017" <?php if ($my == 'JULY 2017') echo "selected"; ?>>JULY 2017</option>
                                                        <option value="JUNE 2017" <?php if ($my == 'JUNE 2017') echo "selected"; ?>>JUNE 2017</option>
                                                        <option value="MAY 2017" <?php if ($my == 'MAY 2017') echo "selected"; ?>>MAY 2017</option>
                                                        <option value="APRIL 2017" <?php if ($my == 'APRIL 2017') echo "selected"; ?>>APRIL 2017</option>
                                                        <option value="MARCH 2017" <?php if ($my == 'MARCH 2017') echo "selected"; ?>>MARCH 2017</option>
                                                        <option value="FEBRUARY 2017" <?php if ($my == 'FEBRUARY 2017') echo "selected"; ?>>FEBRUARY 2017</option>
                                                        <option value="JANUARY 2017" <?php if ($my == 'JANUARY 2017') echo "selected"; ?>>JANUARY 2017</option>
                                                        <option value="DECEMBER 2016" <?php if ($my == 'DECEMBER 2016') echo "selected"; ?>>DECEMBER 2016</option>
                                                        <option value="NOVEMBER 2016" <?php if ($my == 'NOVEMBER 2016') echo "selected"; ?>>NOVEMBER 2016</option>
                                                        <option value="OCTOBER 2016" <?php if ($my == 'OCTOBER 2016') echo "selected"; ?>>OCTOBER 2016</option>
                                                        <option value="SEPTEMBER 2016" <?php if ($my == 'SEPTEMBER 2016') echo "selected"; ?>>SEPTEMBER 2016</option>
                                                        <option value="AUGUST 2016" <?php if ($my == 'AUGUST 2016') echo "selected"; ?>>AUGUST 2016</option>
                                                        <option value="JULY 2016" <?php if ($my == 'JULY 2016') echo "selected"; ?>>JULY 2016</option>
                                                        <option value="JUNE 2016" <?php if ($my == 'JUNE 2016') echo "selected"; ?>>JUNE 2016</option>
                                                        <option value="MAY 2016" <?php if ($my == 'MAY 2016') echo "selected"; ?>>MAY 2016</option>
                                                        <option value="APRIL 2016" <?php if ($my == 'APRIL 2016') echo "selected"; ?>>APRIL 2016</option>
                                                        <option value="MARCH 2016" <?php if ($my == 'MARCH 2016') echo "selected"; ?>>MARCH 2016</option>
                                                        <option value="FEBRUARY 2016" <?php if ($my == 'FEBRUARY 2016') echo "selected"; ?>>FEBRUARY 2016</option>
                                                        <option value="JANUARY 2016" <?php if ($my == 'JANUARY 2016') echo "selected"; ?>>JANUARY 2016</option>
                                                        <option value="DECEMBER 2015" <?php if ($my == 'DECEMBER 2015') echo "selected"; ?>>DECEMBER 2015</option>
                                                        <option value="NOVEMBER 2015" <?php if ($my == 'NOVEMBER 2015') echo "selected"; ?>>NOVEMBER 2015</option>
                                                        <option value="OCTOBER 2015" <?php if ($my == 'OCTOBER 2015') echo "selected"; ?>>OCTOBER 2015</option>
                                                        <option value="SEPTEMBER 2015" <?php if ($my == 'SEPTEMBER 2015') echo "selected"; ?>>SEPTEMBER 2015</option>
                                                        <option value="AUGUST 2015" <?php if ($my == 'AUGUST 2015') echo "selected"; ?>>AUGUST 2015</option>
                                                        <option value="JULY 2015" <?php if ($my == 'JULY 2015') echo "selected"; ?>>JULY 2015</option>
                                                        <option value="JUNE 2015" <?php if ($my == 'JUNE 2015') echo "selected"; ?>>JUNE 2015</option>
                                                        <option value="MAY 2015" <?php if ($my == 'MAY 2015') echo "selected"; ?>>MAY 2015</option>
                                                        <option value="APRIL 2015" <?php if ($my == 'APRIL 2015') echo "selected"; ?>>APRIL 2015</option>
                                                        <option value="MARCH 2015" <?php if ($my == 'MARCH 2015') echo "selected"; ?>>MARCH 2015</option>
                                                        <option value="FEBRUARY 2015" <?php if ($my == 'FEBRUARY 2015') echo "selected"; ?>>FEBRUARY 2015</option>
                                                        <option value="JANUARY 2015" <?php if ($my == 'JANUARY 2015') echo "selected"; ?>>JANUARY 2015</option>
                                                    </select>
                                                </div>


                                            </div>

                                            <div class="col" style="display:flex;justify-content:center;">
                                                <input type="submit" name="submit" value="Filter" class="btn btn-primary">
                                            </div>


                                        </form>

                                        <!--Filter End -->
                                        <hr>

                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>

                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Employee Attendance</h3>
                            </div>



                            <div class="box-body">
                                <div class="table-responsiove">
                                    <table id="generate_payroll" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Total Time</th>
                                                <th>Total Min</th>
                                                <th>NetSalary</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <footer class="main-footer">
            <strong> &copy; <?php echo date("Y"); ?> Payroll Management System | </strong> Developed By SAR Solutions Pvt. Ltd.
        </footer>
    </div>

    <script src="<?php echo BASE_URL; ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="<?php echo BASE_URL; ?>bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL; ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo BASE_URL; ?>plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL; ?>plugins/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="<?php echo BASE_URL; ?>dist/js/app.min.js"></script>
    <script type="text/javascript">
        var baseurl = '<?php echo BASE_URL; ?>';
    </script>
    <script src="<?php echo BASE_URL; ?>dist/js/script.js?rand=<?php echo rand(); ?>"></script>
</body>

</html>