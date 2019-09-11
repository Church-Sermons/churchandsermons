<div id="sidenav" class="bg-light">
    <div class="sidenav-inner d-flex flex-column font-weight-bold">
        <a href="{{ route('user.profile.index') }}" class="{{ Nav::isRoute('user.profile.index') }} h6 p-2 my-0"><i class="fas fa-info-circle mr-1"></i> Details</a>
        <a href="{{ route('user.profile.security.index') }}" class="{{ Nav::isRoute('user.profile.security.index') }} h6 p-2 my-0"><i class="fas fa-key mr-1"></i> Security</a>
        <a href="#" class="h6 p-2"><i class="fas fa-compact-disc mr-1 my-0"></i> Resources</a>
        <a href="#" class="h6 p-2"><i class="fas fa-tachometer-alt mr-1 my-0"></i> Site - Admin Only</a>
    </div>
</div>
