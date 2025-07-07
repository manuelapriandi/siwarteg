 @extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dasbor</h1>
            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
       </div>

<div class="row">

       
    <!-- Card Total Aduan -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary mb-1">
                            Total Aduan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $totalAduan }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Aduan Baru -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info mb-1">
                            Aduan Baru</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $aduanBaru }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-plus-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Aduan Diproses -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning mb-1">
                            Sedang Diproses</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $aduanDiproses }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-spinner fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Aduan Selesai -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success mb-1">
                            Selesai</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            {{ $aduanSelesai }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
