@extends('layouts.operator')

@section('title', 'Scan Voucher')

@section('content')

<style>
    .scan-page {
        background: #f5f1e8;
        min-height: 100%;
        padding: 28px;
    }

    .scan-card {
        background: #ffffff;
        border: none;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(16, 44, 34, 0.08);
        max-width: 640px;
        margin: 0 auto;
    }

    .scan-header {
        background: #102c22;
        color: #ffffff;
        padding: 21px 25px;
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .scan-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        background: rgba(214, 173, 115, 0.15);
        color: #d6ad73;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .scan-header h3 {
        margin: 0;
        font-size: 21px;
        font-weight: 700;
    }

    .scan-header p {
        margin: 3px 0 0;
        color: #d8dfda;
        font-size: 13px;
    }

    .scan-body {
        padding: 28px;
    }

    /* CAMERA */
    #reader {
        width: 100%;
        border-radius: 14px;
        overflow: hidden;
        border: 2px solid #eee9df;
        background: #0d1f18;
        min-height: 280px;
    }

    #reader video {
        border-radius: 12px;
        transform: scaleX(-1);
    }

    .scan-toggle {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    .toggle-btn {
        flex: 1;
        border: 1px solid #ddd8ce;
        background: #f8f6f0;
        color: #59645d;
        padding: 10px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .toggle-btn.active {
        background: #102c22;
        border-color: #102c22;
        color: #ffffff;
    }

    /* MANUAL INPUT */
    .manual-form {
        display: none;
        gap: 10px;
    }

    .manual-form.active {
        display: flex;
    }

    .manual-form input {
        flex: 1;
        height: 46px;
        border: 1px solid #ddd8ce;
        border-radius: 9px;
        padding: 0 15px;
        font-size: 14px;
        text-transform: uppercase;
    }

    .manual-form input:focus {
        outline: none;
        border-color: #4c7a4c;
        box-shadow: 0 0 0 3px rgba(76, 122, 76, 0.10);
    }

    .manual-form button {
        border: none;
        background: #102c22;
        color: #ffffff;
        padding: 0 22px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
    }

    .manual-form button:hover {
        background: #1b4434;
    }

    /* RESULT */
    .result-box {
        margin-top: 22px;
        border-radius: 14px;
        padding: 20px;
        display: none;
    }

    .result-box.show {
        display: block;
    }

    .result-box.success {
        background: #eef4ee;
        border: 1px solid #bfe0c4;
    }

    .result-box.error {
        background: #fbf1ee;
        border: 1px solid #f0c9bf;
    }

    .result-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 700;
        font-size: 15px;
        margin-bottom: 6px;
    }

    .result-box.success .result-title { color: #1b7a3d; }
    .result-box.error .result-title { color: #b0554a; }

    .result-message {
        font-size: 13px;
        color: #4a544d;
        margin-bottom: 12px;
    }

    .result-detail {
        background: #ffffff;
        border-radius: 10px;
        padding: 14px 16px;
        font-size: 13px;
    }

    .result-detail div {
        display: flex;
        justify-content: space-between;
        padding: 5px 0;
        border-bottom: 1px dashed #e6e1d7;
    }

    .result-detail div:last-child {
        border-bottom: none;
    }

    .result-detail span:first-child {
        color: #85908a;
    }

    .result-detail span:last-child {
        font-weight: 600;
        color: #26332b;
    }

    .scan-again-btn {
        margin-top: 14px;
        width: 100%;
        border: 1px solid #ddd8ce;
        background: #f8f6f0;
        color: #26332b;
        padding: 11px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
    }

    .scan-again-btn:hover {
        background: #eee9df;
    }

    /* TOAST "MEMVERIFIKASI..." */
    .verify-toast {
        position: fixed;
        top: 24px;
        left: 50%;
        transform: translateX(-50%) translateY(-20px);
        background: #102c22;
        color: #ffffff;
        padding: 13px 22px;
        border-radius: 999px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        font-weight: 600;
        box-shadow: 0 10px 30px rgba(16, 44, 34, 0.25);
        z-index: 999;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.2s ease, transform 0.2s ease;
    }

    .verify-toast.show {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }

    .verify-toast .spinner {
        width: 15px;
        height: 15px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-top-color: #d6ad73;
        border-radius: 50%;
        animation: verify-spin 0.7s linear infinite;
        flex-shrink: 0;
    }

    @keyframes verify-spin {
        to { transform: rotate(360deg); }
    }

    /* TOAST SUKSES: nampilin nama pemesan */
    .name-toast {
        position: fixed;
        top: 24px;
        left: 50%;
        transform: translateX(-50%) translateY(-20px);
        background: #1b7a3d;
        color: #ffffff;
        padding: 14px 24px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 10px 30px rgba(27, 122, 61, 0.3);
        z-index: 999;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.25s ease, transform 0.25s ease;
        max-width: 90vw;
    }

    .name-toast.show {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }

    .name-toast .name-toast-icon {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 16px;
    }

    .name-toast .name-toast-text {
        line-height: 1.3;
    }

    .name-toast .name-toast-label {
        font-size: 10.5px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        opacity: 0.8;
    }

    .name-toast .name-toast-name {
        font-size: 15px;
        font-weight: 700;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 60vw;
    }
</style>

<div class="scan-page">

    <div class="scan-card">

        {{-- HEADER --}}
        <div class="scan-header">
            <div class="scan-icon">
                <i class="fas fa-qrcode"></i>
            </div>
            <div>
                <h3>Scan Voucher</h3>
                <p>Verifikasi kode booking wisatawan</p>
            </div>
        </div>

        {{-- BODY --}}
        <div class="scan-body">

            <div class="scan-toggle">
                <button type="button" class="toggle-btn active" id="btnCamera" onclick="switchMode('camera')">
                    <i class="fas fa-camera"></i> Scan Kamera
                </button>
                <button type="button" class="toggle-btn" id="btnManual" onclick="switchMode('manual')">
                    <i class="fas fa-keyboard"></i> Input Manual
                </button>
            </div>

            {{-- CAMERA MODE --}}
            <div id="cameraMode">
                <div id="reader"></div>
            </div>

            {{-- MANUAL MODE --}}
            <form class="manual-form" id="manualForm" onsubmit="return submitManual(event)">
                <input type="text" id="manualCode" placeholder="Contoh: HRT-20260917-0001" autocomplete="off" required>
                <button type="submit">
                    <i class="fas fa-check"></i> Cek
                </button>
            </form>

            {{-- RESULT --}}
            <div class="result-box" id="resultBox">
                <div class="result-title" id="resultTitle"></div>
                <div class="result-message" id="resultMessage"></div>
                <div class="result-detail" id="resultDetail"></div>
                <button type="button" class="scan-again-btn" onclick="resetScan()">
                    <i class="fas fa-redo"></i> Scan Lagi
                </button>
            </div>

        </div>

    </div>

    {{-- TOAST: muncul sesaat setelah QR terdeteksi, sebelum hasil dari server balik --}}
    <div class="verify-toast" id="verifyToast">
        <span class="spinner"></span>
        <span>Kode terdeteksi, memverifikasi...</span>
    </div>

    {{-- TOAST: nama pemesan, muncul begitu check-in berhasil --}}
    <div class="name-toast" id="nameToast">
        <div class="name-toast-icon">
            <i class="fas fa-check"></i>
        </div>
        <div class="name-toast-text">
            <div class="name-toast-label">Check-in Berhasil</div>
            <div class="name-toast-name" id="nameToastValue"></div>
        </div>
    </div>

</div>


@push('js')

<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

<script>
let html5QrCode = null;
let isProcessing = false;

const verifyUrl = "{{ route('operator.verify') }}";
const csrfToken = "{{ csrf_token() }}";

function switchMode(mode) {
    const btnCamera = document.getElementById('btnCamera');
    const btnManual = document.getElementById('btnManual');
    const cameraMode = document.getElementById('cameraMode');
    const manualForm = document.getElementById('manualForm');

    if (mode === 'camera') {
        btnCamera.classList.add('active');
        btnManual.classList.remove('active');
        cameraMode.style.display = 'block';
        manualForm.classList.remove('active');
        startCamera();
    } else {
        btnManual.classList.add('active');
        btnCamera.classList.remove('active');
        cameraMode.style.display = 'none';
        manualForm.classList.add('active');
        stopCamera();
    }
}

function startCamera() {
    if (html5QrCode) return;

    html5QrCode = new Html5Qrcode("reader");

    html5QrCode.start(
        { facingMode: "environment" },
        { fps: 10, qrbox: { width: 240, height: 240 } },
        (decodedText) => {
            if (!isProcessing) {
                verifyCode(decodedText);
            }
        },
        () => { /* frame tanpa QR, abaikan */ }
    ).catch((err) => {
        document.getElementById('reader').innerHTML =
            '<div style="color:#fff;padding:30px;text-align:center;font-size:13px;">' +
            '<i class="fas fa-video-slash" style="font-size:28px;display:block;margin-bottom:10px;color:#d6ad73;"></i>' +
            'Tidak dapat mengakses kamera. Pastikan izin kamera diaktifkan, ' +
            'atau gunakan mode Input Manual.</div>';
    });
}

function stopCamera() {
    if (html5QrCode) {
        html5QrCode.stop().then(() => {
            html5QrCode.clear();
            html5QrCode = null;
        }).catch(() => {
            html5QrCode = null;
        });
    }
}

function submitManual(e) {
    e.preventDefault();
    const code = document.getElementById('manualCode').value.trim();
    if (code) verifyCode(code);
    return false;
}

function showVerifyToast() {
    document.getElementById('verifyToast').classList.add('show');
}

function hideVerifyToast() {
    document.getElementById('verifyToast').classList.remove('show');
}

function verifyCode(code) {
    console.log('[SCAN DEBUG] Kode terdeteksi:', code, '| isProcessing:', isProcessing);

    if (isProcessing) {
        console.log('[SCAN DEBUG] Diabaikan karena masih memproses request sebelumnya.');
        return;
    }
    isProcessing = true;

    showVerifyToast();

    fetch(verifyUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
        },
        body: JSON.stringify({ booking_code: code }),
    })
    .then(res => {
        console.log('[SCAN DEBUG] HTTP status dari server:', res.status);
        return res.json().then(data => ({ status: res.status, body: data }));
    })
    .then(({ body }) => {
        console.log('[SCAN DEBUG] Response JSON dari server:', body);
        hideVerifyToast();
        showResult(body);
    })
    .catch((err) => {
        console.error('[SCAN DEBUG] Fetch gagal / response bukan JSON valid:', err);
        hideVerifyToast();
        showResult({ success: false, message: 'Terjadi kesalahan koneksi. Coba lagi.' });
    })
    .finally(() => {
        isProcessing = false;
    });
}

let nameToastTimer = null;

function showNameToast(nama) {
    const toast = document.getElementById('nameToast');
    document.getElementById('nameToastValue').textContent = nama || '-';

    toast.classList.add('show');

    clearTimeout(nameToastTimer);
    nameToastTimer = setTimeout(() => {
        toast.classList.remove('show');
    }, 4000);
}

function showResult(res) {
    stopCamera();

    const box = document.getElementById('resultBox');
    const title = document.getElementById('resultTitle');
    const message = document.getElementById('resultMessage');
    const detail = document.getElementById('resultDetail');

    box.className = 'result-box show ' + (res.success ? 'success' : 'error');
    title.innerHTML = res.success
        ? '<i class="fas fa-check-circle"></i> Check-in Berhasil'
        : '<i class="fas fa-times-circle"></i> Gagal Verifikasi';
    message.textContent = res.message || '';

    detail.innerHTML = '';
    if (res.success && res.data) {
        const rows = {
            'Kode Booking': res.data.booking_code,
            'Nama': res.data.nama,
            'Paket': res.data.paket,
            'Tanggal': res.data.tanggal,
            'Jumlah Peserta': res.data.jumlah_peserta,
        };
        Object.entries(rows).forEach(([label, value]) => {
            detail.innerHTML += `<div><span>${label}</span><span>${value}</span></div>`;
        });

        showNameToast(res.data.nama);
    } else {
        detail.style.display = 'none';
    }

    document.getElementById('cameraMode').style.display = 'none';
    document.getElementById('manualForm').classList.remove('active');
    document.getElementById('manualCode').value = '';
}

function resetScan() {
    document.getElementById('resultBox').classList.remove('show');
    document.getElementById('resultDetail').style.display = 'block';

    const isCameraActive = document.getElementById('btnCamera').classList.contains('active');
    if (isCameraActive) {
        document.getElementById('cameraMode').style.display = 'block';
        startCamera();
    } else {
        document.getElementById('manualForm').classList.add('active');
    }
}

// Mulai kamera otomatis saat halaman dibuka
document.addEventListener('DOMContentLoaded', () => {
    startCamera();
});
</script>

@endpush

@endsection