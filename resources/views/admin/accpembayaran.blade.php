@extends('template_backend_admin.app')
@section('subjudul','Konfirmasi Pembayaran')
@section('script_atas')
<script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-zuizO_ifX5u5VwDE"></script>
@endsection
@section('content')

<div>
    <button class="btn btn-dark" id="pay" onclick="payNow()">Pay!</button>
</div>
<script>
    function payNow(){
        // console.log("tes asajaaa")
    }
</script>
@endsection