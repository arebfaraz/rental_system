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
                    {{--                    <li>--}}
                    {{--                        <a href="">--}}
                    {{--                            <em class="icon ni ni-printer"></em>--}}
                    {{--                            <span>{{ __('Print Invoice')}}</span>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}
                    @can(config('permission.permissions.delete_water_reading'))
                        <li>
                            <a href="javascript:void(0);"
                               x-on:click.prevent="$dispatch('confirmDeletion', { id: '{{ $reading->id }}' })">
                                <em class="icon ni ni-delete text-danger"></em>
                                <span class="text-danger">{{ __('Delete Reading')}}</span>
                            </a>
                        </li>
                    @endcan


                    {{--                    @can('delete custom invoice')--}}




                    {{--                                        @endcan--}}

                </ul>
            </div>
        </div>
    </li>
</ul>
