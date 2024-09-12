<h2 class="mx-3 mt-4">Event</h2>

{{-- User's Own Event --}}
<div class="d-flex justify-content-between align-items-center mx-4">
    <h3>Owner Event</h3>
</div>

<div class="bg-yellow mx-2">
    <div class="row">
        {{-- @foreach 4 own events --}}
        <div class="col-3">
            <div class="container bg-white m-3 p-0">
                <a href="#" class="d-block">
                    <img src="{{ asset('storage/2faac4315dbf39cf6e169f033cad1370_m 1.png') }}" class="w-100" style="height: auto;">
                </a>

                <div class="row mt-2 mx-auto">
                    <div class="col d-flex align-items-center">
                        <h5 class="mb-0 me-3"><a href="#" class="text-black fw-bold">Event title</a></h5>
                        <a href="#" class="text-black">Community title</a>
                    </div>
                    <p class="text-end">Created by <a href="#" class="text-black ms-2"><i class="fa-solid fa-circle-user icon-md"></i></a></p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- User's Joined Event --}}
<div class="d-flex justify-content-between align-items-center mx-4 mt-2">
    <h3>Join Event</h3>
</div>

<div class="bg-yellow mx-2">
    <div class="row">
        {{-- @foreach 4 joined events --}}
        <div class="col-3">
            <div class="container bg-white m-3 p-0">
                <a href="#" class="d-block">
                    <img src="{{ asset('storage/2faac4315dbf39cf6e169f033cad1370_m 1 (1).png') }}" class="w-100" style="height: auto;">
                </a>
                <div class="row mt-2 mx-auto">
                    <div class="col d-flex align-items-center">
                        <h5 class="mb-1 me-3"><a href="#" class="text-black fw-bold">Event title</a></h5>
                        <a href="#" class="text-black align-self-center">Community title</a>
                    </div>
                    <p class="text-end">Created by <a href="#" class="text-black ms-2"><i class="fa-solid fa-circle-user icon-md"></i></a></p>
                </div>
            </div>
        </div>
    </div>
</div> 