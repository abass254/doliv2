@extends('layouts')

@section('content')
@section('page-title', 'Files Grid')
<div class="container-fluid">
	<div class="page-titles d-flex justify-content-between align-items-center">
		<ol class="breadcrumb">
			<!-- <li class="breadcrumb-item"><a href="/">Home Page</a></li> -->
            
		</ol>
        <form class="default-search">

            <div class="input-group search-area ms-auto w-100 d-inline-flex mr-1">
                <input id="search" type="text" class="form-control" placeholder="Search by File No, Name">
                <span class="input-group-text"><button class="bg-transparent border-0"><i class="flaticon-381-search-2"></i></button></span>
            </div>
        </form>
	</div>
    
    <div class="row dz-scroll height750">
        @if(count($data) < 1)
            <p>No Folders Found</p>
        @else
        
        @foreach($data as $dt)
            <div class="col-xl-2 col-xxl-3 col-md-4 col-sm-6">
                <div class="card">
                    <div class="card-body product-grid-card">
                        <div class="new-arrival-product">
                            <div class="new-arrivals-img-contnent">
                                <img class="img-fluid rounded" src="images/product/database.jpg" alt="">
                            </div>
                            <div class="new-arrival-content text-center mt-3">
                                <h4 class="file-no">{{ $dt->file_no }}</h4>
                                <h5 class="discount">{{ $dt->first_name . ' ' . $dt->last_name}}</h5>
                                <span class="price"> <a href="/files_station/{{ $dt->id }}/main" class="btn btn-sm btn-primary">OPEN</a> </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @endif
    </div>


    <script>
        document.getElementById('search').addEventListener('keyup', function() {
            const searchQuery = this.value.toLowerCase();
            const items = document.querySelectorAll('.product-item');

            items.forEach(item => {
                const fileNo = item.querySelector('.file-no').innerText.toLowerCase();
                const name = item.querySelector('.discount').innerText.toLowerCase();

                // Check if the search query matches any of the values (file_no, first_name, last_name)
                if (fileNo.includes(searchQuery) || name.includes(searchQuery)) {
                    item.style.display = ''; // Show item
                } else {
                    item.style.display = 'none'; // Hide item
                }
            });
        });

    </script>
    

@endsection