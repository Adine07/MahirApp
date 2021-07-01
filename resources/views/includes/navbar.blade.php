<div class="header">
	<div class="header-left">
		<div class="menu-icon dw dw-menu"></div>
        @if (Auth::user()->role == 'manager')
            <a href="{{ route('projects.create') }}" class="btn btn-success ml-5"><i class="ion-plus-round"></i> New Project</a>
            <a href="{{ route('clients.create') }}" class="btn btn-success ml-2"><i class="ion-plus-round"></i> New Client</a>
        @endif
	</div>
	<div class="header-right">
		<div class="user-info-dropdown">
			<div class="dropdown">
				<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
					<span class="user-name mt-2">{{ auth()->user()->name }}
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
					{{-- <a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
					<a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a> --}}
					<a
						href="/logout"
						onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
						class="dropdown-item"
					>
						<i class="dw dw-logout"></i> Logout
					</a>
					<form
						id="logout-form"
						action="/logout"
						method="POST"
						style="display: none;"
					>
						@csrf
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
