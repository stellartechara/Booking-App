@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="hero-wrap js-fullheight" style="margin-top: -25px; background-image: url('{{ asset('assets/images/'.$room->image.'')}}'); background-size: cover; background-position: center;">
    <div class="overlay"></div>
    <div class="container py-5">
        <div class="row align-items-center justify-content-start">
            <div class="col-md-7 ftco-animate text-white">
                <h2 class="subheading">Pembayaran Midtrans</h2>
                <h1 class="mb-4">{{ $room->name }}</h1>
                <p>Total: <strong>Rp{{ number_format($totalPrice, 0, ',', '.') }}</strong></p>
            </div>
        </div>
    </div>
</div>

<!-- Payment Section -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm p-4">
                <h3 class="mb-4 text-center">Payment Page</h3>
                <p class="text-center">Pastikan total pembayaran sesuai dengan jumlah yang tertera di atas.</p>
                <div class="text-center">
                    <button id="pay-button" class="btn btn-primary btn-lg px-5 py-3 mt-3">
                        Bayar Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" 
    data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<script type="text/javascript">
    
    document.getElementById('pay-button').addEventListener('click', function() {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                window.location.href = "{{ route('hotel.success') }}";
            },
            onPending: function(result) {
                alert("Menunggu pembayaran...");
            },
            onError: function(result) {
                alert("Pembayaran gagal.");
            },
            onClose: function() {
                alert('Popup pembayaran ditutup. Klik "Bayar Sekarang" untuk mencoba lagi.');
            }
        });
    });
</script>

<style>
    /* Hero overlay lebih halus */
    .hero-wrap .overlay {
        background: rgba(0, 0, 0, 0.45);
    }

    /* Card payment */
    .card {
        border-radius: 0.75rem;
    }

    /* Button lebih menonjol */
    #pay-button {
        font-size: 1.25rem;
    }

    /* Responsive text di hero */
    @media (max-width: 768px) {
        .hero-wrap h1 {
            font-size: 2rem;
        }
        .hero-wrap h2 {
            font-size: 1.25rem;
        }
    }
</style>

@endsection
