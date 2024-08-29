@extends('layout.main')
@section('content')
    <div class="row" id="dashboard-cards">

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
                            daily
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
                            weekly
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
                            monthly
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
                    <h5 class="card-title text-capitalize m-0 me-2">top 15 problem solvers</h5>

                </div>
                <div class="card-body pt-4">
                    <ul class="p-0 m-0" id="top-problem-solver-list">

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function (){
            let dashboard_cards = [
                {
                    name: 'Users',
                    icon: 'bi bi-people',
                    key: 'users'
                },
                {
                    name: 'Bookmarks',
                    icon: 'bi bi-bookmarks',
                    key: 'bookmarks'
                },
                {
                    name: 'Categories',
                    icon: 'bi bi-tags',
                    key: 'categories'
                },
                {
                    name: 'Pending Contact',
                    icon: 'bi bi-chat-dots',
                    key: 'pending_contacts'
                },
                {
                    name: 'Solved Contact',
                    icon: 'bi bi-chat',
                    key: 'solved_contacts'
                },
                {
                    name: 'Problems',
                    icon: 'bi bi-code-square',
                    key: 'problems',
                },
                {
                    name: 'Testimonials',
                    icon: 'bi bi-quote',
                    key: 'testimonials',
                },
                {
                    name: 'Admins',
                    icon: 'bi bi-person-workspace',
                    key: 'admins',
                },
                {
                    name: 'Problem Solved By Users',
                    icon: 'bi bi-person-workspace',
                    key: 'total_probelm_solved_by_users'
                },
            ];


            requestData.get('/')
                .then(function (response){
                    if (response.status === 200){
                        let data = response.data.data;
                        //Cards Data Count
                        dashboard_cards.forEach(function (item){
                            $('#dashboard-cards').append(`
                        <div class="col-lg-4 col-md-6 col-6 mb-4">
                            <div class="card">
                                <div class="card-body" style="min-height: 180px">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                        <div class="avatar flex-shrink-0 mb-2">
                                            <i style="font-size: 30px" class="${item.icon}"></i>
                                        </div>
                                    </div>
                                    <span class="fw-semibold d-block mb-2">${item.name}</span>
                                    <h3 class="card-title mb-2">${data[item.key]}</h3>

                                </div>
                            </div>
                        </div>
                    `)
                        })
                        //Top Problem Solvers
                        data.most_problem_solved_by_users.forEach(function (item){
                            $('#top-problem-solver-list').append(`
                        <li class="d-flex align-items-center mb-2">
                            <div class="avatar flex-shrink-0 me-3">
                                <div class="rounded d-flex text-primary "  style="background-color: rgba(105,108,255,.16) !important;height: 40px; width: 40px; justify-content: center; align-items: center">
                                    ${item.short_name}
                                </div>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 title="$item->name" class="fw-normal mb-0">${item.name.slice(0,15)}</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-2">
                                <h6 class="fw-normal mb-0">${item.total}</h6> <span class="text-muted"></span>
                            </div>
                            </div>
                        </li>
                    `)
                        })

                        //Chart Data
                        ViewChart('userChart', 'Last 12 Month User Growth', data.users_chart.label, data.users_chart.data)
                        ViewChart('daily-solved-chart', 'Last 7 Days Problem Solved By User', data.last_7_days_problem_solved.label, data.last_7_days_problem_solved.data)
                        ViewChart('monthly-solved-chart', 'Last 12 Month Problem Solved By User', data.last_12_month_problem_solved.label, data.last_12_month_problem_solved.data)
                        ViewChart('weekly-solved-chart', 'Last 12 Month Problem Solved By User', data.last_4_weeks_problem_solved.label, data.last_4_weeks_problem_solved.data)
                    }
                })
                .catch(function (error){

                })




            function ViewChart(id,title, labels, data){
                var barColors = ["red", "green","blue","orange","brown"];
                new Chart(id, {
                    type: "bar",
                    data: {
                        labels: labels,
                        datasets: [{
                            backgroundColor: barColors,
                            data: data
                        }]
                    },
                    options: {
                        legend: {display: false},
                        title: {
                            display: true,
                            text: title
                        }
                    }
                });
            }
        })

    </script>
@endsection
