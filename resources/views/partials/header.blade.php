<style>
#timeTrackerModal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    justify-content: center;
    align-items: center;
}

#timeTrackerModal > div {
    background: white;
    padding: 20px;
    border-radius: 8px;
    max-width: 400px;
    text-align: center;
}

#closeModalButton {
    margin-top: 10px;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

#closeModalButton:hover {
    background-color: #0056b3;
}

</style>

@php

$files = \App\Models\File::all();

@endphp

<!-- Modal for Time Tracker -->
<div class="modal" id="timeTrackerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog mod">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Time Tracker</h5>
                <button type="button" class="btn-close" id="abortModal" aria-label="Close"></button>
            </div>
            <form class="profile-form" action="/tasks" method="POST">
                @csrf
            <div class="modal-body">
                <div>
                    <input type="text" hidden name="ts_user" value="{{ Auth::user()->id }}">
                    <select name="ts_file" id="">
                        @foreach($files as $fl)
                            <option value="{{ $fl->id }}">{{ $fl->file_no }}</option>
                        @endforeach
                    </select>
                    <!-- <input type="text" hidden name="ts_file" value="999"> -->
                    <input type="text" hidden name="ts_date" value="{{date('d-m-Y') }}">
                    <label for="elapsedMinutes">Elapsed Time (Minutes):</label>
                    <input type="text" name="ts_time" id="elapsedMinutes" class="form-control" readonly>
                </div>
                <div>
                    <label for="comments">Comments:</label>
                    <textarea class="form-control" name="ts_activity" id="comments" class="form-control" rows="4"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="abortModalBtn">Abort</button>
                <button type="submit" class="btn btn-primary" >Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- <div id="timeTrackerModal">
        <div>
            <h2>Time Tracker</h2>
            <p id="elapsedTimeDisplayModal"></p>
            <p id="startTimeDisplayModal"></p>
            <button id="closeModalButton">Close</button>
        </div>
    </div> -->

<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar">
                        @yield('page-title', 'Dashboard')
                    </div>
                </div>

                <ul class="navbar-nav header-right">

                    <li class="nav-item dropdown notification_dropdown">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                {{ $errors->first() }}
                            </div>

                        @elseif(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                    </li>
                    
                    <li class="nav-item dropdown notification_dropdown">
                    <div id="timer">
                        <span id="startTimeDisplay" class="badge badge-light"></span>
                        <span id="elapsedTimeDisplay" class="badge badge-warning"></span>
                    </div>
                    </li>
                    <li class="nav-item dropdown notification_dropdown">
                        <button id="startButton" class="btn btn-success btn-sm m-2">Start Tracker</button>
                        <button id="stopButton" style="display:none;" class="btn btn-danger btn-sm">Stop Tracker</button>
                    </li>
                    <li class="nav-item dropdown notification_dropdown">    
                        <a class="nav-link bell dz-theme-mode" href="javascript:void(0);">
                            <i id="icon-light" class="fas fa-sun"></i>
                            <i id="icon-dark" class="fas fa-moon"></i>
                            
                        </a>
                    </li>
                    <li class="nav-item dropdown notification_dropdown">
                        <a class="nav-link dz-fullscreen" href="javascript:void(0);">
                            <svg id="icon-full" viewBox="0 0 24 24" width="26" height="26" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg>
                            <svg id="icon-minimize" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minimize"><path d="M8 3v3a2 2 0 0 1-2 2H3m18 0h-3a2 2 0 0 1-2-2V3m0 18v-3a2 2 0 0 1 2-2h3M3 16h3a2 2 0 0 1 2 2v3"></path></svg>
                        </a>
                    </li>
                    
                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                            <div class="header-info text-capitalize">
                                <span>{{ Auth::user()->name ?? 'LOCAL USER' }} </span>
                                <small >{{ Auth::user()->role ?? 'NOT AUTHENTICATED' }} </small>
                            </div>
                            <!-- <div class="img_cont primary">KK</div> -->
                            <img src="{{ asset('images/profile/small/user.jpg') }}" width="20" alt="">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="/home" class="dropdown-item ai-icon">
                                <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <span class="ms-2">My Profile </span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item ai-icon">
                                <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                <span class="ms-2">Logout </span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>




<script>
    // let startTime = null;
    // let timerInterval = null;
    // let timerActive = false;

    // function getQueryParams(queryString) {
    //     const params = new URLSearchParams(queryString);
    //     return {
    //         time: params.get('time'),
    //         start: params.get('start'),
    //     };
    // }

    // // Function to format time
    // function formatTime(date) {
    //     return date.toLocaleTimeString('en-US', {
    //         hour: '2-digit',
    //         minute: '2-digit',
    //         second: '2-digit',
    //         hour12: true,
    //     });
    // }

    // // Start Timer
    // document.getElementById("startButton").addEventListener("click", function () {
    //     startTime = new Date();
    //     timerActive = true;

    //     // Display start time
    //     const startTimeFormatted = formatTime(startTime);
    //     document.getElementById("startTimeDisplay").innerText = `Started At: ${startTimeFormatted}`;

    //     // Update elapsed time
    //     timerInterval = setInterval(() => {
    //         const elapsedSeconds = Math.floor((Date.now() - startTime.getTime()) / 1000);
    //         document.getElementById("elapsedTimeDisplay").innerText = `Elapsed Time: ${elapsedSeconds} seconds`;
    //     }, 1000);

    //     // Show Stop Button
    //     this.style.display = "none";
    //     document.getElementById("stopButton").style.display = "block";
    // });

    // // Stop Timer
    // document.getElementById("stopButton").addEventListener("click", function () {
    //     clearInterval(timerInterval);
    //     timerActive = false;

    //     // Show Modal
    //     const totalSeconds = Math.floor((Date.now() - startTime.getTime()) / 1000);
    //     const totalMinutes = (totalSeconds / 60).toFixed(2);
    //     document.getElementById("elapsedMinutes").value = totalMinutes;

    //     // Show modal
    //     const modal = new bootstrap.Modal(document.getElementById("timeTrackerModal"));
    //     modal.show();
    // });

    // // Abort Modal
    // document.getElementById("abortModalBtn").addEventListener("click", function () {
    //     const modal = bootstrap.Modal.getInstance(document.getElementById("timeTrackerModal"));
    //     modal.hide();
    // });

    // // Save Modal
    // document.getElementById("saveModalBtn").addEventListener("click", function () {
    //     const comments = document.getElementById("comments").value;
    //     const elapsedTime = document.getElementById("elapsedMinutes").value;

    //     // You can save the data here by making an API call to store the time and comments
    //     console.log("Elapsed Time:", elapsedTime, "Comments:", comments);

    //     // Close Modal after saving
    //     const modal = bootstrap.Modal.getInstance(document.getElementById("timeTrackerModal"));
    //     modal.hide();

    //     // Optionally, redirect or update UI
    //     window.location.href = `/time-tracker?time=${elapsedTime}&comments=${encodeURIComponent(comments)}`;
    // });

    // // Prevent Page Refresh or Navigation if Timer is Active
    // window.addEventListener("beforeunload", function (event) {
    //     if (timerActive) {
    //         event.preventDefault();
    //         event.returnValue = "You have an active timer. Are you sure you want to leave this page?";
    //         return "You have an active timer. Are you sure you want to leave this page?";
    //     }
    // });

    let startTime = null;
let timerInterval = null;
let timerActive = false;

// Function to format time
function formatTime(date) {
    return date.toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: true,
    });
}

