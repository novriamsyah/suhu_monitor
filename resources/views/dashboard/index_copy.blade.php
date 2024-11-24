@extends('layouts.horizontal_dashboard.app')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light"> </span> Dashboard Monitoring </h4>

  <!-- card mini banner -->
  <div class="row mb-4">
    <div class="col-sm-6 col-lg-3 mb-4">
      <div class="card card-border-shadow-info">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2 pb-1">
            <div class="avatar me-2">
              <span class="avatar-initial rounded bg-label-info"><i class="ti ti-home-bolt ti-md"></i></span>
            </div>
            <h4 class="ms-1 mb-0" id="energiCard">NaN</h4>
          </div>
          <p class="mb-1">Penggunaan Energi Listrik</p>
          <p class="mb-0">
            <small class="text-muted">Total penggunaan realtime energi listrik</small>
          </p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3 mb-4">
      <div class="card card-border-shadow-warning">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2 pb-1">
            <div class="avatar me-2">
              <span class="avatar-initial rounded bg-label-warning"><i class="ti ti-plug-connected ti-md"></i></span>
            </div>
            <h4 class="ms-1 mb-0" id="teganganCard">NaN</h4>
          </div>
          <p class="mb-1">Tegangan Listrik</p>
          <p class="mb-0">
            <small class="text-muted">Tegangan realtime sistem</small>
          </p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3 mb-4">
      <div class="card card-border-shadow-danger">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2 pb-1">
            <div class="avatar me-2">
              <span class="avatar-initial rounded bg-label-danger"><i class="ti ti-bolt ti-md"></i></span>
            </div>
            <h4 class="ms-1 mb-0" id="arusCard">NaN</h4>
          </div>
          <p class="mb-1">Arus Listrik</p>
          <p class="mb-0">
            <small class="text-muted">Arus realtime sistem</small>
          </p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-3 mb-4">
      <div class="card card-border-shadow-primary">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2 pb-1">
            <div class="avatar me-2">
              <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-currency-dollar ti-md"></i></span>
            </div>
            <h4 class="ms-1 mb-0" id="biayaCard">NaN</h4>
          </div>
          <p class="mb-1">Biaya Listrik</p>
          <p class="mb-0">
            <small class="text-muted">Realtime biaya listrik</small>
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- end card mini banner  -->

</div>

@endsection

@push('plugin-script')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
@endpush

@push('script')


<!-- update data table dashboard -->
<script>



  //Update Card Value sensor
  let updateCardValue = function() {
    $.ajax({
      type: "GET",
      dataType: "json",
      url: "{{ route('card.data.sensor') }}",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {

        $('#energiCard').text(response.data[0].energi + ' kWh');
        $('#teganganCard').text(response.data[0].tegangan + ' Volt');
        $('#arusCard').text(response.data[0].arus + ' Ampere');
        $('#biayaCard').text('Rp. ' + response.data[0].biaya);
        $('#valueV').text(response.data[0].tegangan);
        $('#valueI').text(response.data[0].arus);
        $('#valueP').text(response.data[0].dy_aktif);
        $('#valueF').text(response.data[0].frekuensi);
      },
      error: function(data) {
        console.log(data);
      }
    })
  }

  updateCardValue();
  setInterval(() => {
    updateCardValue();
  }, 5000);
</script>
@endpush