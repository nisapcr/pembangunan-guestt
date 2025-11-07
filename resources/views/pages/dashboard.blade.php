@extends('layouts.app')

@section('title', 'Selamat Datang Di Dashboard')

@section('content')
<section id="dashboard" class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); min-height: 100vh;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        {{-- User Info --}}
        @if(isset($user))
          <div class="user-info-card bg-white rounded-4 border-0 shadow-sm p-4 mb-4 text-center">
            <div class="user-avatar mb-3">
              <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" 
                   style="width: 100px; height: 100px;">
                <i class="bi bi-person-fill text-white fs-1"></i>
              </div>
            </div>
            <h4 class="fw-bold text-dark mb-2">{{ $user->name }}</h4>
            <p class="text-muted mb-0">
              <i class="bi bi-envelope me-2"></i>{{ $user->email ?? 'Email tidak tersedia' }}
            </p>
          </div>

          {{-- Status Message --}}
          <div class="alert alert-success border-0 rounded-3 shadow-sm mb-4">
            <div class="d-flex align-items-center">
              <i class="bi bi-check-circle-fill me-3 fs-5"></i>
              <div>
                <strong>Berhasil login!</strong> Selamat menggunakan sistem.
              </div>
            </div>
          </div>
        @else
          <div class="alert alert-warning border-0 rounded-3 shadow-sm">
            <div class="d-flex align-items-center">
              <i class="bi bi-exclamation-triangle me-3 fs-5"></i>
              <div>
                Anda belum login.
              </div>
            </div>
          </div>
        @endif

        {{-- Logout Button --}}
        @if(isset($user))
        <div class="text-center mt-4">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger px-4 py-2 rounded-3">
              <i class="bi bi-box-arrow-right me-2"></i> Logout
            </button>
          </form>
        </div>
        @endif
      </div>
    </div>
  </div>
</section>

<style>
.rounded-4 {
  border-radius: 1rem !important;
}

.user-info-card {
  transition: all 0.3s ease;
  border: 1px solid rgba(0, 0, 0, 0.05) !important;
}

.user-info-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1) !important;
}


.btn-outline-danger {
  border: 2px solid #dc3545;
  color: #dc3545;
  font-weight: 500;
  transition: all 0.3s ease;
}



.display-5 {
  font-size: 2.5rem;
  background: linear-gradient(135deg, #343a40 0%, #495057 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

@media (max-width: 768px) {
  .display-5 {
    font-size: 2rem;
  }
  
  .user-info-card {
    padding: 1.5rem !important;
  }
  
  .container {
    padding: 0 15px;
  }
}

/* Additional subtle animations */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.user-info-card, .alert, .btn {
  animation: fadeInUp 0.6s ease-out;
}

.alert {
  animation-delay: 0.2s;
}

.btn {
  animation-delay: 0.4s;
}
</style>
@endsection