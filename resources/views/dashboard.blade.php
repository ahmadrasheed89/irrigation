<x-app-layout>

				<!-- Content area -->
				<div class="content">




					<!-- Dashboard content -->
					<div class="row">
						<div class="col-xl-8 flipOutX">



							<!-- Quick stats boxes -->
							<div class="row">
								<div class="col-lg-4">

									<!-- Members online -->
									<div class="card bg-teal text-white">
										<div class="card-body">
											<div class="d-flex">
												<h3 class="mb-0">{{ $stats['adps'] }}</h3>
						                	</div>

						                	<div>
												ADPs
											</div>
										</div>

										<a href="{{ route('adps.dashboard') }}" class="btn btn-secondary btn-medium ">View All</a>
									</div>

									<!-- /members online -->

								</div>

								<div class="col-lg-4">

									<!-- Current server load -->
									<div class="card bg-pink text-white">
										<div class="card-body">
											<div class="d-flex align-items-center">
												<h3 class="mb-0">{{ $stats['tenders'] }}</h3>
						                	</div>

						                	<div>
												Tenders
											</div>
										</div>

										<a href="{{ route('tenders.index') }}" class="btn btn-danger btn-medium">View All</a>
									</div>
									<!-- /current server load -->

								</div>

								<div class="col-lg-4">

									<!-- Today's revenue -->
									<div class="card bg-primary text-white">
										<div class="card-body">
											<div class="d-flex align-items-center">
												<h3 class="mb-0">{{ $stats['nocs'] }}</h3>
												<div class="ms-auto">
							                		<a class="text-white" data-card-action="reload">
							                			<i class="ph-arrows-clockwise"></i>
							                		</a>
							                	</div>
						                	</div>

						                	<div>
												NOCs
											</div>
										</div>

										<a href="{{ route('nocs.index') }}" class="btn btn-primary btn-medium">View All</a>
									</div>
									<!-- /today's revenue -->

								</div>
							</div>
							<!-- /quick stats boxes -->

                            <!-- Quick stats boxes -->
							<div class="row">
                                <!-- Charts Section -->

                                <div class="col-md-6">
                                    <div class="card shadow-sm border-0 p-4">
                                        <h5 class="mb-3 fw-bold">📊 Monthly Schemes vs Tenders</h5>
                                        <canvas id="barChart" height="430"></canvas>
                                    </div>
                                </div>

								<div class="col-lg-6">
                                    <div class="card shadow-sm border-0 p-4">
                                        <h5 class="mb-3 fw-bold">🥧 Tenders by Category</h5>
                                        <canvas id="pieChart" height="130"></canvas>
                                    </div>
								</div>

							</div>
							<!-- /quick stats boxes -->



						</div>

						<div class="col-xl-4">

							<!-- Daily sales -->
							<div class="card">
								<div class="card-header d-flex align-items-center">
									<h5 class="mb-0">Latest ADPs Summary</h5>
									<div class="d-flex align-items-center ms-auto">

									</div>
								</div>

								<div class="card-body">
									<div class="chart" id="sales-heatmap"></div>
								</div>

								<div class="table-responsive">
									<table class="table text-nowrap">
										<thead>
											<tr>
												<th class="w-100">ADP Code</th>
												<th>Allocation</th>
												<th>Expenditure</th>
											</tr>
										</thead>
										<tbody>
                                            @php
                                                $i = 0;
                                            @endphp
                                            @forelse($adps as $adp)
                                            @php
                                                $i++;
                                                if($i == 5) {
                                                    $i=1;
                                                }
                                            @endphp
											<tr>
												<td>
													<div class="d-flex align-items-center">
														<a href="#" class="d-inline-block me-3">
															<img src="https://themes.kopyov.com/limitless/demo/template/assets/images/demo/logos/{{ $i }}.svg" alt="" height="36">
														</a>
														<div>
															<a href="{{ route('adps.schemedetail', $adp) }}" class="text-body fw-semibold letter-icon-title">{{ $adp->adp_code ?? '-' }}</a>
														</div>
													</div>
												</td>
												<td>
													<span class="text-muted">{{ number_format($adp->allocation, 2) ?? '-' }}</span>
												</td>
												<td>
													<strong>{{ number_format($adp->schemes_sum_expenditure ?? 0, 2) ?? '-'}}</strong>
												</td>
											</tr>

                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">No ADPs found.</td>
                                                </tr>
                                            @endforelse


										</tbody>
									</table>
								</div>
							</div>
							<!-- /daily sales -->

						</div>
					</div>
					<!-- /dashboard content -->

				</div>
				<!-- /content area -->


</x-app-layout>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];

    // Data passed from Laravel
    const schemeData = <?php echo $schemeData ?>;
    const tenderData = <?php echo $tenderData ?>;
    const schemeLabels = <?php echo $schemeData ?>;
    const tenderLabels = <?php echo $tenderData ?>;

    const categoryLabels = @json($categoryData->keys());
    const categoryValues = @json($categoryData->values());

    // Bar Chart
    new Chart(document.getElementById("barChart"), {
        type: "bar",
        data: {
            labels: months,
            datasets: [
                {
                    label: "Schemes",
                    data: months.map((_, i) => schemeData[i+1] || 0),
                    backgroundColor: "rgba(54, 162, 235, 0.7)",
                },
                {
                    label: "Tenders",
                    data: months.map((_, i) => tenderData[i+1] || 0),
                    backgroundColor: "rgba(255, 99, 132, 0.7)",
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });

    // Pie Chart
    new Chart(document.getElementById("pieChart"), {
        type: "pie",
        data: {
            labels: categoryLabels,
            datasets: [{
                data: categoryValues,
                backgroundColor: [
                    "#007bff", "#28a745", "#ffc107", "#dc3545", "#17a2b8"
                ],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: "bottom" }
            }
        }
    });
});
</script>
