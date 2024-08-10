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


                {{-- Chart For Problem Soved Report --}}
                <div class="nav-align-top mb-6">
                    <ul class="nav card mt-4 p-3 nav-pills d-flex justify-content-center flex-row mb-4" role="tablist">
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link active"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-pills-top-home"
                          aria-controls="navs-pills-top-home"
                          aria-selected="true">
                          {{__('page.daily')}}
                        </button>
                      </li>
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-pills-top-profile"
                          aria-controls="navs-pills-top-profile"
                          aria-selected="false">
                          {{__('page.weekly')}}
                        </button>
                      </li>
                      <li class="nav-item">
                        <button
                          type="button"
                          class="nav-link"
                          role="tab"
                          data-bs-toggle="tab"
                          data-bs-target="#navs-pills-top-messages"
                          aria-controls="navs-pills-top-messages"
                          aria-selected="false">
                          {{__('page.monthly')}}
                        </button>
                      </li>
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
                        <canvas id="daily-solved-chart"></canvas>
                      </div>
                      <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                        <canvas id="weekly-solved-chart"></canvas>
                      </div>
                      <div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
                        <canvas id="monthly-solved-chart"></canvas>
                      </div>
                    </div>
                  </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-header pb-0 d-flex align-items-center justify-content-center">
                      <h5 class="card-title m-0 me-2">{{__('page.top_problem_solvers', ['number' => 15])}}</h5>
                    
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
    var barColors = ["red", "green","blue","orange","brown"];
    new Chart("userChart", {
        type: "bar",
        data: {
            labels: @json($users_chart['label']),
            datasets: [{
            backgroundColor: barColors,
            data: @json($users_chart['data'])
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


    new Chart("daily-solved-chart", {
        type: "bar",
        data: {
            labels: @json($last_7_days_problem_solved['label']),
            datasets: [{
            backgroundColor: barColors,
            data: @json($last_7_days_problem_solved['data'])
            }]
        },
        options: {
            legend: {display: false},
            title: {
            display: true,
            text: "{{__('page.last_7_days_solved_problem_by_user')}}"
            }
        }
    });


    new Chart("weekly-solved-chart", {
        type: "bar",
        data: {
            labels: @json($last_4_weeks_problem_solved['label']),
            datasets: [{
            backgroundColor: barColors,
            data: @json($last_4_weeks_problem_solved['data'])
            }]
        },
        options: {
            legend: {display: false},
            title: {
            display: true,
            text: "{{__('page.last_4_weeks_solved_problem_by_user')}}"
            }
        }
    });

    new Chart("monthly-solved-chart", {
        type: "bar",
        data: {
            labels: @json($last_12_month_problem_solved['label']),
            datasets: [{
            backgroundColor: barColors,
            data: @json($last_12_month_problem_solved['data'])
            }]
        },
        options: {
            legend: {display: false},
            title: {
            display: true,
            text: "{{__('page.last_12__month_solved_problem_by_user')}}"
            }
        }
    });

    // last_4_weeks_problem_solved
</script>

