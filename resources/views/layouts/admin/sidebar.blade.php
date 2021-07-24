<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <span href="index3.html" class="brand-link">
      <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Câmara Municipal de Arujá</span>
    </span>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('adminlte/dist/img/avatardefault.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
{{--      <div class="form-inline">--}}
{{--        <div class="input-group" data-widget="sidebar-search">--}}
{{--          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">--}}
{{--          <div class="input-group-append">--}}
{{--            <button class="btn btn-sidebar">--}}
{{--              <i class="fas fa-search fa-fw"></i>--}}
{{--            </button>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      </div>--}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('home') }}" class="nav-link {{ Str::contains(url()->current(), ['/home']) ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
{{--                <span class="right badge badge-danger">New</span>--}}
              </p>
            </a>
          </li>
          <li class="nav-item {{ Str::contains(url()->current(), ['/tipo-combustivel', '/tipo-manutencao', '/tipo-veiculo', '/tipo-cnh', '/marca', '/tipo-multas', '/modelo', '/tipo-correcao', 'setor', 'tipo-responsavel']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-snowflake"></i>
              <p>
                Tipos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('tipo-combustivel') }}" class="nav-link {{ Str::contains(url()->current(), ['/tipo-combustivel']) ? 'active' : '' }}">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>
                    Tipos de Combustiveis
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('tipo-manutencao') }}" class="nav-link {{ Str::contains(url()->current(), ['/tipo-manutencao']) ? 'active' : '' }}">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>
                    Tipos de Manutenções/Despesas
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('tipo-veiculo') }}" class="nav-link {{ Str::contains(url()->current(), ['/tipo-veiculo']) ? 'active' : '' }}">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>
                    Tipos de Veículos
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('tipo-cnh') }}" class="nav-link {{ Str::contains(url()->current(), ['/tipo-cnh']) ? 'active' : '' }}">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>
                    Tipos de CNH
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('marca') }}" class="nav-link {{ Str::contains(url()->current(), ['/marca']) ? 'active' : '' }}">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>
                    Tipos de Marcas
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('tipo-multas') }}" class="nav-link {{ Str::contains(url()->current(), ['/tipo-multas']) ? 'active' : '' }}">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>
                    Tipos de Multas
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('modelo') }}" class="nav-link {{ Str::contains(url()->current(), ['/modelo']) ? 'active' : '' }}">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>
                    Tipos de Modelo
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('tipo-correcao') }}" class="nav-link {{ Str::contains(url()->current(), ['/tipo-correcao']) ? 'active' : '' }}">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>
                    Tipos de Correções
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('setor') }}" class="nav-link {{ Str::contains(url()->current(), ['/setor']) ? 'active' : '' }}">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>
                    Tipos de Setores
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ url('tipo-responsavel') }}" class="nav-link {{ Str::contains(url()->current(), ['/tipo-responsavel']) ? 'active' : '' }}">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>
                    Tipos de Responsáveis
                  </p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ url('fornecedor') }}" class="nav-link {{ Str::contains(url()->current(), ['/fornecedor']) ? 'active' : '' }}">
              <i class="nav-icon fas fa-hands-helping"></i>
              <p>
                Fornecedor
              </p>
            </a>
          </li>



          <li class="nav-item">
            <a href="{{ url('controle-frota') }}" class="nav-link {{ Str::contains(url()->current(), ['/controle-frota']) ? 'active' : '' }}">
              <i class="nav-icon fas fa-people-carry"></i>
              <p>
                Controle de Frotas
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('abastecimento') }}" class="nav-link {{ Str::contains(url()->current(), ['/abastecimento']) ? 'active' : '' }}">
              <i class="nav-icon fas fa-gas-pump"></i>
              <p>
                Abastecimentos
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('motorista') }}" class="nav-link {{ Str::contains(url()->current(), ['/motorista']) ? 'active' : '' }}">
              <i class="nav-icon fas fa-biking"></i>
              <p>
                Motoristas
              </p>
            </a>
          </li>



          <li class="nav-item">
            <a href="{{ url('manutencao') }}" class="nav-link {{ Str::contains(url()->current(), ['/manutencao']) ? 'active' : '' }}">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Manutenções/Despesas
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('lancamento-multas') }}" class="nav-link {{ Str::contains(url()->current(), ['/lancamento-multas']) ? 'active' : '' }}">
              <i class="nav-icon fas fa-clipboard-check"></i>
              <p>
                Lançamento de Multas
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('veiculo-saida') }}" class="nav-link {{ Str::contains(url()->current(), ['/veiculo-saida']) ? 'active' : '' }}">
              <i class="nav-icon fas fa-route"></i>
              <p>
                Controle diário de Saida
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('veiculo-entrada') }}" class="nav-link {{ Str::contains(url()->current(), ['/veiculo-entrada']) ? 'active' : '' }}">
              <i class="nav-icon fas fa-route"></i>
              <p>
                Controle diário de Entrada
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('veiculo-agendamento/custom/index') }}" class="nav-link {{ Str::contains(url()->current(), ['/veiculo-agendamento/custom/index']) ? 'active' : '' }}">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Agendamento de Veículos
              </p>
            </a>
          </li>


          <hr style="border-color: white; border-width: 1px;  width:100%;">

          <li class="nav-item mb-5">
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-reply"></i>
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
