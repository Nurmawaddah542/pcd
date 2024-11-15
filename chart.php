<?php
include "proses/connect.php";
$query_chart = mysqli_query($conn, "SELECT DATE_FORMAT(tgl_transaksi, '%Y-%m') as bulan, SUM(jumlah) as total_pemasukan FROM tb_transaksi GROUP BY bulan");

$labels = [];
$data = [];

while ($row = mysqli_fetch_assoc($query_chart)) {
    $labels[] = date('F Y', strtotime($row['bulan']));
    $data[] = $row['total_pemasukan'];
}

?>

<style>
    body {
        background-color: #f8f9fa;
    }

    #grad1 {
        background-color: red;
        background-image: linear-gradient(to bottom right, #D8BFD8, #FFDAB9);
        padding: 20px;
        border-radius: 10px;
        margin-top: 20px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="col-lg-9 mt-3">
    <a href="home" class="btn d-flex justify-content-center" style="background-color:rgb(216, 191, 216); width: 100%;">Back</a>
    <div  id="grad1">
        <!-- Line Chart -->
        <div class="card mt-4 border-0 bg-light">
            <div class="card-body text-center">
                <div>
                    <canvas id="myChart"></canvas>
                </div>
                <script>
                    const ctx = document.getElementById('myChart');
                    new Chart(ctx, {
                        type: 'bar', 
                        data: {
                            labels: <?php echo json_encode($labels); ?>,
                            datasets: [{
                                label: 'Total Pemasukan',
                                data: <?php echo json_encode($data); ?>,
                                backgroundColor: 'rgba(216, 191, 216, 0.2)', 
                                borderColor: 'rgb(216, 191, 216)', 
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>
        <!-- End Line Chart -->
    </div>

</div>
