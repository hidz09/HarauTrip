{{-- Modal Konfirmasi Logout --}}
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border:0;border-radius:16px;overflow:hidden">

            <div class="modal-body text-center" style="padding:32px 28px 20px">

                <div style="width:56px;height:56px;border-radius:50%;background:#f8ecec;
                            display:flex;align-items:center;justify-content:center;
                            margin:0 auto 16px">
                    <i class="fas fa-sign-out-alt" style="color:#a33d3d;font-size:20px"></i>
                </div>

                <h5 style="font-weight:700;color:#1c2a22;margin-bottom:8px">
                    Keluar dari akun?
                </h5>

                <p style="color:#68736d;font-size:13.5px;margin-bottom:0">
                    Anda yakin ingin keluar? Anda perlu login kembali untuk mengakses halaman admin.
                </p>

            </div>

            <div class="modal-footer" style="border:0;padding:16px 28px 28px;gap:8px">

                <button type="button"
                        class="btn"
                        data-dismiss="modal"
                        style="flex:1;background:#f0f1ee;color:#59625c;border:0;
                               border-radius:9px;font-weight:600;padding:10px">
                    Batal
                </button>

                <form action="{{ route('logout') }}" method="POST" style="flex:1;margin:0">
                    @csrf
                    <button type="submit"
                            style="width:100%;background:#a33d3d;color:#fff;border:0;
                                   border-radius:9px;font-weight:600;padding:10px">
                        Ya, Keluar
                    </button>
                </form>

            </div>

        </div>
    </div>
</div>