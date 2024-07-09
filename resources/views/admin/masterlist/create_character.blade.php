@extends('admin.layout')

@section('admin-title')
    Create {{ $isMyo ? 'MYO Slot' : 'Character' }}
@endsection

@section('admin-content')
    {!! breadcrumbs(['Admin Panel' => 'admin', 'Create ' . ($isMyo ? 'MYO Slot' : 'Character') => 'admin/masterlist/create-' . ($isMyo ? 'myo' : 'character')]) !!}

    <h1>Create {{ $isMyo ? 'MYO Slot' : 'Character' }}</h1>

    @if (!$isMyo && !count($categories))

        <div class="alert alert-danger">Creating characters requires at least one <a href="{{ url('admin/data/character-categories') }}">character category</a> to be created first, as character categories are used to generate the character code.</div>
    @else
        {!! Form::open(['url' => 'admin/masterlist/create-' . ($isMyo ? 'myo' : 'character'), 'files' => true]) !!}

        <h3>Basic Information</h3>

            <div class="form-group">
                {!! Form::label('Name') !!}
                {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
            </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Owner') !!} 
                    {!! Form::select('user_id', $userOptions, old('user_id'), ['class' => 'form-control', 'placeholder' => 'Select User', 'id' => 'userSelect']) !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('Owner URL (Optional)') !!} {!! add_help('For players who do not have a Lorekeeper account, the deviantArt URL will be used.') !!}
                    {!! Form::text('owner_url', old('owner_url'), ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        @if (!$isMyo)
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('Character Category') !!}
                        <select name="character_category_id" id="category" class="form-control" placeholder="Select Category">
                            <option value="" data-code="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" data-code="{{ $category->code }}" {{ old('character_category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }} ({{ $category->code }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('ID') !!}
                        <div class="d-flex">
                            {!! Form::text('number', old('number'), ['class' => 'form-control mr-2', 'id' => 'number']) !!}
                            <a href="#" id="pull-number" class="btn btn-primary" data-toggle="tooltip"
                                title="This will find the highest number assigned to a character currently and add 1 to it. It can be adjusted to pull the highest number in the category or the highest overall number - this setting is in the code.">Pull
                                Next ID</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('Character Code') !!} {!! add_help('This code identifies the character itself. You don\'t have to use the automatically generated code, but this must be unique among all characters (as it\'s used to generate the character\'s page URL).') !!}
                {!! Form::text('slug', old('slug'), ['class' => 'form-control', 'id' => 'code']) !!}
            </div>
        @endif

         <div class="form-group">
            {!! Form::label('Description (Optional)') !!}
            @if ($isMyo)
                {!! add_help('This section is for making additional notes about the MYO slot. If there are restrictions for the character that can be created by this slot that cannot be expressed with the options below, use this section to describe them.') !!}
            @else
                {!! add_help('This section is for making additional notes about the character and is separate from the character\'s profile (this is not editable by the user).') !!}
            @endif
            {!! Form::textarea('description', old('description'), ['class' => 'form-control wysiwyg']) !!}
        </div>

        <div class="form-group">
            {!! Form::checkbox('is_visible', 1, old('is_visible'), ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
            {!! Form::label('is_visible', 'Is Visible', ['class' => 'form-check-label ml-3']) !!} {!! add_help(
                'Hides the character from player view. Should only be used for certain mechanics, like uploading releases/adopts/raffles at the same time.',
            ) !!}
        </div>

        <h3>Transfer Information</h3>

        <div class="alert alert-info">
            These are self explanatory. Should be turned on for player horses and left off for NPCs. 
        </div>
        <div class="form-group-container-1">
            <div class="form-group">
                {!! Form::checkbox('is_giftable', 1, old('is_giftable'), ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
                {!! Form::label('is_giftable', 'Is Giftable', ['class' => 'form-check-label ml-3']) !!}
            </div>
            <div class="form-group-1">
                {!! Form::checkbox('is_tradeable', 1, old('is_tradeable'), ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
                {!! Form::label('is_tradeable', 'Is Tradeable', ['class' => 'form-check-label ml-3']) !!}
            </div>
            <div class="form-group-1">
                {!! Form::checkbox('is_sellable', 1, old('is_sellable'), ['class' => 'form-check-input', 'data-toggle' => 'toggle', 'id' => 'resellable']) !!}
                {!! Form::label('is_sellable', 'Is Resellable', ['class' => 'form-check-label ml-3']) !!}
            </div>
        </div>
        
        <h3>Image Upload</h3>

        <div class="form-group">
            {!! Form::label('Image') !!}
            @if ($isMyo)
                {!! add_help('This is a cover image for the MYO slot. If left blank, a default image will be used.') !!}
            @else
                {!! add_help('This is for the official reference on the @Vacantfields base. The same image should be used for both the thumbnail and main image, since we aren\'t cropping anything.') !!}
            @endif
            <div>{!! Form::file('image', ['id' => 'mainImage']) !!}</div>
        </div>
        @if (config('lorekeeper.settings.masterlist_image_automation') === 1)
            <div class="form-group">
                {!! Form::checkbox('use_cropper', 1, 1, ['class' => 'form-check-input', 'data-toggle' => 'toggle', 'id' => 'useCropper']) !!}
                {!! Form::label('use_cropper', 'Use Thumbnail Automation', ['class' => 'form-check-label ml-3']) !!} {!! add_help('Turn this off always.') !!}
            </div>
            <div class="card mb-3" id="thumbnailCrop">
                <div class="card-body">
                    <div id="cropSelect">By using this function, the thumbnail will be automatically generated from the full image.</div>
                    {!! Form::hidden('x0', 1) !!}
                    {!! Form::hidden('x1', 1) !!}
                    {!! Form::hidden('y0', 1) !!}
                    {!! Form::hidden('y1', 1) !!}
                </div>
            </div>
        @else
            <div class="form-group">
                {!! Form::checkbox('use_cropper', 1, 1, ['class' => 'form-check-input', 'data-toggle' => 'toggle', 'id' => 'useCropper']) !!}
                {!! Form::label('use_cropper', 'Use Image Cropper', ['class' => 'form-check-label ml-3']) !!} {!! add_help('Turn this off always.') !!}
            </div>
            <div class="card mb-3" id="thumbnailCrop">
                <div class="card-body">
                    <div id="cropSelect">Select an image to use the thumbnail cropper.</div>
                    <img src="#" id="cropper" class="hide" alt="" />
                    {!! Form::hidden('x0', null, ['id' => 'cropX0']) !!}
                    {!! Form::hidden('x1', null, ['id' => 'cropX1']) !!}
                    {!! Form::hidden('y0', null, ['id' => 'cropY0']) !!}
                    {!! Form::hidden('y1', null, ['id' => 'cropY1']) !!}
                </div>
            </div>
        @endif
        <div class="card mb-3" id="thumbnailUpload">
            <div class="card-body">
                {!! Form::label('Thumbnail Image') !!} {!! add_help('Use the same image as above.') !!}
                <div>{!! Form::file('thumbnail') !!}</div>
                <div class="text-muted">Recommended size: {{ config('lorekeeper.settings.masterlist_thumbnails.width') }}px x {{ config('lorekeeper.settings.masterlist_thumbnails.height') }}px</div>
            </div>
        </div>
        <p class="alert alert-info">
            This section is for crediting Noah and the designer. The artist box should always be set to Noah/@Vacantfields, unless we have guest bases at some point.
        </p>
        <div class="form-group">
            {!! Form::label('Designer(s)') !!}
            <div id="designerList">
                <div class="mb-2 d-flex">
                    {!! Form::select('designer_id[]', $userOptions, null, ['class' => 'form-control mr-2 selectize', 'placeholder' => 'Select a Designer']) !!}
                    {!! Form::text('designer_url[]', null, ['class' => 'form-control mr-2', 'placeholder' => 'Designer URL']) !!}
                    <a href="#" class="add-designer btn btn-link" data-toggle="tooltip" title="Add another designer">+</a>
                </div>
            </div>
            <div class="designer-row hide mb-2">
                {!! Form::select('designer_id[]', $userOptions, null, ['class' => 'form-control mr-2 designer-select', 'placeholder' => 'Select a Designer']) !!}
                {!! Form::text('designer_url[]', null, ['class' => 'form-control mr-2', 'placeholder' => 'Designer URL']) !!}
                <a href="#" class="add-designer btn btn-link" data-toggle="tooltip" title="Add another designer">+</a>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('Artist(s)') !!}
            <div id="artistList">
                <div class="mb-2 d-flex">
                    {!! Form::select('artist_id[]', $userOptions, null, ['class' => 'form-control mr-2 selectize', 'placeholder' => 'Select an Artist']) !!}
                    {!! Form::text('artist_url[]', null, ['class' => 'form-control mr-2', 'placeholder' => 'Artist URL']) !!}
                    <a href="#" class="add-artist btn btn-link" data-toggle="tooltip" title="Add another artist">+</a>
                </div>
            </div>
            <div class="artist-row hide mb-2">
                {!! Form::select('artist_id[]', $userOptions, null, ['class' => 'form-control mr-2 artist-select', 'placeholder' => 'Select an Artist']) !!}
                {!! Form::text('artist_url[]', null, ['class' => 'form-control mr-2', 'placeholder' => 'Artist URL']) !!}
                <a href="#" class="add-artist btn btn-link mb-2" data-toggle="tooltip" title="Add another artist">+</a>
            </div>
        </div>

        <h3>Traits</h3>

        <div class="form-group">
            {!! Form::label('Species') !!} @if ($isMyo)
                {!! add_help('This will lock the slot into a particular species. Leave it blank if you would like to give the user a choice.') !!}
            @endif
            {!! Form::select('species_id', $specieses, old('species_id'), ['class' => 'form-control', 'id' => 'species']) !!}
        </div>

        <div class="form-group" id="subtypes">
            {!! Form::label('Sub-breed') !!} @if ($isMyo)
                {!! add_help(
                    'This will lock the slot into a particular subtype. Leave it blank if you would like to give the user a choice, or not select a subtype. The subtype must match the species selected above, and if no species is specified, the subtype will not be applied.',
                ) !!}
            @endif
            {!! Form::select('subtype_id', $subtypes, old('subtype_id'), ['class' => 'form-control disabled', 'id' => 'subtype']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Character Rarity') !!} {!! add_help('Should be \'No Rarity\' unless infertile, where you can use \'Infertile\'.') !!}
            {!! Form::select('rarity_id', $rarities, old('rarity_id'), ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Gender') !!} @if ($isMyo)
                {!! add_help('This assigns the character a Gender. Leave it blank if you do not intend to use this.') !!}
            @endif
            {!! Form::select('sex', [null => 'Select Gender', 'Male' => 'Stallion', 'Female' => 'Mare'], old('sex'), ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('Traits') !!} @if ($isMyo)
                {!! add_help(
                    'These traits will be listed as required traits for the slot. The user will still be able to add on more traits, but not be able to remove these. This is allowed to conflict with the rarity above; you may add traits above the character\'s specified rarity.',
                ) !!}
            @endif
            <div><a href="#" class="btn btn-primary mb-2" id="add-feature">Add Trait</a></div>
            <div id="featureList">
            </div>
            <div class="feature-row hide mb-2">
                {!! Form::select('feature_id[]', $features, null, ['class' => 'form-control mr-2 feature-select', 'placeholder' => 'Select Trait']) !!}
                {!! Form::text('feature_data[]', null, ['class' => 'form-control mr-2', 'placeholder' => 'Extra Info (Optional)']) !!}
                <a href="#" class="remove-feature btn btn-danger mb-2">×</a>
            </div>
        </div>

        <hr class="my-4">

        <h3>Lineage (Optional)</h3>
        <div class="alert alert-info">
            If parents aren't yet added, they can be later.
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group text-center pb-1 border-bottom">
                    {!! Form::label('parent_1_id', 'Parent (Optional)', ['class' => 'font-weight-bold']) !!}
                    <div class="row">
                        <div class="col-sm-6 pr-sm-1">
                            {!! Form::select('parent_1_id', $characterOptions, null, ['class' => 'form-control text-left character-select mb-1', 'placeholder' => 'None']) !!}
                        </div>
                        <div class="col-sm-6 pl-sm-1">
                            {!! Form::text('fparent_1_name', old('parent_1_name'), ['class' => 'form-control mb-1', 'placeholder' => 'Parent\'s Name (Optional)']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group text-center pb-1 border-bottom">
                    {!! Form::label('parent_2_id', 'Parent (Optional)', ['class' => 'font-weight-bold']) !!}
                    <div class="row">
                        <div class="col-sm-6 pr-sm-1">
                            {!! Form::select('parent_2_id', $characterOptions, null, ['class' => 'form-control text-left character-select mb-1', 'placeholder' => 'None']) !!}
                        </div>
                        <div class="col-sm-6 pl-sm-1">
                            {!! Form::text('parent_2_name', old('parent_2_name'), ['class' => 'form-control mb-1', 'placeholder' => 'Parents\'s Name (Optional)']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-right">
            {!! Form::submit('Create Character', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    @endif

@endsection

@section('scripts')
    @parent
    @include('widgets._character_create_options_js')
    @include('widgets._image_upload_js')
    @include('widgets._datetimepicker_js')
    @if (!$isMyo)
        @include('widgets._character_code_js')
    @endif

    <script>
        $("#species").change(function() {
            var species = $('#species').val();
            var subtype = $('#subtype').val();
            var myo = '<?php echo $isMyo; ?>';
            $.ajax({
                type: "GET",
                url: "{{ url('admin/masterlist/check-subtype') }}?species=" + species + "&myo=" + myo,
                dataType: "text"
            }).done(function(res) {
                $("#subtypes").html(res);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                alert("AJAX call failed: " + textStatus + ", " + errorThrown);
            });

            // Check stats
            $.ajax({
                type: "GET",
                url: "{{ url('admin/masterlist/check-stats') }}?species=" + species + "&subtype=" + subtype,
                dataType: "text"
            }).done(function(res) {
                $("#stats").html(res);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                alert("AJAX call failed: " + textStatus + ", " + errorThrown);
            });
        });

        $("#subtypes").change(function() {
            var species = $('#species').val();
            var subtype = $('#subtype').val();
            $.ajax({
                type: "GET",
                url: "{{ url('admin/masterlist/check-stats') }}?species=" + species + "&subtype=" + subtype,
                dataType: "text"
            }).done(function(res) {
                $("#stats").html(res);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                alert("AJAX call failed: " + textStatus + ", " + errorThrown);
            });
        });

        $(document).ready(function() {
            $('.character-select').selectize();
            $('#advanced_lineage').on('click', function(e) {
                e.preventDefault();
            });
        });
    </script>
@endsection
