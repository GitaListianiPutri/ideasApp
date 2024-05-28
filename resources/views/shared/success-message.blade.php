@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{-- menggunakan blade untuk menampilkan session --}}
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif