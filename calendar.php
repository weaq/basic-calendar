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

  <link rel="stylesheet" type="text/css" href="calendar.css">

</head>

<body>
  <div class="container">
  <div class="row text-center">
    <div class="col-2 display-4"><a href="<?php echo "?d=" . $prev_month; ?>">&#10094;</a></div>
    <div class="col-8 h2">
      <span class="h2">
        <?php echo $monthThai[date("n", strtotime($this_month))]; ?> &nbsp;
        <?php echo date("Y", strtotime($this_month)) + 543; ?>
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
        '<a href="?d=' . $tmp_link_date . '" class="' . $tmp_style . '"><div class="text-center">' . $tmp_date . '<div class="text-detail">' . $tmp_link_date . '</div></div></a>' .
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
          '<a href="?d=' . $tmp_link_date . '" class="over-month"><div class="text-center">' . $tmp_date . '<div class="text-detail">' . $tmp_link_date . '</div></div></a>' .
          '</div></div></div>';
        }
      }
      echo '</div>';
    ?>



	</div>
</div>

</body>

</html>
