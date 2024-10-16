<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="modal fade" id="search">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h3 class="h5 modal-title text-turquoise mx-auto">
                    <i class="fa-solid fa-magnifying-glass"></i> Search For...
                </h3>
            </div>

            <div class="modal-body">
                <div id="error-message" class="alert alert-danger d-none" role="alert"></div>

                <form id="search-form" action="{{ route('search.index') }}" method="GET">
                    <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Enter keyword...">
                    <select name="category" id="category" class="form-select form-select-sm mt-3 w-50">
                        <option disabled value>Select Category</option>
                        <option value="">none</option>
                    </select>

                    <script>
                    // Fetch category data and add it to the select box.
                    document.addEventListener('DOMContentLoaded', function() {
                        fetch('/api/select-data')
                            .then(response => response.json())
                            .then(data => {
                                let select = document.getElementById('category');
                                data.forEach(function(item) {
                                    let option = document.createElement('option');
                                    option.value = item.id;
                                    option.text = item.name;
                                    select.appendChild(option);
                                });
                            })
                            .catch(error => console.error('Error fetching data:', error));
                    });
                    </script>

                    <!-- checkbox -->
                    <div class="form-check form-check-inline mt-3">
                        <input type="checkbox" name="content[]" id="username" value="username" class="form-check-input">
                        <label for="username" class="form-check-label">Username</label>
                    </div>
                    <div class="form-check form-check-inline mt-3">
                        <input type="checkbox" name="content[]" id="post" value="post" class="form-check-input">
                        <label for="post" class="form-check-label">Post</label>
                    </div>
                    <div class="form-check form-check-inline mt-3">
                        <input type="checkbox" name="content[]" id="community" value="community" class="form-check-input">
                        <label for="community" class="form-check-label">Community</label>
                    </div>
                    <div class="form-check form-check-inline mt-3">
                        <input type="checkbox" name="content[]" id="event" value="event" class="form-check-input">
                        <label for="event" class="form-check-label">Event</label>
                    </div>
                    <div class="form-check form-check-inline mt-3">
                        <input type="checkbox" name="content[]" id="all" value="all" class="form-check-input">
                        <label for="all" class="form-check-label">All</label>
                    </div>

                    <div class="mx-auto">
                        <button type="submit" class="btn btn-turquoise px-5 mt-4 w-100">Search</button>
                    </div>
                </form>

                {{-- javascript to show error on modal --}}
                <script>
                    // for showing select options(user, post, community,evvent, all)
                    $(document).ready(function() {
                        $('#search-form').on('submit', function(event) {
                            const selectedContent = $('input[name="content[]"]:checked').length;  
                            // to check checkbox has selected(checked)
                
                            $('#error-message').addClass('d-none'); 
                            // hide error
                
                            // if checkbox has not selected
                            if (selectedContent === 0) {
                                event.preventDefault();  
                                // prevent to send(to go result page)
                                $('#error-message').removeClass('d-none');  
                                // then show error message 
                                $('#error-message').text('Please select at least one of User, Post, Community, Event, or All.');
                            }
                        });
                    });
                </script>
                
            </div>

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-none btn-sm mx-auto" data-bs-dismiss="modal">x close</button>
            </div>
        </div>
    </div>
</div>
