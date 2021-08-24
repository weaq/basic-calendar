<?php
$this_date = empty($_REQUEST[d])? date("Y-m-d") : $_REQUEST[d];
$this_day = date("j", strtotime($this_date));
$this_month = date("Y-m-01", strtotime($this_date));
$next_month = date("Y-m-d", strtotime($this_date.  "+ 1 months"));
$prev_month = date("Y-m-d", strtotime($this_date.  "- 1 months"));
$dayInWeek = date('w', strtotime($this_month));
$lastDateMonth = date("t", strtotime($this_month));

echo $this_date;

$dayThai = ['อาทิตย์','จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์'];
$dayTh = ['อา','จ','อ','พ','พฤ','ศ','ส'];
$monthThai = [null,'มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'];
$monthTh = [null,'ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Carlendar Responsive</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <style>
  * {
    box-sizing: border-box;
  }

  *:before {
    box-sizing: border-box;
  }

  *:after {
    box-sizing: border-box;
  }

  .container {
    max-width: 1000px;
    margin-left: auto;
    margin-right: auto;
    padding-bottom: 1em;
  }

  .row:before {
    display: table;
    content: " ";
  }

  .grid-calendar {
    min-width: 320px;
  }
  .grid-calendar .row {
    margin: 0;
  }
  .grid-calendar .calendar-week .grid-cell {
    background-color: #f6f6f6;
    border: 1px solid #fff;
  }
  .grid-calendar .calendar-week-header .grid-cell > div > div {
    padding-bottom: 10px;
    height: auto;
  }
  .grid-calendar .grid-cell {
    display: inline-block;
    float: left;
    min-height: 1px;
    padding: 0;
    position: relative;
    width: 14.2857142857%;
  }
  .grid-calendar .grid-cell.over-month {
    color: #a6a6a6;
    font-size: 0.8em;
  }
  .grid-calendar .grid-cell.next-month {
    background-color: #e1e1e1;
  }
  .grid-calendar .grid-cell > div {
    display: flex;
    justify-content: center;
    width: 100%;
  }
  .grid-calendar .grid-cell > div > div {
    height: 0;
    padding: 10% 0 60% 0;
    font-size: 1.5em;
  }

  a:link, a:visited {
    text-decoration: none;
    color: LightGray;
  }

  a:hover, a:active {
    text-decoration: none;
    color: DimGray;
  }

  .grid-calendar .grid-cell.this-date {
    background-color: LightSeaGreen;
    color: white;
  }

  .text-detail {
    color: #a6a6a6;
    font-size: 0.8em;
  }

  </style>
</head>

<body>
  <div class="container">
  <div class="row text-center">
    <div class="col-2 display-4"><a href="<?php echo "?d=" . $prev_month; ?>">&#10094;</a></div>
    <div class="col-8 h2">
        <?php echo $monthThai[date("n", strtotime($this_month))]; ?>
        <br>
        <span class="h2">
        <?php echo date("Y", strtotime($this_month)); ?>
        </span>
    </div>
    <div class="col-2 display-4"><a href="<?php echo "?d=" . $next_month; ?>">&#10095;</a></div>
  </div>
	<div class="grid-calendar">
		<div class="row calendar-week-header">
      <?php
        for($i=0;$i<count($dayTh);$i++) {
          echo '<div class="col-xs-1 grid-cell"><div><div><span>' . $dayTh[$i] . '</span></div></div></div>' . "\n";
        }
       ?>
		</div>
    <?php
    $lastPrevMonth = date("t", strtotime($prev_month));
    $ii = 0;
      for ($i=(($dayInWeek-1)*-1);$i<=$lastDateMonth;$i++) {
        if ($i<=0) {
          $tmp_date = $lastPrevMonth + $i;
          $tmp_style = " over-month";
          $i_d = $i - 1;
          $tmp_link_date = date("Y-m-d", strtotime($this_month . $i_d . " days"));

        } else {
          $tmp_date = $i;
          $tmp_link_date = date("Y-m-", strtotime($this_month)) . str_pad($i, 2, "0", STR_PAD_LEFT);

          if ($i == date("j", strtotime($this_date)) ) {
            $tmp_style = " this-date";
          } else {
            $tmp_style = "";
          }
        }

        // close div
        if ($ii % 7 == 0 AND $ii / 7 >= 1) {
          echo '</div>';
        }
        // mod 7
        if ($ii % 7 == 0) {
          echo '<div class="row calendar-week">';
        }
        echo '<div class="col-xs-1 grid-cell ' . $tmp_style . '"><div><div>' .
        '<a href="?d=' . $tmp_link_date . '"><div class="text-center">' . $tmp_date . '<div class="text-detail">' . $tmp_link_date . '</div></div></a>' .
        '</div></div></div>';
        $ii++;
      }

      // date at next month
      $tmp_fist_next_date = 7 - ($ii % 7);
      if ($tmp_fist_next_date < 7) {
        for ($i=1;$i<=$tmp_fist_next_date;$i++) {
          $tmp_date = $i;
          $tmp_link_date = date("Y-m-", strtotime($this_month)) . str_pad($i, 2, "0", STR_PAD_LEFT);
          //echo '<div class="col-xs-1 grid-cell over-month"><div><div><span>' . $tmp_date . '</span></div></div></div>';
          echo '<div class="col-xs-1 grid-cell over-month ' . $tmp_style . '"><div><div>' .
          '<a href="?d=' . $tmp_link_date . '"><div class="text-center">' . $tmp_date . '<div class="text-detail">' . $tmp_link_date . '</div></div></a>' .
          '</div></div></div>';
        }
      }
      echo '</div>';
    ?>



	</div>
</div>

</body>

</html>
