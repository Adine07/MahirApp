<div class="header">
	<div class="header-left">
		<div class="menu-icon dw dw-menu"></div>
	</div>
	<div class="header-right">
		<div class="user-info-dropdown">
			<div class="dropdown">
				<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
					<span class="user-icon">
						<img src="/deskapp/vendors/images/photo1.jpg" alt="">
					</span>
					<span class="user-name">{{ auth()->user()->name }}
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
					<a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
					<a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a>
					<a class="dropdown-item" href="login.html"><i class="dw dw-logout"></i> Log Out</a>
				</div>
			</div>
		</div>
	</div>
</div>