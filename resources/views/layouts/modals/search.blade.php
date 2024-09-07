<div class="modal fade" id="search">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h3 class="h5 modal-title text-turquoise mx-auto">
                    <i class="fa-solid fa-magnifying-glass"></i> Search For...
                </h3>
            </div>

            <div class="modal-body">
                <form action="{{ route('search') }}" method="get" enctype="multipart/form-data">
                    @csrf


                    <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Enter keyword..." >

                    <select name="category" id="category" class="form-select form-select-sm mt-3 w-50">
                        <option disabled selected value>Select Category</option>
                        {{-- @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach --}}
                    </select>


                    <div class="form-check form-check-inline mt-3">
                        <input type="checkbox" name="content" id="user" value="user" class="form-check-input">
                        <label for="user" class="form-check-label">User</label>
                    </div>
                    <div class="form-check form-check-inline mt-3">
                        <input type="checkbox" name="content" id="post" value="post" class="form-check-input">
                        <label for="post" class="form-check-label">Post</label>
                    </div>
                    <div class="form-check form-check-inline mt-3">
                        <input type="checkbox" name="content" id="community" value="community" class="form-check-input">
                        <label for="community" class="form-check-label">Community</label>
                    </div>
                    <div class="form-check form-check-inline mt-3">
                        <input type="checkbox" name="content" id="event" value="event" class="form-check-input">
                        <label for="event" class="form-check-label">Event</label>
                    </div>
                    <div class="form-check form-check-inline mt-3">
                        <input type="checkbox" name="content" id="all" value="all" class="form-check-input">
                        <label for="all" class="form-check-label">All</label>
                    </div>

                    <div class="mx-auto">
                        <button type="submit" class="btn btn-turquoise text-white px-5 mt-4 w-100">Search</button>
                    </div>
                </form>
            </div>

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-none btn-sm mx-auto" data-bs-dismiss="modal">x close</button>
            </div>
        </div>
    </div>
</div>
