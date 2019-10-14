<div id="sidenav" class="bg-light">
    <div class="sidenav-inner d-flex flex-column font-weight-bold">
        <a href="{{ route('user.profile.index') }}" class="{{ Nav::isRoute('user.profile.index') }} h6 px-2 py-3 my-0">
            <i class="fas fa-info-circle mr-1"></i> Details
        </a>
        <a href="{{ route('user.profile.security.index') }}" class="{{ Nav::isRoute('user.profile.security.index') }} h6 px-2 py-3 my-0">
            <i class="fas fa-key mr-1"></i> Security
        </a>
        <a href="{{ route('resources.index') }}" class="{{ Nav::isResource('resources') }} h6 px-2 py-3 my-0">
            <i class="fas fa-compact-disc mr-1"></i> Resources
        </a>
        @role(['administrator', 'superadministrator'])
        <a href="{{ route('user.site.about.edit') }}" class="{{ Nav::isRoute('user.site.about.edit') }} h6 px-2 py-3 my-0">
            <i class="fas fa-tachometer-alt mr-1"></i> Manage Site
        </a>
        @endrole
    </div>
</div>
