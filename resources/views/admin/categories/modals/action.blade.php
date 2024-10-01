{{-- Edit --}}
<div class="modal fade" id="update-category-{{$category->id}}">
    <div class="modal-dialog">
        <form action="{{ route('admin.categories.update', $category->id)}}" method="post">
            @csrf
            @method('PATCH')
            <div class="modal-content border-warning">

                <div class="modal-header border-warning">
                    <h3 class="h5 modal-title">
                        <i class="fa-regular fa-pen-to-square"></i> Edit Category
                    </h3>
                </div>
        
                <div class="modal-body">
                    
                        <div class="row justify-content-center mb-3">
                            <input type="text" class="form-control" name="edit_name"  value="{{ $category->name}}" autofocus>
                        </div>
                </div>
        
                <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-warning btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning btn-sm">Update</button>
                    
                </div>
            </div>
        </form>
    </div>
</div>
{{-- Delete --}}
    <div class="modal fade" id="delete-category-{{$category->id}}">
        <div class="modal-dialog">
                
            <div class="modal-content border-danger">
    
                <div class="modal-header border-danger">
                    <h3 class="h5 modal-title text-danger">
                        <i class="fa-solid fa-trash-can"></i> Delete Category
                    </h3>
                </div>
        
                <div class="modal-body">
                    <p>Are you sure you want to delete <span>{{ $category->name}}</span> category? </p>
                    
                </div>
        
                <div class="modal-footer border-0">
                    <form action="{{ route('admin.categories.destroy',$category->id)}}" method="post">
                        @csrf
                        @method('DELETE')
        
                        <button type="button" class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    

    
    

