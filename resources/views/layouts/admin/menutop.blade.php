<div class="top_nav">
	<div class="nav_menu">
		<nav class="" role="navigation">
			<div class="nav toggle">
				<a id="menu_toggle"><i class="fa fa-bars"></i></a>
			</div>

			<ul class="nav navbar-nav navbar-right">
				<li class="">
					<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						@if(null != $user)
							<i class="fa fa-user" aria-hidden="true"></i> {{ $user->nombres }} {{ $user->apellidos }}
							<span class="fa fa-angle-down"></span>
							</a>
							<ul class="dropdown-menu dropdown-usermenu pull-right">
								<!-- <li><a href="javascript:;"> Perfil</a></li>
								<li>
									<a href="javascript:;">
										<span class="badge bg-red pull-right">50%</span>
										<span>Settings</span>
									</a>
								</li>
								<li><a href="javascript:;">Ayuda</a></li> -->
								<li><a href="{{ route('logout') }}"><i class="fa fa-sign-out pull-right"></i>Logout</a></li>
							</ul>
						@else
							<i class="fa fa-user" aria-hidden="true"></i> Invitado
								<span class="fa fa-angle-down"></span>
							</a>
							<ul class="dropdown-menu dropdown-usermenu pull-right">
								<li>
									<a href="{{ route('login') }}">
										Login
									</a>
								</li>
							</ul>
						@endif
						
					
				</li>
          </ul>
      </nav>
  </div>
</div>