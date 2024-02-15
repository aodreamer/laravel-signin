@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="white-text">Daftar File</h2>
    <div class="row">
        @foreach ($files as $file)
            <div class="col-md-4">
                <div class="card mb-4 clickable-card" onclick="window.location='{{ route('jdih.download', $file->id) }}'">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div style="height: 100px;">
                            <a class="card-title no-underline font-weight-bold" style="margin-bottom: 8px;">{{ $file->filename }}</a>
                            
                            <!-- Menampilkan nama label dari ID pada tabel files -->
                            <p class="card-text mt-auto">
                                Labels: 
                                @foreach(explode(',', $file->labels) as $labelId)
                                    @php
                                        $label = $labels->where('id', $labelId)->first();
                                        $colors = ['#3498db', '#e74c3c', '#2ecc71', '#f39c12', '#9b59b6', '#1abc9c']; // Palet warna tetap
                                        $color = $colors[$loop->index % count($colors)]; // Bergantian dari palet warna
                                    @endphp
                                    <span class="label" style="background-color: {{ $color }}; color: white; padding: 4px; border-radius: 4px;">{{ $label->name }}</span>
                                @endforeach
                            </p>
                            <p class="card-text mt-auto">
                                Waktu Upload: {{ $file->date_upload}}
                            </p>
                            <p class="card-text mt-auto">
                                Jumlah download: {{ $file->download_count}}
                            </p>
                        </div>
                        <hr style="border-top: 1px solid #ccc; margin: 5px 0;">
                        <p class="card-text mt-auto">Pengunggah: {{ $file->author->name }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div>
    <div style="margin: 0.5em;">
      <canvas style="width: 100%; height: 20em;" id="myPieChart"></canvas>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('myPieChart').getContext('2d');
        var labelPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode(array_keys($labelCounts)) !!},
                datasets: [{
                    data: {!! json_encode(array_values($labelCounts)) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        // Add more colors as needed
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        // Add more colors as needed
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    });
</script>

<canvas id="line-chart"></canvas>
<script>
	new Chart(document.getElementById("line-chart"), {
		type : 'line',
		data : {
			labels : @json(array_keys($uploadsPerMonth)),
			datasets : [
					{
						data : @json(array_values($uploadsPerMonth)),
						label : @json(array_keys($uploadsPerMonth)),
						borderColor : "#3cba9f",
						fill : false
					}]
		},
		options : {
			title : {
				display : true,
				text : 'Chart JS Line Chart Example'
			}
		}
	});
</script>
<div style="width: 50%;">
    <canvas id="downloadChart"></canvas>
</div>

<script>
    // JavaScript logic to create and update charts
    var topDownloads = {!! json_encode($topDownloads->pluck('download_count')) !!};
    
    var downloadChart = new Chart(document.getElementById('downloadChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($topDownloads->pluck('filename')) !!},
            datasets: [{
                label: 'Downloads',
                data: topDownloads,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
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

<div style="width: 50%;">
    <canvas id="verificationChart"></canvas>
</div>

<script>
    // JavaScript logic to create and update charts
    var verifications = {!! json_encode([$verifications->verification_success, $verifications->verification_failure]) !!};
    
    var verificationChart = new Chart(document.getElementById('verificationChart').getContext('2d'), {
        type: 'pie',
        data: {
            labels: ['Verification Success', 'Verification Failure'],
            datasets: [{
                data: verifications,
                backgroundColor: ['green', 'red']
            }]
        }
    });
</script>

@endsection

<style>
    /* Add your CSS styles here */
    .clickable-card {
        height: 200px !important; /* Set the fixed height to 400px */
        overflow: hidden; /* Hide any content that exceeds the fixed height */
        cursor: pointer; /* Change the cursor to a pointer when hovering over the card to indicate it's clickable */
        border-radius: 20px; /* Increase the border-radius to make the card more rounded */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.10); /* Increase the shadow intensity to make it more noticeable */
        transition: all 0.3s ease-in-out; /* Add a smooth transition effect on hover */
    }

    /* Apply the shadow and transform the card slightly on hover */
    .clickable-card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3); /* Increase the shadow intensity on hover */
        transform: scale(1.05); /* Slightly scale up the card on hover */
    }

    /* Remove underline from the card title link */
    .no-underline {
        text-decoration: none;
    }

    /* Add bold font-weight to the card title */
    .font-weight-bold {
        font-weight: bold;

    }
    body {
        margin:0;
        padding:0;
        font-family: sans-serif;
        background: linear-gradient(#333, #333);
    }
    .white-text {
  color: white;
  font-size: 24px; /* Optional: You can adjust the font size as per your requirement */
}

</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>