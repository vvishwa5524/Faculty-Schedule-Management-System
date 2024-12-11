<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
<div class="container-fluid mb-4">
  <div class="row">
    <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
      <div class="position-sticky sidebar-sticky">
        <div class="logo-wrap text-center">
          <img src="https://via.placeholder.com/240x60/535353/FFFFFF?text=Placeholder" alt="Company Placeholder Logo" class="logo" />
        </div>
        <ul class="nav flex-column mt-4">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home align-text-bottom" aria-hidden="true">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
              </svg>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file align-text-bottom" aria-hidden="true">
                <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                <polyline points="13 2 13 9 20 9"></polyline>
              </svg>
              Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart align-text-bottom" aria-hidden="true">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
              </svg>
              Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users align-text-bottom" aria-hidden="true">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
              </svg>
              Customers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2 align-text-bottom" aria-hidden="true">
                <line x1="18" y1="20" x2="18" y2="10"></line>
                <line x1="12" y1="20" x2="12" y2="4"></line>
                <line x1="6" y1="20" x2="6" y2="14"></line>
              </svg>
              Reports
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers align-text-bottom" aria-hidden="true">
                <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                <polyline points="2 17 12 22 22 17"></polyline>
                <polyline points="2 12 12 17 22 12"></polyline>
              </svg>
              Integrations
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
          <span>Saved reports</span>
          <a class="link-primary" href="#" aria-label="Add a new report">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle align-text-bottom" aria-hidden="true">
              <circle cx="12" cy="12" r="10"></circle>
              <line x1="12" y1="8" x2="12" y2="16"></line>
              <line x1="8" y1="12" x2="16" y2="12"></line>
            </svg>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text align-text-bottom" aria-hidden="true">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
              </svg>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text align-text-bottom" aria-hidden="true">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
              </svg>
              Last quarter
            </a>
          </li>
        </ul>
      </div>
    </nav>
    <nav class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-md-3 bg-white shadow-sm">
      <div class="row">
        <button class="btn btn-link" id="sidebar-toggle">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
          </svg>
        </button>
        <div class="col-md-4 ps-md-0 ps-4">
          <form role="search">
            <div class="search-group">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
              </svg>
              <input type="search" class="form-control" placeholder="Search..." aria-label="Search" />
            </div>
          </form>
          <!-- ./form -->
        </div>
        <!-- ./col -->
        <div class="col-md-8">

          <div class="dropdown text-end dropdown-usrn">
            <a href="#" class="link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="https://via.placeholder.com/32/D9D9D9/595959?text=PH" alt="mdo" width="32" height="32" class="rounded-circle" />
              decodesalot
            </a>
            <ul class="dropdown-menu text-small">
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li>
                <hr class="dropdown-divider" />
              </li>
              <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
          </div>
          <!-- ./dropdown -->
        </div>
        <!-- ./col -->
      </div>
      <!-- ./row -->
    </nav>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <h1 class="h2 my-4">Dashboard</h1>
      <div class="row g-3 row-cols-1 row-cols-sm-2 row-cols-md-4 row-stats">
        <div class="col">
          <a href="#" class="h-primary-outline">
            <div class="card shadow-sm">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-activity" viewBox="0 0 15 15">
                      <path fill-rule="evenodd" d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2Z" />
                    </svg>
                  </div>
                  <div class="col-md-10">
                    <h3 class="h5">Lorem Ipsum</h3>
                    <p class="m-0 text-muted">
                      Lorem ipsum dolor sit amet, consectetur adipisicing.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </a>
          <!-- link -->
        </div>
        <!-- ./col -->
        <div class="col">
          <a href="#" class="h-primary-outline">
            <div class="card shadow-sm">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                      <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                      <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z" />
                    </svg>
                  </div>
                  <div class="col-md-10">
                    <h3 class="h5">Lorem Ipsum</h3>
                    <p class="m-0 text-muted">
                      Lorem ipsum dolor sit amet, consectetur adipisicing.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </a>
          <!-- link -->
        </div>
        <!-- ./col -->
        <div class="col">
          <a href="#" class="h-primary-outline">
            <div class="card shadow-sm">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z" />
                      <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                    </svg>
                  </div>
                  <div class="col-md-10">
                    <h3 class="h5">Lorem Ipsum</h3>
                    <p class="m-0 text-muted">
                      Lorem ipsum dolor sit amet, consectetur adipisicing.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </a>
          <!-- link -->
        </div>
        <!-- ./col -->
        <div class="col">
          <a href="#" class="h-primary-outline">
            <div class="card shadow-sm">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                      <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                      <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                      <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                    </svg>
                  </div>
                  <div class="col-md-10">
                    <h3 class="h5">Lorem Ipsum</h3>
                    <p class="m-0 text-muted">
                      Lorem ipsum dolor sit amet, consectetur adipisicing.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </a>
          <!-- link -->
        </div>
        <!-- ./col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="card shadow-sm mb-2-sm">
            <div class="card-body p-3 text-center">
              <img src="https://via.placeholder.com/550x225/D9D9D9/595959?text=Placeholder" alt="" class="img-fluid rounded mb-4" />
              <h3 class="h4">Lorem Ipsum Dolor</h3>
              <p class="text-muted">
                Lorem ipsum dolor sit amet consectetur adipisicing elit non
                perspiciatis, obcaecati quae itaque molestias eius.
              </p>
              <a href="#" class="btn btn-primary py-3 px-5">
                Lorem Ipsum Dolor
              </a>
            </div>
            <!-- ./card-body -->
          </div>
          <!-- ./card -->
        </div>
        <!-- ./col -->
        <form method="post">
            <label for="timeframe">Select Time Frame:</label>
            <select name="timeframe" id="timeframe" required onchange="toggleInputs()">
                <option value="">-- Select --</option>
                <option value="week">Week</option>
                <option value="month">Month</option>
                <option value="year">Year</option>
            </select>

            <!-- Additional inputs for week selection -->
            <div id="weekInputs" style="display:none;">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" required>

                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" required>
            </div>

            <!-- Additional inputs for month selection -->
            <div id="monthInputs" style="display:none;">
                <label for="month">Select Month:</label>
                <select name="month" id="month" required>
                    <?php
                    // Generate month options
                    for ($m = 1; $m <= 12; $m++) {
                        echo "<option value='$m'>" . date("F", mktime(0, 0, 0, $m, 1)) . "</option>";
                    }
                    ?>
                </select>
                <label for="year">Select Year:</label>
                <select name="year" id="year" required>
                    <?php
                    // Generate year options (e.g., from 2000 to the current year)
                    $currentYear = date("Y");
                    for ($y = 2000; $y <= $currentYear; $y++) {
                        echo "<option value='$y'>$y</option>";
                    }
                    ?>
                </select>
            </div>
            <input type="submit" value="View Records">
        </form>
        <?php
        // Include your DB connection
        include 'connections.php'; 
        // Error reporting for debugging
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        // Debugging: Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            // Debugging output
            echo "<p>Form submitted successfully.</p>";
            
            // Debugging: Print all POST data
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";

            $timeframe = $_POST['timeframe'];
            
            switch ($timeframe) {
                case 'week':
                    // Get start and end dates
                    $startDate = $_POST['start_date'];
                    $endDate = $_POST['end_date'];
                    $query = "SELECT * FROM teachers WHERE date BETWEEN '$startDate' AND '$endDate' ORDER BY date ASC";
                    break;

                case 'month':
                    // Get selected month and year
                    $selectedMonth = $_POST['month'];
                    $selectedYear = $_POST['year'];

                    // Construct query to select records for the specified month and year
                    $query = "SELECT * FROM teachers WHERE MONTH(date) = '$selectedMonth' AND YEAR(date) = '$selectedYear' ORDER BY date ASC";
                    
                    // Debugging output to confirm query construction
                    echo "<p>Executing query (Month): $query</p>";
                    
                    break;

                case 'year':
                    $query = "SELECT * FROM teachers WHERE YEAR(date) = YEAR(CURDATE()) ORDER BY date ASC";
                    
                    // Debugging output to confirm query construction
                    echo "<p>Executing query (Year): $query</p>";
                    
                    break;

                default:
                    $query = "";
                    break;
            }

            if ($query) {
                // Debugging output before executing the query
                echo "<p>Query before execution: $query</p>";

                // Execute the query
                if ($result = $conn->query($query)) {
                    
                    // Check if result has rows
                    if ($result->num_rows > 0) {
                        echo "<div class='col-12 col-sm-6 col-md-9'>
                                <div class='card shadow-sm'>
                                    <div class='card-body p-3'>
                                        <h2 class='my-0 h3'>Lorem Ipsum</h2>
                                            <div class='table-responsive mt-4 mb-2'>";
                        echo "<table border='1'>
                                <tr>
                                    <th>Date</th>
                                    <th>Day</th>
                                    <th>Period 1</th>
                                    <th>Period 2</th>
                                    <th>Period 3</th>
                                    <th>Period 4</th>
                                    <th>Period 5</th>
                                    <th>Period 6</th>
                                    <th>Period 7</th>
                                </tr>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['date']}</td>
                                    <td>{$row['day']}</td>
                                    <td>{$row['period1']}</td>
                                    <td>{$row['period2']}</td>
                                    <td>{$row['period3']}</td>
                                    <td>{$row['period4']}</td>
                                    <td>{$row['period5']}</td>
                                    <td>{$row['period6']}</td>
                                    <td>{$row['period7']}</td>
                                </tr>";
                        }
                        echo "</table>";
                        echo "</div>
                                </div>
                                </div>
                                </div>";
                    } else {
                        echo "<p>No records found for the selected timeframe.</p>";
                    }
                } else {
                    echo "<p>Error executing query: " . $conn->error . "</p>"; // Show error if execution fails
                }
            } else {
                echo "<p>No valid query was constructed.</p>"; // In case no valid query is set.
            }
        }

        // Close the database connection
        $conn->close();
        ?>

        <!-- ./col -->
      </div>
      <!-- ./row -->
    </main>
  </div>
  <!-- ./row -->
</div>
<!-- ./container-fluid -->
</body>
</html>