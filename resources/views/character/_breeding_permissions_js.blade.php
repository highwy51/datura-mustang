@if(isset($character) && Auth::check() && Auth::user()->id == $character->user_id)
    <script>
        $( document ).ready(function() {
            $('.create-breeding-permission').on('click', function(e) {
                e.preventDefault();
                loadModal("{{ url('character/'.$character->slug.'/breeding-permissions/new') }}", 'Observe Offspring');
            });
        });
    </script>
@endif
@if(Auth::check())
    <script>
        $( document ).ready(function() {
            $('.transfer-breeding-permission').on('click', function(e) {
                e.preventDefault();
                loadModal("{{ url('character') }}/" + $(this).data('slug') + "/breeding-permissions/" + $(this).data('id') + "/transfer", 'Transfer Observed Offspring');
            });
        });
    </script>
@endif
@if(Auth::check() && Auth::user()->hasPower('manage_characters'))
    <script>
        $( document ).ready(function() {
            $('.use-breeding-permission').on('click', function(e) {
                e.preventDefault();
                loadModal("{{ url('admin/character') }}/" + $(this).data('slug') + "/breeding-permissions/" + $(this).data('id') + "/use", 'Mark Offspring As Birthed');
            });
        });
    </script>
@endif
@if(Auth::check() && Auth::user()->hasPower('manage_characters'))
        <script>
            $( document ).ready(function() {
                $('.delete-breeding-permission').on('click', function(e) {
                    e.preventDefault();
                    loadModal("{{ url('admin/character') }}/" + $(this).data('slug') + "/breeding-permissions/" + $(this).data('id') + "/delete", 'Delete Offspring Observation');
                });
            });
        </script>
@endif
