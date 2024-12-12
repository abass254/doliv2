<style>
    .plus-box {
        background: #add8e6;
        color: #007fff;
        font-size: 16px;
        padding: 40px 30px;
        position: relative;
        display: block;
        overflow: hidden;
        margin: 0 30px;
        border-radius: 0.5rem;
        margin-bottom: 40px;
        margin-top: 40px; 
    }
</style>
<div class="deznav">
    <div class="deznav-scroll" style="max-height: 100vh; overflow-y: auto;">
        <ul class="metismenu" id="menu">
            
            <li><a href="/home" class="ai-icon" aria-expanded="false">
                    <i class="fa fa-home"></i>
                    <span class="nav-text">Home Page</span>
                </a>
            </li>
            @if(Auth::user()->role == "System Administrator")
            <li><a href="/system-dashboard" class="ai-icon" aria-expanded="false">
                    <i class="fa fa-line-chart"></i>
                    <span class="nav-text">System Dashboard</span>
                </a>
            </li>
            
            <li><a href="/system_users" class="ai-icon" aria-expanded="false">
                    <i class="fa fa-users"></i>
                    <span class="nav-text">System Users</span>
                </a>
            </li>
            <li><a href="/system_users/create" class="ai-icon" aria-expanded="false">
                    <i class="fa fa-user-plus"></i>
                    <span class="nav-text">Create Users</span>
                </a>
            </li>
            @endif
            <li><a href="/my_tasks_board" class="ai-icon" aria-expanded="false">
                    <i class="fa fa-clock"></i>
                    <span class="nav-text">My Tasks Board</span>
                </a>
            </li>
            @if(Auth::user()->role == "Manager")
            <!-- <li class=""><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                <i class="fa fa-tasks"></i>
                    <span class="nav-text">Tasks</span>
                </a>
                <ul aria-expanded="false" class="mm-collapse">
                    <li><a href="/pending_tasks">Pending Tasks</a></li>
                    <li><a href="/all_tasks">All Tasks</a></li>	
                </ul>
            </li> -->
            <li class=""><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                <i class="fa fa-dollar"></i>
                    <span class="nav-text">Finance</span>
                </a>
                <ul aria-expanded="false" class="mm-collapse">
                    <li><a href="/payment_transactions/create">Add Payment Transactions</a></li>
                    <li><a href="/payment_transactions">View All Transactions</a></li>	
                </ul>
            </li>

            @endif
            <li><a href="/files" class="ai-icon" aria-expanded="false">
                    <i class="fa fa-clipboard"></i>
                    <span class="nav-text">Files</span>
                </a>
            </li>
            <li><a href="/files/create" class="ai-icon" aria-expanded="false">
                    <i class="fa fa-plus"></i>
                    <span class="nav-text">Create File</span>
                </a>
            </li>
           
            <li><a href="/old_server_files" class="ai-icon" aria-expanded="false">
                    <i class="fa fa-database"></i>
                    <span class="nav-text">OLD_SERVER_FILES</span>
                </a>
            </li>
            <li><a href="/settings" class="ai-icon" aria-expanded="false">
                    <i class="fa fa-cog"></i>
                    <span class="nav-text">Settings</span>
                </a>
            </li>
            <!-- <div class="plus-box">
                <a href="/files_grid" class="text-info">File Server</a>
            </div> -->
        </ul>
        <div class="copyright pb-0 text-primary">
            <p><strong>Doli Law Incorporation</strong>
        </div>
    </div>
</div>