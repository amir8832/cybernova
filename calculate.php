<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>محاسبه سود سپرده و وام</title>
  <link rel="stylesheet" href="calculate-style.css">
</head>
<body>


  <h1 class="title">محاسبه سود سپرده و وام</h1>

  <div class="container">

    <!-- محاسبه سود و اقساط وام -->
    <form method="post" class="box">
      <div class="box-title">محاسبه سود و اقساط وام</div>

      <label class="input-label" for="loan_amount">مبلغ وام (تومان):</label>
      <input class="input-field" type="number" name="loan_amount" id="loan_amount" placeholder="مثلاً 50000000" required>

      <label class="input-label" for="loan_rate">نرخ سود سالانه (%):</label>
      <input class="input-field" type="number" name="loan_rate" id="loan_rate" placeholder="مثلاً 18" required>

      <label class="input-label" for="loan_months">مدت وام (ماه):</label>
      <input class="input-field" type="number" name="loan_months" id="loan_months" placeholder="مثلاً 24" required>

      <button class="btn" type="submit" name="calculate_loan">محاسبه</button>

      <?php
        if (isset($_POST['calculate_loan'])) {
            $amount = $_POST['loan_amount'];
            $rate = $_POST['loan_rate'];
            $months = $_POST['loan_months'];

            $monthly_rate = ($rate / 100) / 12;
            $installment = ($amount * $monthly_rate) / (1 - pow(1 + $monthly_rate, -$months));
            $total = $installment * $months;
            $interest = $total - $amount;

            echo "<p>قسط ماهانه: <strong>" . number_format($installment) . "</strong> تومان</p>";
            echo "<p>کل سود پرداختی: <strong>" . number_format($interest) . "</strong> تومان</p>";
            echo "<p>جمع کل پرداخت: <strong>" . number_format($total) . "</strong> تومان</p>";
        }
      ?>
    </form>

    <!-- محاسبه سود سپرده -->
    <form method="post" class="box">
      <div class="box-title">محاسبه سود سپرده</div>

      <label class="input-label" for="deposit_amount">مبلغ سپرده (تومان):</label>
      <input class="input-field" type="number" name="deposit_amount" id="deposit_amount" placeholder="مثلاً 100000000" required>

      <label class="input-label" for="deposit_rate">نرخ سود سالانه (%):</label>
      <input class="input-field" type="number" name="deposit_rate" id="deposit_rate" placeholder="مثلاً 15" required>

      <label class="input-label" for="deposit_months">مدت سپرده (ماه):</label>
      <input class="input-field" type="number" name="deposit_months" id="deposit_months" placeholder="مثلاً 12" required>

      <button class="btn" type="submit" name="calculate_deposit">محاسبه</button>

      <?php
        if (isset($_POST['calculate_deposit'])) {
            $amount = $_POST['deposit_amount'];
            $rate = $_POST['deposit_rate'];
            $months = $_POST['deposit_months'];

            $interest = ($amount * ($rate / 100)) * ($months / 12);

            echo "<p>سود سپرده: <strong>" . number_format($interest) . "</strong> تومان</p>";
            echo "<p>جمع کل دریافتی: <strong>" . number_format($interest + $amount) . "</strong> تومان</p>";
        }
      ?>
    </form>

  </div>

</body>
</html>

