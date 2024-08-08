<x-main-layout title="{{__('menu.dashboard')}}">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">{{__('page.congratulations')." ".auth()->user()->name}} ! 🎉</h5>
                                <p class="mb-4">
                                    {{__('page.you_are_login_as')}} <span class="fw-bold">{{auth()->user()->getRoleNames()->first()}}</span>
                                </p>

                                {{-- <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a> --}}
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img
                                    src="{{asset('assets/img/illustrations/man-with-laptop-light.png')}}"
                                    height="140"
                                    alt="View Badge User"
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body" style="min-height: 180px">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0 mb-2">
                                <i style="font-size: 30px" class="bi bi-people"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-2">{{__('page.users')}}</span>
                        <h3 class="card-title mb-2">{{$users}}</h3>
                        {{--                                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>--}}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body" style="min-height: 180px">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0 mb-2">
                                <i style="font-size: 30px" class="bi bi-bookmarks"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-2">{{__('page.bookmarks')}}</span>
                        <h3 class="card-title text-nowrap mb-1">{{$bookmarks}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body" style="min-height: 180px">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0 mb-2">
                                <i style="font-size: 30px" class="bi bi-tags"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-2">{{__('page.categories')}}</span>
                        <h3 class="card-title text-nowrap mb-1">{{$categories}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body" style="min-height: 180px">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0 mb-2">
                                <i style="font-size: 30px" class="bi bi-chat-dots"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-2">{{__('page.pending_contacts')}}</span>
                        <h3 class="card-title text-nowrap mb-1">{{$pending_contacts}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body" style="min-height: 180px">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0 mb-2">
                                <i style="font-size: 30px" class="bi bi-chat"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-2">{{__('page.solved_contacts')}}</span>
                        <h3 class="card-title text-nowrap mb-1">{{$solved_contacts}}</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body" style="min-height: 180px">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0 mb-2">
                                <i style="font-size: 30px" class="bi bi-code-square"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-2">{{__('page.problems')}}</span>
                        <h3 class="card-title text-nowrap mb-1">{{$problems}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body" style="min-height: 180px">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0 mb-2">
                                <i style="font-size: 30px" class="bi bi-quote"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-2">{{__('page.testimonials')}}</span>
                        <h3 class="card-title text-nowrap mb-1">{{$testimonials}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body" style="min-height: 180px">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0 mb-2">
                                <i style="font-size: 30px" class="bi bi-person-workspace"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-2">{{__('page.admins')}}</span>
                        <h3 class="card-title text-nowrap mb-1">{{$admins}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body" style="min-height: 180px">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0 mb-2">
                                <i style="font-size: 30px" class="bi bi-person-workspace"></i>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-2">{{__('page.problem_solved_by_users')}}</span>
                        <h3 class="card-title text-nowrap mb-1">{{$total_probelm_solved_by_users}}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <canvas id="userChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-header pb-0 d-flex align-items-center justify-content-center">
                      <h5 class="card-title m-0 me-2">{{__('page.top_problem_solvers', ['number' => 10])}}</h5>
                    
                    </div>
                    <div class="card-body pt-4">
                      <ul class="p-0 m-0">

                        @foreach($most_problem_solved_by_users as $item)
                        <li class="d-flex align-items-center mb-2">
                          <div class="avatar flex-shrink-0 me-3">
                            <div class="rounded d-flex text-primary "  style="background-color: rgba(105,108,255,.16) !important;height: 40px; width: 40px; justify-content: center; align-items: center">
                                {{$item->short_name}}
                            </div> 
                            {{-- <img src="../assets/img/icons/unicons/paypal.png" alt="User" class="rounded"> --}}
                          </div>
                          <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                              {{-- <small class="d-block">Paypal</small> --}}
                              <h6 title="{{$item->name}}" class="fw-normal mb-0">{{Illuminate\Support\Str::limit($item->name, 15)}}</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-2">
                              <h6 class="fw-normal mb-0">{{$item->total}}</h6> <span class="text-muted"></span>
                            </div>
                          </div>
                        </li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
            </div>
        </div>
        
    </div>
</x-main-layout>

<script>
    var xValues = @json($users_chart['label']);
    var yValues = @json($users_chart['data']);
    var barColors = ["red", "green","blue","orange","brown"];

    new Chart("userChart", {
    type: "bar",
    data: {
        labels: xValues,
        datasets: [{
        backgroundColor: barColors,
        data: yValues
        }]
    },
    options: {
        legend: {display: false},
        title: {
        display: true,
        text: "{{__('page.last_12_month_user_growth')}}"
        }
    }
    });
</script>

