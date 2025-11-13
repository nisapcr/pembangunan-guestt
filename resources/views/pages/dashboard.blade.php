@extends('layouts.guest.app')

@section('content')
<section id="dashboard" class="py-5">
  <div class="container text-center" data-aos="fade-up">
    <h2 class="fw-bold mb-4 text-primary">Selamat Datang di Dashboard</h2>
    @if(isset($user))
<p class="text-secondary">
    Anda sudah masuk sebagai <strong>{{ $user->name }}</strong>
</p>
@else
    <p class="text-secondary">
        Anda belum login.</p>
@endif

    {{-- Tombol Logout --}}
    <form action="{{ route('logout') }}" method="POST" class="d-inline">
      @csrf
      <button type="submit" class="btn btn-danger mt-3">
        <i class="bi bi-box-arrow-right"></i> Logout
      </button>
    </form>
  </div>
</section>
@endsection
