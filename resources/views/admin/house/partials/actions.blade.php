<ul class="nk-tb-actions gx-1">
    <li>
        <div class="drodown">
            <a href="#"
               class="dropdown-toggle btn btn-icon btn-trigger"
               data-bs-toggle="dropdown"><em
                    class="icon ni ni-more-h"></em></a>
            <div
                class="dropdown-menu dropdown-menu-end">
                <ul class="link-list-opt no-bdr">

                    <li>
                        <a href="{{ route('admin.houses.show',$house->id) }}">
                            <em class="icon ni ni-eye"></em>
                            <span>{{ __('View Details')}}</span>
                        </a>
                    </li>

                    @can(config('permission.permissions.update_house'))
                        <li>
                            <a href="{{ route('admin.houses.edit',$house->id) }}">
                                <em class="icon ni ni-edit-alt-fill"></em>
                                <span>{{ __('Update House')}}</span>
                            </a>
                        </li>
                    @endcan

                    @can(config('permission.permissions.create_lease'))
                        @if($house->status==\App\Enums\HouseStatusEnum::VACANT->value)

                            <li>
                                <a href="{{ route('admin.leases.create',['house_id'=>$house->id]) }}">
                                    <em class="icon ni ni-property-add"></em>
                                    <span>{{ __('Assign To Tenant')}}</span>
                                </a>
                            </li>

                        @endif
                    @endcan

                    @can(config('permission.permissions.delete_house'))
                        <li>
                            <a href="javascript:void(0);" class="text-danger"
                               x-data x-on:click="$dispatch('deleteHouse',{id:'{{$house->id}}'})">
                                <em class="icon ni ni-trash"></em>
                                <span>{{ __('Delete House')}}</span>
                            </a>
                        </li>
                    @endcan

                </ul>
            </div>
        </div>
    </li>
</ul>
