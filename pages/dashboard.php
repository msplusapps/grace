<?php
// Get dashboard statistics
$student_count = get_student_count();
$total_payments = get_total_payments();
$payment_chart_data = get_payment_data_for_chart();

// Format chart data
$chart_labels = json_encode(array_column($payment_chart_data, 'date'));
$chart_values = json_encode(array_column($payment_chart_data, 'total'));
?>

<h2>Dashboard</h2>

<div class="dashboard-stats">
    <div class="stat-card">
        <div class="stat-card-icon">
            <i data-feather="users"></i>
        </div>
        <div class="stat-card-info">
            <h4>Total Students</h4>
            <p><?php echo $student_count; ?></p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card-icon">
            <i data-feather="dollar-sign"></i>
        </div>
        <div class="stat-card-info">
            <h4>Total Payments</h4>
            <p>$<?php echo number_format($total_payments, 2); ?></p>
        </div>
    </div>
</div>

<div class="chart-container">
    <h3>Payments in the Last 30 Days</h3>
    <canvas id="paymentsChart"></canvas>
</div>

<script>
    // Pass chart data to JavaScript
    const chartLabels = <?php echo $chart_labels; ?>;
    const chartValues = <?php echo $chart_values; ?>;
</script>
