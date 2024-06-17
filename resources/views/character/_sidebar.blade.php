<ul>
    <li class="sidebar-header"><a href="{{ $character->url }}" class="card-link">{{ $character->slug }}</a></li>
    <li class="sidebar-section">
        <div class="sidebar-section-header">Character</div>
        <div class="sidebar-item"><a href="{{ $character->url }}" class="{{ set_active('character/' . $character->slug) }}">Information</a></div>
        <div class="sidebar-item"><a href="{{ $character->url . '/profile' }}" class="{{ set_active('character/' . $character->slug . '/profile') }}">Profile</a></div>
        <div class="sidebar-item"><a href="{{ $character->url . '/gallery' }}" class="{{ set_active('character/' . $character->slug . '/gallery') }}">Gallery</a></div>
        @if ($character->getLineageBlacklistLevel() < 2)
            <div class="sidebar-item"><a href="{{ $character->url . '/lineage' }}" class="{{ set_active('character/' . $character->slug . '/lineage') }}">Family History</a></div>
        @endif
        <div class="sidebar-item"><a href="{{ $character->url . '/breeding-permissions' }}" class="{{ set_active('character/'.$character->slug.'/breeding-permissions') }}">Foal Slots</a></div>
        <div class="sidebar-item"><a href="{{ $character->url . '/stats' }}" class="{{ set_active('character/' . $character->slug . '/stats') }}">Character Age</a></div>
    </li>
    <li class="sidebar-section">
        <div class="sidebar-section-header">History</div>
        <div class="sidebar-item"><a href="{{ $character->url . '/images' }}" class="{{ set_active('character/' . $character->slug . '/images') }}">Images</a></div>
        <div class="sidebar-item"><a href="{{ $character->url . '/change-log' }}" class="{{ set_active('character/' . $character->slug . '/change-log') }}">Change Log</a></div>
        <div class="sidebar-item"><a href="{{ $character->url . '/ownership' }}" class="{{ set_active('character/' . $character->slug . '/ownership') }}">Ownership History</a></div>
        <div class="sidebar-item"><a href="{{ $character->url . '/stats/logs' }}" class="{{ set_active('character/' . $character->slug . '/stats/logs') }}">Age Logs</a></div>
        <div class="sidebar-item"><a href="{{ $character->url . '/submissions' }}" class="{{ set_active('character/' . $character->slug . '/submissions') }}">Submissions</a></div>
    </li>
    @if (Auth::check() && (Auth::user()->id == $character->user_id || Auth::user()->hasPower('manage_characters')))
        <li class="sidebar-section">
            <div class="sidebar-section-header">Settings</div>
            <div class="sidebar-item"><a href="{{ $character->url . '/profile/edit' }}" class="{{ set_active('character/' . $character->slug . '/profile/edit') }}">Edit Profile</a></div>
            <div class="sidebar-item"><a href="{{ $character->url . '/transfer' }}" class="{{ set_active('character/' . $character->slug . '/transfer') }}">Transfer</a></div>
            @if (Auth::user()->id == $character->user_id)
                <div class="sidebar-item"><a href="{{ $character->url . '/approval' }}" class="{{ set_active('character/' . $character->slug . '/approval') }}">Track Horse</a></div>
            @endif
        </li>
    @endif
</ul>
