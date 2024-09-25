<div class="row g-gs">
    <div class="col-md-6 col-lg-3">
        <div class="card order-card bg-c-blue">
            <div class="card-block">
                <h6 class="mb-3 text-white">Total Properties</h6>
                <h2 class="text-right text-white">
                    <em class="icon ni ni-home float-start"></em>
                    <span>{{ $totalProperties }}</span>
                </h2>
                <p class="m-b-0">Ready to move in
                    <span class="float-end">
                        {{ $totalPropertiesForMoveIn }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card order-card bg-c-green">
            <div class="card-block">
                <h6 class="mb-3 text-white">Total Units</h6>
                <h2 class="text-right text-white">
                    <em class="icon ni ni-grid-c float-start"></em>
                    <span>
                        {{ $totalHouses }}
                    </span>
                </h2>
                <p class="m-b-0">Available Vacant<span class="float-end">
                        {{ $vacantHouses }}
                    </span></p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card order-card bg-c-yellow">
            <div class="card-block">
                <h6 class="mb-3 text-white">All Leases</h6>
                <h2 class="text-right text-white">
                    <em class="icon ni ni-bookmark float-start"></em>
                    <span>
                        {{$totalLeases}}
                    </span></h2>
                <p class="m-b-0">Terminated Leases
                    <span class="float-end">
                        {{ $terminatedLeases }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card order-card bg-c-pink">
            <div class="card-block">
                <h6 class="mb-3 text-white">Current Month Rent Collections</h6>
                <h2 class="text-right text-white">
                    <em class="icon ni ni-wallet-saving float-start"></em>
                    <span>{{ setting('currency_symbol') }} {{ number_format($paymentsThisMonth,2) }}</span>
                </h2>
                <p class="m-b-0">Approved Payments
                    <span class="float-end">{{ setting('currency_symbol') }} {{ number_format($approvedPayments,2) }}</span>
                </p>
            </div>
        </div>
    </div>
</div>
