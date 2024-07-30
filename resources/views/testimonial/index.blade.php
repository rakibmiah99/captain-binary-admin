
<x-main-layout :title="__('menu.testimonials')">
    <div class="p-4">
        <div class="card">
           <x-card-header
               :can-create="\App\Helper::HasPermissionMenu('testimonial', 'create')"
               :url="route('testimonial.create')"
               :name="__('page.testimonials')"
               :url-name="__('page.create')"/>
            <div class="mt-3">
                <x-filter-data :can-export="false" export-url="category.export" translate-from="db.testimonial" :columns="$columns"/>

                <div class="table-responsive mt-2 table-paginate text-nowrap">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>{{__('page.sl')}}</th>
                            @foreach(request()->columns ?? $columns  as $column)
                                <th>{{__('db.testimonial.'.$column)}}</th>
                            @endforeach
                            <th>{{__('page.action')}}</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @php $index = \App\Helper::PageIndex() @endphp
                            @foreach ($data as $key=>$item)
                                <tr>
                                    <td>{{$index++}}</td>
                                    @foreach(request()->columns ?? $columns as $column)
                                        <td>
                                            @if($column == "comments")
                                                {{\Illuminate\Support\Str::limit($item->$column, 50)}}
                                            @elseif($column == "image")
                                                <img width="70px" height="70" src="{{$item->$column}}" >
                                            @else
                                                {{$item->$column}}
                                            @endif
                                        </td>

                                    @endforeach

                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <x-action-buttons
                                                :model="$item"
                                                permission-for="testimonial"
                                                route-prefix="testimonial"
                                            />
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <x-when-table-empty :data-length="$data->count()"/>
                </div>


               <div class="px-3 mt-3">
                   {{ $data->links() }}
               </div>
            </div>
        </div>
    </div>



    <x-view-modal size="modal-lg">
        <div id="data-view">

        </div>
    </x-view-modal>
</x-main-layout>

<script>

    $('.view-btn').on('click', function (){
        $('#meal-systems').empty();
        modalLoaderON();
        let url = $(this).attr('url')
        axios({
            method: 'get',
            url: url
        })
            .then(function (response){
                modalLoaderOFF();
                const data = response.data;
                $('#data-view').html(data)
            })
            .catch(function (error){

            });
    })

</script>
