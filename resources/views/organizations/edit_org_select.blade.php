@if($organization->org_type == 2 && $organization->parent_id > 0)
    @include('shelterhomes.edit')
@else
    @include('organizations.edit')
@endif