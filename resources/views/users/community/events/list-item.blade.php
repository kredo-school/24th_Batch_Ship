<div class="container-fluid d-flex justify-content-arountd">
  <div class="card m-0 p-0 bg-transparent border-0">
    {{-- for each --}}
    {{-- @if(events->community_id)????  --}}
    <div class="card-body m-0 p-0 border-0 bg-white w-50">
      <img src="{{-- (event image) --}}" alt="">
      <img src="https://images.pexels.com/photos/5425522/pexels-photo-5425522.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" class="w-100" alt="">
      <div class="row p-2">
        {{-- event titl --}}
          <h6>events_title</h6>
          {{-- event date --}}
        <div class="d-flex justify-content-between xsmall">
          <p class="text-muted mb-0">date</p>
          {{-- event owner avatar --}}
          <p class="text-end fw-bold mb-0">
            organized by <i class="fa-solid fa-circle-user icon"></i>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