// Start Timer
document.getElementById("startButton").addEventListener("click", function () {
    startTime = new Date();
    timerActive = true;

    // Display start time
    const startTimeFormatted = formatTime(startTime);
    document.getElementById("startTimeDisplay").innerText = `Started At: ${startTimeFormatted}`;

    // Update elapsed time
    timerInterval = setInterval(() => {
        const elapsedSeconds = Math.floor((Date.now() - startTime.getTime()) / 1000);
        document.getElementById("elapsedTimeDisplay").innerText = `Elapsed Time: ${elapsedSeconds} seconds`;
    }, 1000);

    // Show Stop Button and hide Start Button
    this.style.display = "none";
    document.getElementById("stopButton").style.display = "block";
});

// Stop Timer
document.getElementById("stopButton").addEventListener("click", function () {
    clearInterval(timerInterval);
    timerActive = false;

    // Show Modal
    const totalSeconds = Math.floor((Date.now() - startTime.getTime()) / 1000);
    const totalMinutes = (totalSeconds / 60).toFixed(2);
    document.getElementById("elapsedMinutes").value = totalMinutes;

    // Initialize and show the modal
    const modal = new bootstrap.Modal(document.getElementById("timeTrackerModal"), {
        backdrop: 'static',   // Prevent closing when clicking outside
        keyboard: false       // Prevent closing with the keyboard (escape key)
    });
    modal.show();
});

// Abort Modal (Reset everything to initial state)
document.getElementById("abortModalBtn").addEventListener("click", function () {
    // Reset Timer and UI
    startTime = null;
    timerActive = false;
    clearInterval(timerInterval);
    
    // Reset displayed timer values
    document.getElementById("startTimeDisplay").innerText = "";
    document.getElementById("elapsedTimeDisplay").innerText = "Elapsed Time: 0 seconds";
    document.getElementById("startButton").style.display = "block";  // Show start button
    document.getElementById("stopButton").style.display = "none";   // Hide stop button

    // Reset the modal fields
    document.getElementById("elapsedMinutes").value = "";
    document.getElementById("comments").value = "";

    // Close the modal
    const modal = bootstrap.Modal.getInstance(document.getElementById("timeTrackerModal"));
    modal.hide();
});

// Save Modal (For when user saves and closes the modal)
document.getElementById("saveModalBtn").addEventListener("click", function () {
    const comments = document.getElementById("comments").value;
    const elapsedTime = document.getElementById("elapsedMinutes").value;

    // You can save the data here by making an API call to store the time and comments
    console.log("Elapsed Time:", elapsedTime, "Comments:", comments);

    // Close Modal after saving
    const modal = bootstrap.Modal.getInstance(document.getElementById("timeTrackerModal"));
    modal.hide();

    // Optionally, redirect or update UI
    window.location.href = `/time-tracker?time=${elapsedTime}&comments=${encodeURIComponent(comments)}`;
});


</script>