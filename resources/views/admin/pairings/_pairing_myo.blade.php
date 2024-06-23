<div class="col-lg-4 p-2">
    <div class="card character-bio w-100 p-3">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-4">
                <h5>Subtype</h5>
            </div>
            <div class="col-lg-8 col-md-6 col-8">{!! $myo['subtype'] !!}</div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-4">
                <h5>Gender</h5>
            </div>
            <div class="col-lg-8 col-md-6 col-8">{!! $myo['sex'] !!}</div>
        </div>
        <div class="mb-3">
            <div>
                <h5>Coat</h5>
            </div>

            <div>
                @if (count($myo['features']) > 0)
                    @foreach ($myo['features'] as $feature)
                        <div>
                            <strong>{!! $feature->displayName !!}</strong>
                            {{ isset($myo['feature_data'][$loop->index]) ? '(' . $myo['feature_data'][$loop->index] . ')' : '' }}
                        </div>
                    @endforeach
                @else
                    <div>No traits listed.</div>
                @endif
            </div>
        </div>

    </div>
</div>
